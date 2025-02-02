import '/js/main.js'
import serviceConfig from '../config/service.config.js'
import { toast } from '../services/sweetalert2.js'

$('#contactForm').on('submit', (e) => {
  e.preventDefault()

  const name = $('#fullName').val()
  const email = $('#email').val()
  const phone = $('#phone').val()
  const message = $('#message').val()

  // Validation
  if (!name || !email || !phone || !message) {
    toast('Please fill out all required fields.', 'error')
    return
  }

  // Send email using Directus API
  const data = {
    name,
    email,
    phone,
    message,
  }

  fetch(`${serviceConfig.baseURL}/contact/send`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data),
  })
    .then(() => {
      toast('Message sent successfully.', 'success', 'top')
      $('#contactForm').trigger('reset')
    })
    .catch((error) => {
      console.error('Error:', error)
      toast('Failed to send message. Please try again.', 'error')
    })
})
