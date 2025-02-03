import { toast } from '../services/sweetalert2.js'
import { register, login } from '../services/auth.js'
import { syncFavorites } from '../services/favorites.js'
import { fetchProfile } from '../services/client.js'
import { forbiddenPage } from '../services/auth.js'

if (!forbiddenPage()) window.location.href = '/'

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

document.getElementById('login').addEventListener('submit', async (e) => {
  e.preventDefault()

  const email = document.querySelector('#login input[name="email"]').value
  const password = document.querySelector('#login input[name="password"]').value

  if (!email || !password) {
    toast('Please fill out all required fields.', 'error')
    return
  }

  if (await login(email, password)) {
    await fetchProfile()
    await syncFavorites()
    window.location.href = '/'
  }
})

document.getElementById('register').addEventListener('submit', async (e) => {
  e.preventDefault()

  const email = document.querySelector('#register input[name="email"]').value
  const password = document.querySelector(
    '#register input[name="password"]'
  ).value
  const confirmPassword = document.querySelector(
    '#register input[name="confirmPassword"]'
  ).value

  if (!email || !password || !confirmPassword) {
    toast('Please fill out all required fields.', 'error')
    return
  }

  if (password !== confirmPassword) {
    toast('Passwords do not match.', 'error')
    return
  }

  if (await register(email, password)) {
    e.target.reset()
    container.classList.remove('active')
    window.location.hash = '#login';
  }
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
