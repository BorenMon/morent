import api from './authAPI.js'

export const checkIsFavorite = (carID, savedFavorites) => {
  savedFavorites =
    savedFavorites || JSON.parse(localStorage.getItem('savedFavorites') || '[]')

  const isFavorite = savedFavorites.includes(carID)
  const iconPath = isFavorite
    ? '/assets/icons/like.svg'
    : '/assets/icons/heart-outline.svg'
  const oppositeIconPath = !isFavorite
    ? '/assets/icons/like.svg'
    : '/assets/icons/heart-outline.svg'

  return {
    isFavorite,
    iconPath,
    oppositeIconPath,
  }
}

export const refreshFavoriteEvent = () => {
  // Ensure event listeners are removed before re-attaching
  $('.favorite').off('click')

  // Attach the click event once
  $('.favorite').on('click', (e) => {
    if (window.location.pathname.includes('/pages/favorites')) {
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
            refreshFavoriteEvent()
          }
        })
    } else toggleFavorite(e)
  })
}

export const toggleFavorite = (e) => {
  const id = +e.target.parentElement.parentElement.dataset.id

  // Toggle favorite status
  const savedFavorites = JSON.parse(
    localStorage.getItem('savedFavorites') || '[]'
  )

  const removedFavorites = JSON.parse(
    localStorage.getItem('removedFavorites') || '[]'
  )

  const { isFavorite, oppositeIconPath } = checkIsFavorite(id, savedFavorites)

  // Add or remove car from favorites
  if (isFavorite) {
    savedFavorites.splice(savedFavorites.indexOf(id), 1)
    removedFavorites.push(id)
  } else {
    savedFavorites.push(id)
    removedFavorites.splice(removedFavorites.indexOf(id), 1)
  }

  e.target.src = oppositeIconPath

  // Update local storage
  localStorage.setItem('savedFavorites', JSON.stringify(savedFavorites))
  localStorage.setItem('removedFavorites', JSON.stringify(removedFavorites))

  if (localStorage.getItem('profile')) syncFavorites(savedFavorites, removedFavorites);
}

// Helper function: Fetch user favorites from the database
export async function fetchFavorites() {
  try {
    const response = await api.get(`/items/favorites`)
    return response.data.data.map(item => item.car_id) || []
  } catch (error) {
    console.error('Error fetching user favorites:', error)
    return []
  }
}

export async function syncFavorites(localFavorites = JSON.parse(localStorage.getItem('savedFavorites')) || [], removeFavorites = JSON.parse(localStorage.getItem('removedFavorites')) || []) {
  // Fetch favorite cars from the database for this user
  const dbFavorites = await fetchFavorites()

  // Merge lists and remove duplicates
  let combinedFavorites = [...new Set([...localFavorites, ...dbFavorites])]

  combinedFavorites = combinedFavorites.filter(item => !removeFavorites.includes(item))

  localStorage.setItem('savedFavorites', JSON.stringify(combinedFavorites))

  // Update the database with the merged list
  await updateFavorites(combinedFavorites.map(item => {return { car_id: item }}))
}

// Helper function: Update user favorites in the database
export async function updateFavorites(favorites) {
  try {
    await api.delete(`items/favorites`, {
      "data": {
        "query": {
          "filter": {
            "client_id": {
              "_eq": JSON.parse(localStorage.getItem('profile')).id
            }
          }
        }
      }
    })
    await api.post(`items/favorites`, favorites)
  } catch (error) {
    console.error('Error updating user favorites:', error)
  }
}
