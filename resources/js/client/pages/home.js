import $ from 'jquery'
import Splide from '@splidejs/splide'

new Splide('#slider', {
  type: 'loop',
  autoplay: true,
  interval: 5000,
  perPage: 2,
  arrows: false,
  pagination: false,
  gap: '32px',
  breakpoints: {
    1000: {
      perPage: 1
    }
  }
}).mount();

new Splide('#popular', {
  arrows: false,
  pagination: false,
  gap: '32px',
  autoWidth: true
}).mount();


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