import '../main.js'
import '../modules/splide.min.js'
import '../modules/select2.min.js'
import { getAssetUrl, fetchCollection, fetchItemById } from '../services/publicAPI.js'
import { formatToTwoDecimals } from '../services/utils.js'
import { refreshFavoriteEvent, checkIsFavorite } from '../services/favorites.js';
import '../modules/viewer.min.js'

// Get the current URL
const urlParams = new URLSearchParams(window.location.search);

// Get the value of the 'id' parameter
const carId = urlParams.get('id');

const bigImage = document.getElementById('big-image')

if (carId) {
  new Viewer(bigImage, {
    inline: false,
    navbar: false,
    toolbar: {
      zoomIn: true,
      zoomOut: true,
      play: {
        show: true
      },
      rotateLeft: true,
      rotateRight: true,
      flipHorizontal: true,
      flipVertical: true,
    }
  });

  const car = (await fetchItemById('cars', carId));

  const image = car.card_image
  const images = (await fetchCollection(`cars_files?filter[id][_in]=${car.images}`)).data.map(image => image.directus_files_id)

  bigImage.querySelector('img').src = getAssetUrl(image)

  const wrapper = document.getElementById('images-carousel-wrapper');

  const mainLi = document.createElement('li');
  mainLi.className = 'splide__slide image active main';
  mainLi.innerHTML = `
    <div>
      <img src="${getAssetUrl(image)}">
    </div>
  `
  wrapper.appendChild(mainLi);

  images.forEach((image) => {
    const li = document.createElement('li');
    li.className = 'splide__slide image';
    li.innerHTML = `
      <div style="background-image: url(${getAssetUrl(image)});"></div>
    `
    wrapper.appendChild(li);
  });
  
  const {
    id,
    model,
    type,
    gasoline,
    steering,
    capacity,
    description,
    price,
    has_promotion,
    promotion_price,
  } = car

  const { iconPath } = checkIsFavorite(id)

  const info = document.getElementById('info')
  info.dataset.id = id
  info.innerHTML = `
    <div class="flex justify-between">
      <div class="-mt-[5px]">
        <div class="text-[32px] font-bold text-[#1A202C]">${model}</div>
        <div class="flex items-center font-medium text-[#596780] text-[14px]">
          <div class="Stars" style="--rating: 4.5;"></div>&nbsp;<span>168</span>&nbsp;Reviews
        </div>
      </div>
      <img src="${iconPath}" class="icon favorite">
    </div>
    <p class="text-[20px] text-[#596780]">
      ${description || 'No description.'}
    </p>
    <div id="spec">
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
    </div>
    <div class="flex justify-between">
      <div class="font-bold">
        <div>
          <span class="text-[28px] text-[#1A202C]">$${formatToTwoDecimals(
            has_promotion ? promotion_price : price
          )}/</span> <span class="text-[#90A3BF] text-[14px]">day</span>
        </div>
        ${
          has_promotion
            ? `<s class="text-[16px] text-[#90A3BF]">$${formatToTwoDecimals(
                price
              )}</s>`
            : ''
        }
      </div>
      <button class="h-[66px] w-[134px]"><a href="/pages/payment.html?id=${id}">Book Now</a></button>
    </div>
  `

  const splide = new Splide('#images-carousel', {
    arrows: false,
    pagination: false,
    gap: '24px',
    autoWidth: true,
  }).mount();

  splide.on('click', (image) => {
    let imageUrl, isMain = false;
    document.querySelectorAll('li.image').forEach(image => {
      image.classList.remove('active');
    })
    image.slide.classList.add('active')
    if (image.index != 0) {
      imageUrl = image.slide.querySelector('div').style.backgroundImage.replace(/^url\(["']?/, '').replace(/["']?\)$/, '')
    } else {
      imageUrl = image.slide.querySelector('div img').src
      isMain = true;
    }
    showImage(imageUrl, isMain);
  })

  const cars = (await fetchCollection(`cars?filter[status][_eq]=published&filter[rent_times][_gte]=50&limit=8&filter[id][_neq]=${id}`)).data;

  const popularWrapper = document.getElementById('popular-wrapper');
  popularWrapper.innerHTML = ''; // Clear previous content

  cars.forEach((car) => {
    const li = document.createElement('li');
    li.className = 'splide__slide car-card';
    const { id, model, type, card_image, gasoline, steering, capacity, price, has_promotion, promotion_price } = car;
    li.setAttribute('data-id', id);
    const { iconPath } = checkIsFavorite(id);
    
    li.innerHTML = `
      <div>
        <div class="-mt-[5px]">
          <div class="text-[20px] font-bold text-[#1A202C]">${model}</div>
          <div class="text-[14px] font-bold text-[#90A3BF]">${type}</div>
        </div>
        <img src="${iconPath}" alt="" class="icon favorite">
      </div>
      <a href="/pages/detail.html?id=${id}" aria-label="See more about car"><img src="${getAssetUrl(card_image)}" loading="lazy" alt=""></a>
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
              <span class="text-[20px] text-[#1A202C]">$${formatToTwoDecimals(has_promotion ? promotion_price : price)}/</span> <span class="text-[#90A3BF] text-[14px]">day</span>
            </div>
            ${has_promotion ? '<s class="text-[14px] text-[#90A3BF]">$' + formatToTwoDecimals(price) + '</s>' : ''}
          </div>
          <button><a href="/pages/payment.html?id=${id}">Book Now</a></button>
        </div>
      </div>
    `

    popularWrapper.appendChild(li);
  });

  new Splide('#popular', {
    arrows: false,
    pagination: false,
    gap: '32px',
    autoWidth: true
  }).mount();

  refreshFavoriteEvent();

  $('#skeleton-loading').addClass('hidden');
  $('#loaded').removeClass('hidden');
} else {
  window.location.href = '/pages/category.html';
}

const showImage = (imageUrl, isMain) => {
  const image = bigImage.querySelector('img')
  image.src = imageUrl

  if (isMain) {
    image.style.width = '80%'
    image.style.height = 'auto'
    image.style.borderRadius = '0'
  } else {
    image.style.width = '100%'
    image.style.height = '100%'
    image.style.objectFit = 'cover'
    image.style.objectPosition = 'center'
    image.style.borderRadius = '10px'
  }
}