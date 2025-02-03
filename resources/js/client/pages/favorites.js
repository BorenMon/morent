import '../main.js'
import { getAssetUrl, fetchCollection } from '../services/publicAPI.js'
import {
  formatToTwoDecimals,
  debounce,
} from '../services/utils.js'
import {
  toggleFavorite,
  checkIsFavorite,
} from '../services/favorites.js'
import sweetalert2 from '/js/modules/sweetalert2.all.min.js'

$('#filter-button').on('click', () => {
  $('#filter').addClass('open')
  $('#filter-backdrop').css('display', 'block')
})

const closeFilter = () => {
  $('#filter-backdrop').css('display', 'none')
  $('#filter').removeClass('open')
}

$('#close-filter').on('click', closeFilter)
$('#filter-backdrop').on('click', closeFilter)

const filterHandleResize = (e) => {
  if (e.matches) {
    closeFilter()
  }
}

const filterMediaQuery = window.matchMedia('(min-width: 1100px)')

filterMediaQuery.addEventListener('change', filterHandleResize)

const displayFavorites = async (addOnQuery) => {
  $('#skeleton-loading').removeClass('hidden');
  $('#loaded').addClass('hidden');

  const favoriteIds = JSON.parse(localStorage.getItem('savedFavorites') || '[]')

  const cars = (
    await fetchCollection(
      `cars?filter[status][_eq]=published&filter[id][_in]=${favoriteIds.join(
        ','
      )}${addOnQuery}`
    )
  ).data

  const $favorites = $('#favorites #loaded')
  $favorites.empty() // Clear previous content

  if (cars.length > 0) {
    cars.forEach((car) => {
      const {
        id,
        model,
        type,
        card_image,
        gasoline,
        steering,
        capacity,
        price,
        has_promotion,
        promotion_price,
      } = car

      const { iconPath } = checkIsFavorite(id)

      const $div = $(`
        <div class="car-card" data-id="${id}">
          <div>
            <div class="-mt-[5px]">
              <div class="text-[20px] font-bold text-[#1A202C]">${model}</div>
              <div class="text-[14px] font-bold text-[#90A3BF]">${type}</div>
            </div>
            <img src="${iconPath}" alt="" class="icon favorite" />
          </div>
          <div class="info">
            <a href="/pages/detail.html?id=${id}">
              <img src="${getAssetUrl(card_image)}" alt="" />
            </a>
            <div class="space-y-[48px] details">
              <div class="space-y-[12px]">
                <div class="space-x-[12px]">
                  <img src="/assets/icons/car-body.svg" alt="" class="icon" />
                  <span class="name">Type</span>
                  <span>${type}</span>
                </div>
                <div class="space-x-[12px]">
                  <img src="/assets/icons/car.svg" alt="" class="icon" />
                  <span class="name">Steering</span>
                  <span>${steering}</span>
                </div>
                <div class="space-x-[12px]">
                  <img src="/assets/icons/profile-2user.svg" alt="" class="icon" />
                  <span class="name">Capacity</span>
                  <span>${capacity} People</span>
                </div>
                <div class="space-x-[12px]">
                  <img src="/assets/icons/gas-station.svg" alt="" class="icon" />
                  <span class="name">Gasoline</span>
                  <span>${gasoline}L</span>
                </div>
              </div>
              <div>
                <div class="font-bold">
                  <div>
                    <span class="text-[20px] text-[#1A202C]">$${formatToTwoDecimals(
                      has_promotion ? promotion_price : price
                    )}/</span> <span class="text-[#90A3BF] text-[14px]">day</span>
                  </div>
                  ${
                    has_promotion
                      ? `<s class="text-[14px] text-[#90A3BF]">$${formatToTwoDecimals(
                          price
                        )}</s>`
                      : ''
                  }
                </div>
                <button><a href="/pages/payment.html?id=${id}">Book Now</a></button>
              </div>
            </div>
          </div>
        </div>
      `)

      $favorites.append($div)
    })
  } else {
    $favorites.html(
      '<div class="text-center text-[24px] text-[#90A3BF]">No matched favorited car found.</div>'
    )
  }

  $('#skeleton-loading').addClass('hidden');
  $('#loaded').removeClass('hidden');
}

const defaultDisplayFavorites = (addOnQuery = '') => {
  displayFavorites(addOnQuery).then(() => {
    // Ensure event listeners are removed before re-attaching
    $('.favorite').off('click')

    // Attach the click event once
    $('.favorite').on('click', (e) => {
      sweetalert2
        .fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3563E9',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
        })
        .then((result) => {
          if (result.isConfirmed) {
            toggleFavorite(e)
            refreshFavorite()
          }
        })
    })
  })
}

async function getCount(queryParams) {
  const favoriteIds = JSON.parse(localStorage.getItem('savedFavorites') || '[]')

  return (
    await fetchCollection(
      `cars?filter[status][_eq]=published&meta=filter_count&limit=0&filter[id][_in]=${favoriteIds.join(
        ','
      )}&` + queryParams
    )
  ).meta.filter_count
}

let types = [],
  capacities = [],
  maxPrice = 100

function queryParamsBuilder() {
  let queryParams = new URLSearchParams()

  // Add filter for types (if not empty)
  if (types.length > 0) {
    types.forEach((type, index) => {
      queryParams.append(`filter[type][_in][${index}]`, type)
    })
  }

  // Add filter for capacities (if not empty)
  if (capacities.length > 0) {
    capacities.forEach((capacity, index) => {
      if (capacity == '8') {
        // Handle the "8" case with _gte (greater than or equal to)
        queryParams.append('filter[capacity][_gte]', 8)
      } else {
        // Handle other capacity values as exact matches using _in
        queryParams.append(`filter[capacity][_in][${index}]`, +capacity)
      }
    })
  }

  // Add max price filter (if defined)
  if (maxPrice !== undefined && maxPrice !== null) {
    queryParams.append('filter[_or][0][price][_lte]', maxPrice)
    queryParams.append('filter[_or][1][promotion_price][_lte]', maxPrice)
  }

  // Return the complete query string
  return decodeURIComponent(queryParams.toString())
}

// Event listener for input changes
$('#max-price').on('input', (e) => {
  maxPrice = $(e.target).val()

  // Update the max price value display immediately
  $('#max-price-value').text(formatToTwoDecimals(maxPrice))

  $('#skeleton-loading').removeClass('hidden');
  $('#loaded').addClass('hidden');

  // Debounced API call
  debounceRefreshCars()
})

const debounceRefreshCars = debounce(function () {
  defaultDisplayFavorites('&' + queryParamsBuilder())
}, 300)

const typeChecks = [
  $('#Sport'),
  $('#SUV'),
  $('#MPV'),
  $('#Sedan'),
  $('#Coupe'),
  $('#Hatchback'),
]

typeChecks.forEach((type) => {
  type.on('change', (e) => {
    if (e.target.checked) {
      types.push(e.target.value)
    } else {
      types = types.filter((type) => type !== e.target.value)
    }
    defaultDisplayFavorites('&' + queryParamsBuilder())
  })
})

const capacityChecks = [
  $('input[id="2 Person"]'),
  $('input[id="4 Person"]'),
  $('input[id="6 Person"]'),
  $('input[id="8 or More"]'),
]

capacityChecks.forEach((capacity) => {
  capacity.on('change', (e) => {
    if (e.target.checked) {
      capacities.push(e.target.value)
    } else {
      capacities = capacities.filter((capacity) => capacity !== e.target.value)
    }
    defaultDisplayFavorites('&' + queryParamsBuilder())
  })
})

async function refreshFavorite() {
  defaultDisplayFavorites()

  $('label[for="Sport"] span').text(
    `(${await getCount('filter[type][_eq]=Sport')})`
  )
  $('label[for="SUV"] span').text(
    `(${await getCount('filter[type][_eq]=SUV')})`
  )
  $('label[for="MPV"] span').text(
    `(${await getCount('filter[type][_eq]=MPV')})`
  )
  $('label[for="Sedan"] span').text(
    `(${await getCount('filter[type][_eq]=Sedan')})`
  )
  $('label[for="Coupe"] span').text(
    `(${await getCount('filter[type][_eq]=Coupe')})`
  )
  $('label[for="Hatchback"] span').text(
    `(${await getCount('filter[type][_eq]=Hatchback')})`
  )
  $('label[for="2 Person"] span').text(
    `(${await getCount('filter[capacity][_eq]=2')})`
  )
  $('label[for="4 Person"] span').text(
    `(${await getCount('filter[capacity][_eq]=4')})`
  )
  $('label[for="6 Person"] span').text(
    `(${await getCount('filter[capacity][_eq]=6')})`
  )
  $('label[for="8 or More"] span').text(
    `(${await getCount('filter[capacity][_gte]=8')})`
  )
}

await refreshFavorite()
