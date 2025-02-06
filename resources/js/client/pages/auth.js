import { toast } from '../services/sweetalert2.js'
import { register, login } from '../services/auth.js'
import { fetchProfile } from '../services/client.js'

const container = document.querySelector('.container')
const registerBtn = document.querySelector('.register-btn')
const loginBtn = document.querySelector('.login-btn')

registerBtn.addEventListener('click', () => {
  container.classList.add('active')
  window.location.hash = '#register';
})

loginBtn.addEventListener('click', () => {
  container.classList.remove('active')
  window.location.hash = '#login';
})

window.addEventListener('load', switchViewBasedOnHash)
window.addEventListener('hashchange', switchViewBasedOnHash)

function switchViewBasedOnHash() {
  const hash = window.location.hash

  if (hash === '#register') {
    container.classList.add('active')
  } else {
    container.classList.remove('active')
  }
}

// Optionally, set the default hash if none is present
if (!window.location.hash) {
  window.location.hash = '#login'; // Default to login if no hash is set
}
