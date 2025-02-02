import '../main.js'
import '../modules/select2.min.js'
import { cities } from '../config/location.master-data.js'
import { getAssetUrl, fetchCollection } from '../services/publicAPI.js'
import {
  formatToTwoDecimals,
  debounce,
} from '../services/utils.js'
import {
  refreshFavoriteEvent,
  checkIsFavorite,
} from '../services/favorites.js'

const debouncedRefreshCars = debounce(function (value) {
  defaultRefreshCars(value, true)
}, 300)

$('.city').select2({
  width: '100%',
  data: [{ id: '0', text: 'Select your city', value: '' }, ...cities],
})

let filter_count
let total_page

const displayCars = async (queryString) => {
  $('#skeleton-loading').removeClass('hidden');
  $('#loaded').addClass('hidden');

  const result = await fetchCollection(`cars?${queryString}`)

  const carData = result.data
  filter_count = result.meta.filter_count
  total_page = Math.ceil(filter_count / 9)
  changePagination()

  const $cars = $('#cars') // Select the container
  $cars.empty() // Clear previous content

  carData.forEach((car) => {
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

    // Create car card using jQuery
    const $div = $('<div></div>').addClass('car-card').attr('data-id', id)
      .html(`
        <div>
          <div class="-mt-[5px]">
            <div class="text-[20px] font-bold text-[#1A202C]">${model}</div>
            <div class="text-[14px] font-bold text-[#90A3BF]">${type}</div>
          </div>
          <img src="${iconPath}" alt="" class="icon favorite">
        </div>
        <a href="/pages/detail.html?id=${id}"><img src="${getAssetUrl(card_image)}" alt=""></a>
        <div class="space-y-[24px]">
          <div>
            <div>
              <img src="/assets/icons/gas-station.svg" alt="" class="icon">
              <span>${gasoline}L</span>
            </div>
            <div>
              <img src="/assets/icons/car.svg" alt="" class="icon">
              <span>${steering}</span>
            </div>
            <div>
              <img src="/assets/icons/profile-2user.svg" alt="" class="icon">
              <span>${capacity} People</span>
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
                  ? '<s class="text-[14px] text-[#90A3BF]">$' +
                    formatToTwoDecimals(price) +
                    '</s>'
                  : ''
              }
            </div>
            <button><a href="/pages/payment.html?id=${id}">Book Now</a></button>
          </div>
        </div>
      `)

    // Append each car card to the container
    $cars.append($div)
  })

  $('#skeleton-loading').addClass('hidden');
  $('#loaded').removeClass('hidden');
}

const prefixCarsQueryString =
  'filter[status][_eq]=published&meta=filter_count&limit=9'

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

// Get the current URL
const urlParams = new URLSearchParams(window.location.search)

let keyword = ''
let page = 1
let types = []
let capacities = []
let maxPrice = 100

// Function to generate pagination dynamically
function generatePagination(currentPage, totalPages) {
  const paginationContainer = $('#pagination') // Select the container

  // Clear existing pagination (if any)
  paginationContainer.empty()

  // Previous button
  const prevButton = $(
    '<div class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0"><span class="sr-only">Previous</span><img src="/assets/icons/backward-arrow.svg" alt=""></div>'
  )

  // Disable when on first page
  if (currentPage === 1) {
    prevButton.addClass('disabled').css('pointer-events', 'none')
  }

  paginationContainer.append(prevButton)

  // Number of pages to display before and after the current page
  const maxPagesToShow = 5
  const halfMaxPages = Math.floor(maxPagesToShow / 2)

  // Calculate start and end page numbers to display
  let startPage = Math.max(1, currentPage - halfMaxPages)
  let endPage = Math.min(totalPages, currentPage + halfMaxPages)

  // Adjust if we're near the start or end
  if (currentPage - halfMaxPages <= 0) {
    endPage = Math.min(totalPages, endPage + (halfMaxPages - currentPage + 1))
  }
  if (currentPage + halfMaxPages >= totalPages) {
    startPage = Math.max(
      1,
      startPage - (currentPage + halfMaxPages - totalPages)
    )
  }

  // Page links
  for (let i = startPage; i <= endPage; i++) {
    const pageLink = $(
      '<div class="cursor-pointer relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0"></div>'
    )
    pageLink.text(i)

    // Highlight the current page
    if (i === currentPage) {
      pageLink.addClass('z-10 bg-[#3563E9] text-white')
    }

    paginationContainer.append(pageLink)

    // Add event listener to each page link
    pageLink.on('click', function (e) {
      e.preventDefault()
      generatePagination(i, totalPages) // Regenerate pagination for selected page
      page = i
      defaultRefreshCars(undefined, false)
    })
  }

  // If there are pages not displayed, add ellipsis
  if (endPage < totalPages) {
    const ellipsis = $(
      '<span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>'
    )
    paginationContainer.append(ellipsis)
  }

  // Next button
  const nextButton = $(
    '<div class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0"><span class="sr-only">Next</span><img src="/assets/icons/forward-arrow.svg" alt=""></div>'
  )

  // Disable when on last page
  if (currentPage === totalPages) {
    nextButton.addClass('disabled').css('pointer-events', 'none')
  }

  paginationContainer.append(nextButton)

  // Add event listeners for previous and next buttons
  prevButton.on('click', function (e) {
    prevAction(e, totalPages)
  })

  nextButton.on('click', function (e) {
    nextAction(e, totalPages)
  })
}

const prevAction = (e, totalPages) => {
  e.preventDefault()
  if (page > 1) {
    generatePagination(page - 1, totalPages) // Go to previous page
    --page
    defaultRefreshCars(undefined, false)
  }
}

const nextAction = (e, totalPages) => {
  e.preventDefault()
  if (page < totalPages) {
    generatePagination(page + 1, totalPages) // Go to next page
    ++page
    defaultRefreshCars(undefined, false)
  }
}

$('#prev-button').on('click', (e) => prevAction(e, total_page))
$('#next-button').on('click', (e) => nextAction(e, total_page))

const changePagination = () => {
  if (filter_count > 0) {
    $('#showing-from').text((page - 1) * 9 + 1)
    $('#showing-to').text(Math.min(page * 9, filter_count))
    $('#filter_count').text(filter_count)

    $('#pagination-container > div:nth-child(1)').css('display', 'block')
    $('#pagination-container > div:nth-child(2)').css('display', 'block')
    $('#pagination-container > p').css('display', 'none')

    generatePagination(page, total_page)
  } else {
    $('#pagination-container > div:nth-child(1)').css('display', 'none')
    $('#pagination-container > div:nth-child(2)').css('display', 'none')
    $('#pagination-container > p').css('display', 'block')
  }
}

function refreshCars(queryString) {
  displayCars(queryString).then(refreshFavoriteEvent)
}

function queryParamsBuilder(page, keyword, types, capacities, maxPrice) {
  let queryParams = new URLSearchParams()

  // Add pagination parameters
  queryParams.append('page', page)

  // Add keyword search for multiple fields (e.g., title, description)
  if (keyword) {
    queryParams.append('search', keyword)
  }

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

const defaultRefreshCars = (otherKeyword, restartPage) => {
  if (restartPage) page = 1
  if (otherKeyword !== undefined) {
    keyword = otherKeyword
  }
  refreshCars(
    prefixCarsQueryString +
      '&' +
      queryParamsBuilder(page, keyword, types, capacities, maxPrice)
  )
}

async function getCount(queryParams) {
  return (
    await fetchCollection(
      ('cars?' + prefixCarsQueryString + '&' + queryParams).replace(
        'limit=9',
        'limit=0'
      )
    )
  ).meta.filter_count
}

$('label[for="Sport"] span').text(
  `(${await getCount('filter[type][_eq]=Sport')})`
)
$('label[for="SUV"] span').text(`(${await getCount('filter[type][_eq]=SUV')})`)
$('label[for="MPV"] span').text(`(${await getCount('filter[type][_eq]=MPV')})`)
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
  defaultRefreshCars(undefined, true)
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
    defaultRefreshCars(undefined, true)
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
    defaultRefreshCars(undefined, true)
  })
})

keyword = urlParams.get('keyword')

const inputs = document.querySelectorAll('.search-input');

if (keyword) {
  inputs.forEach((input) => {
    input.value = keyword
  })

  defaultRefreshCars(keyword, false)
} else defaultRefreshCars(undefined, false)

// Get the current URL
const url = new URL(window.location.href)

// Clear the query parameters
url.search = ''

// Update the URL without reloading the page
window.history.replaceState({}, document.title, url.toString())

inputs.forEach((input) => {
  input.addEventListener('input', function () {
    const currentValue = input.value
    inputs.forEach((otherInput) => {
      // Update all other inputs except the current one
      if (otherInput !== input) {
        otherInput.value = currentValue
      }
    })

    $('#skeleton-loading').removeClass('hidden');
    $('#loaded').addClass('hidden');

    debouncedRefreshCars(currentValue)
  })
})

const bookingEls = [
  {
    key: 'city',
    type: 'number'
  },
  {
    key: 'date',
    type: 'string'
  },
  {
    key: 'time',
    type: 'string'
  }
]

const loadBookingInputs = () => {
  const pickUpInputs = JSON.parse(localStorage.getItem('pickUpInputs')) || {
    city: null,
    date: null,
    time: null
  };

  const dropOffInputs = JSON.parse(localStorage.getItem('dropOffInputs')) || {
    city: null,
    date: null,
    time: null
  };

  ["pick-up", "drop-off"].forEach(id => {
    bookingEls.forEach(el => {
      let value
      if (id == "pick-up") value = pickUpInputs[el.key]
      else value = dropOffInputs[el.key]
      $(`#${id} .${el.key}`).val(value).trigger('change')
    })
  })
}

loadBookingInputs()

bookingEls.forEach(el => {
  $(`.${el.key}`).on('change', function () {
    let value;
    if (el.type === 'number') value = +$(this).val();
    else value = $(this).val();
    saveBookingInputs(el.key, value, this);
  });
})

const saveBookingInputs = (key, value, el) => {
  let type = $(el).closest('.booking-container').attr('id');

  if (type === 'pick-up') type = 'pickUpInputs';
  else type = 'dropOffInputs';

  const savedInputs = JSON.parse(localStorage.getItem(type)) || {
    city: null,
    date: null,
    time: null
  }; 
  
  savedInputs[key] = value;

  localStorage.setItem(type, JSON.stringify(savedInputs));
}

$('#swap-icon').on('click', () => {
  const pickUp = JSON.parse(localStorage.getItem('pickUpInputs'));
  const dropOff = JSON.parse(localStorage.getItem('dropOffInputs'));

  if (pickUp && dropOff) {
    localStorage.setItem('pickUpInputs', JSON.stringify(dropOff));
    localStorage.setItem('dropOffInputs', JSON.stringify(pickUp));
  }

  loadBookingInputs()
})