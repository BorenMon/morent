import '/js/main.js'
import {
  updateProfileImage,
  fetchProfile,
  removeProfileImage
} from '../services/client.js'
import { toast, sweetalert } from '../services/sweetalert2.js'
import 'https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js'
import '../modules/filepond.min.js'
import { urlToFilePondObject } from '../services/filepond.js'
import { getAssetUrl } from '../services/publicAPI.js'
import api from '../services/authAPI.js'
import { areObjectsEqual, formatISODate, formatToTwoDecimals, snakeToCapitalizedWithSpaces } from '../services/utils.js'
import directusConfig from '../config/directus.config.js'
import { forbiddenPage } from '../services/auth.js'
import serviceApi from '../services/authServiceAPI.js'

if (forbiddenPage()) window.location.href = '/'

let profile = await fetchProfile(true)

if (profile.is_verified) {
  $('#status').html(`
    <img src="/assets/icons/verified.svg" alt="">&nbsp;
    Verified
  `)
} else {
  $('#status').html(`
    <img src="/assets/icons/unverified.svg" alt="">&nbsp;
    Unverified
  `)
}

const uploadProfileButton = $('#upload-save-profile')
const uploadProfileInput = $('#upload-profile')
const profilePic = $('#profile-pic')
const removeButton = $('#remove-cancel-profile')
let profileFile
let localProfilePic = profile.avatar
const defaultProfilePicSrc = '/assets/images/sample-profile.jpg'
let currentProfilePicSrc = localProfilePic
  ? getAssetUrl(localProfilePic)
  : defaultProfilePicSrc
let processingFile

const disableRemoveButton = () => {
  if (currentProfilePicSrc === defaultProfilePicSrc) {
    removeButton.attr('disabled', true)
    removeButton.css('cursor', 'not-allowed')
  }
}

const enableRemoveButton = () => {
  removeButton.attr('disabled', false)
  removeButton.css('cursor', 'pointer')
}

disableRemoveButton()

const updateProfilePic = (src) => {
  profilePic.attr('src', src)
}

updateProfilePic(currentProfilePicSrc)

const isProfileInputDisabled = () => {
  return uploadProfileInput.is(':disabled')
}

uploadProfileButton.on('click', async () => {
  if (!isProfileInputDisabled()) {
    uploadProfileInput.trigger('click')
  } else {
    const avatar = await updateProfileImage(profileFile)
    $('#nav-profile').attr('src', getAssetUrl(avatar))
    uploadProfileInput.attr('disabled', false)
    removeButton.text('Remove')
    uploadProfileButton.html(`
      Change
    `)
  }
})

removeButton.on('click', async () => {
  if (isProfileInputDisabled()) {
    uploadProfileInput.attr('disabled', false)
    removeButton.text('Remove')
    uploadProfileButton.html(`
      Change
    `)
    resetProfilePic()
  } else {
    sweetalert
      .fire({
        title: 'Are you sure to remove profile picture?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3563E9',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
      })
      .then(async (result) => {
        if (result.isConfirmed) {
          await removeProfileImage()
          localProfilePic = undefined
          $('#nav-profile').attr('src', defaultProfilePicSrc)
          updateProfilePic(defaultProfilePicSrc)
        }
      })
  }
  disableRemoveButton()
})

const resetProfilePic = () => {
  profileFile = undefined
  uploadProfileInput.val('')
  updateProfilePic(currentProfilePicSrc)
}

uploadProfileInput.change((e) => {
  profileFile = e.target.files[0]

  if (profileFile.size <= 3000000) {
    updateProfilePic(URL.createObjectURL(profileFile))
    uploadProfileButton.html('Save')
    uploadProfileInput.attr('disabled', true)
    removeButton.text('Cancel')
    enableRemoveButton()
  } else {
    toast('File size must be at most 3 MB.', 'error')
    resetProfilePic()
  }
})

// Register FilePond plugins
FilePond.registerPlugin(
  FilePondPluginFileEncode,
  FilePondPluginFileValidateSize,
  FilePondPluginImageExifOrientation,
  FilePondPluginImagePreview
)

let idCardImages = (
  await api.get(
    `items/junction_directus_users_files?filter[id][_in]=${profile.id_card}`
  )
).data.data.map((image) => {
  return {
    id: image.id,
    url: getAssetUrl(image.directus_files_id),
  }
})

idCardImages = await Promise.all(
  idCardImages.map((file) => urlToFilePondObject(file))
)

const pond1 = FilePond.create(document.querySelector('input[name="id-card"]'), {
  allowMultiple: true,
  stylePanelAspectRatio: 1,
  imagePreviewHeight: 100,
  files: idCardImages,

  // Prompt before adding a file
  onaddfile: async (error, file) => {
    if (error) {
      toast(`${error.main}, ${error.sub}`, 'error')
      pond1.removeFile(file)
      return
    }

    // Prompt to confirm if the user wants to add the file
    if (!file.getMetadata().id && !file.getMetadata().reverted) {
      sweetalert
        .fire({
          title: 'Are you sure you want to add this file?',
          text: 'Whenever file is added, your status will be unverified until our staff rechecks it.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3563E9',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
        })
        .then(async (result) => {
          if (result.isConfirmed) {
            // Proceed with file upload if confirmed
            if (!file.getMetadata().id) {
              const formData = new FormData()
              formData.append('file', file.file)

              try {
                const uploadResponse = await api.post('/files', formData, {
                  headers: {
                    'Content-Type': 'multipart/form-data',
                  },
                })

                const createResponse = await api.post(
                  '/items/junction_directus_users_files',
                  {
                    directus_files_id: uploadResponse.data.data.id,
                    directus_users_id: profile.id,
                  }
                )

                // Set metadata with file ID after successful upload and link
                file.setMetadata('id', createResponse.data.data.id)
              } catch (uploadError) {
                console.error('File upload failed:', uploadError)
              }
            }
          } else {
            pond1.removeFile(file) // This ensures you're using the correct instance to remove the file after prompt
          }
        })
    }
  },

  // Prompt before removing a file
  onremovefile: async (error, file) => {
    if (error) {
      console.error(error)
      return
    }

    if (file.getMetadata().id) {
      processingFile = file

      // Prompt to confirm if the user wants to remove the file
      sweetalert
        .fire({
          title: 'Are you sure you want to remove this file?',
          text: 'Whenever file is removed, your status will be unverified until our staff rechecks it.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3563E9',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
        })
        .then(async (result) => {
          if (result.isConfirmed) {
            // Proceed with file removal if confirmed
            try {
              await api.delete(
                'items/junction_directus_users_files/' + file.getMetadata().id
              )
            } catch (removeError) {
              console.error('File removal failed:', removeError)
            }
          } else {
            pond1.addFile(processingFile.file, {
              metadata: {
                id: processingFile.getMetadata().id,
                reverted: true,
              },
            }) // Re-add the file if removal is canceled
          }
        })
    }
  },
})

let driverLicenseImages = (
  await api.get(
    `items/junction_directus_users_files_1?filter[id][_in]=${profile.driving_license}`
  )
).data.data.map((image) => {
  return {
    id: image.id,
    url: getAssetUrl(image.directus_files_id),
  }
})

driverLicenseImages = await Promise.all(
  driverLicenseImages.map((file) => urlToFilePondObject(file))
)

const pond2 = FilePond.create(
  document.querySelector('input[name="driver-license"]'),
  {
    allowMultiple: true,
    stylePanelAspectRatio: 1,
    imagePreviewHeight: 100,
    files: driverLicenseImages,

    // Prompt before adding a file
    onaddfile: async (error, file) => {
      if (error) {
        toast(`${error.main}, ${error.sub}`, 'error')
        pond2.removeFile(file)
        return
      }

      // Prompt to confirm if the user wants to add the file
      if (!file.getMetadata().id && !file.getMetadata().reverted) {
        sweetalert
          .fire({
            title: 'Are you sure you want to add this file?',
            text: 'Whenever file is added, your status will be unverified until our staff rechecks it.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3563E9',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
          })
          .then(async (result) => {
            if (result.isConfirmed) {
              // Proceed with file upload if confirmed
              if (!file.getMetadata().id) {
                const formData = new FormData();
                formData.append('file', file.file);

                try {
                  const uploadResponse = await api.post('/files', formData, {
                    headers: {
                      'Content-Type': 'multipart/form-data',
                    },
                  });

                  const createResponse = await api.post(
                    '/items/junction_directus_users_files_1',
                    {
                      directus_files_id: uploadResponse.data.data.id,
                      directus_users_id: profile.id,
                    }
                  );

                  // Set metadata with file ID after successful upload and link
                  file.setMetadata('id', createResponse.data.data.id);
                } catch (uploadError) {
                  console.error('File upload failed:', uploadError);
                }
              }
            } else {
              pond2.removeFile(file); // This ensures you're using the correct instance to remove the file after prompt
            }
          });
      }
    },

    // Prompt before removing a file
    onremovefile: async (error, file) => {
      if (error) {
        console.error(error)
        return
      }

      if (file.getMetadata().id) {
        processingFile = file

        // Prompt to confirm if the user wants to remove the file
        sweetalert
          .fire({
            title: 'Are you sure you want to remove this file?',
            text: 'Whenever file is removed, your status will be unverified until our staff rechecks it.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3563E9',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
          })
          .then(async (result) => {
            if (result.isConfirmed) {
              // Proceed with file removal if confirmed
              try {
                await api.delete(
                  'items/junction_directus_users_files_1/' +
                  file.getMetadata().id
                )
              } catch (removeError) {
                console.error('File removal failed:', removeError)
              }
            } else {
              pond2.addFile(processingFile.file, {
                metadata: {
                  id: processingFile.getMetadata().id,
                  reverted: true,
                },
              }) // This ensures you're using the correct instance to re-add the file after prompt
            }
          })
      }
    },
  }
)

let generalInfo = {
  "first_name": profile.first_name || '',
  "last_name": profile.last_name || '',
  "email": profile.email || '',
  "phone": profile.phone || '',
  "address": profile.address || ''
}

const requiredGeneralInfo = [
  "first_name",
  "last_name",
  "phone",
  "address"
]

let newGeneralInfo = { ...generalInfo };

Object.keys(generalInfo).forEach(key => {
  const input = $('input[name="' + key + '"]')
  input.val(generalInfo[key])
  input.on('input', e => {
    newGeneralInfo[key] = e.target.value
    checkGeneralInfo()
  })
})

$('#skeleton-loading').addClass('hidden');
$('#loaded').removeClass('hidden');

const saveGeneralInfo = $('#save-general-info')

const isGeneralInfoNotPassed = () => areObjectsEqual(generalInfo, newGeneralInfo) || requiredGeneralInfo.some(key => newGeneralInfo[key] === "")

const checkGeneralInfo = () => {
  if (isGeneralInfoNotPassed()) saveGeneralInfo.addClass('disabled-button')
  else saveGeneralInfo.removeClass('disabled-button')
}

checkGeneralInfo()

saveGeneralInfo.on('click', async e => {
  if (!isGeneralInfoNotPassed()) {
    try {
      const { email, ...updateData } = newGeneralInfo
      await api.patch('/users/' + profile.id, updateData);
      generalInfo = { ...newGeneralInfo }
      checkGeneralInfo()
      toast('General information updated successfully', 'success');
    } catch (e) {
      toast(e.response.data.errors.map(e => e.message).join('\n'), 'error');
    }
  }
})

const changePasswordFields = ['current_password', 'new_password', 'confirm_password']

changePasswordFields.forEach(field => {
  const input = $('input[name="' + field + '"]')
  input.on('input', e => {
    checkPassword()
  })
})

const checkPassword = () => {
  if (changePasswordFields.some(field => $(`input[name="${field}"]`).val() == '')) $('#change-password').addClass('disabled-button')
  else $('#change-password').removeClass('disabled-button')
}

checkPassword()

$('#change-password').on('click', async () => {
  if (changePasswordFields.every(field => $(`input[name="${field}"]`).val().trim())) {
    if ($('input[name="new_password"]').val().trim() !== $('input[name="confirm_password"]').val().trim()) {
      toast('New password and confirmation password do not match', 'error');
    } else {
      try {
        const response = await fetch(`${directusConfig.baseURL}/auth/login`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ email: profile.email, password: $('input[name="current_password"]').val().trim() }),
        })

        const data = await response.json()

        if (response.ok) {
          localStorage.setItem('access_token', data.data.access_token)
          localStorage.setItem('refresh_token', data.data.refresh_token)

          await api.patch('/users/' + profile.id, {
            password: $('input[name="new_password"]').val().trim()
          })

          changePasswordFields.forEach(field => $(`input[name="${field}"]`).val(""))
          checkPassword()
          toast('Password changed successfully', 'success')
        } else {
          toast('Current password not correct.', 'error')
        }
      } catch (e) {
        toast(e.response.data.errors.map(e => e.message).join('\n'), 'error');
      }
    }
  }
})

const refreshBookings = async () => {
  const bookingsList = $('#bookings ul')
  const bookingsLoading = $('#bookings img')
  bookingsLoading.removeClass('hidden')
  bookingsList.addClass('hidden')
  const response = await serviceApi.get('/renting/bookings')
  bookingsList.empty()

  response.data.data.forEach(booking => {
    const { id, car_id: { card_image, model, type }, date_created, total_amount } = booking

    bookingsList.append(`
      <li class="cursor-pointer py-[12px] flex border-e-2 pe-8 border-[#3563E9]">
        <img src="${getAssetUrl(card_image)}"
          class="w-[155px] me-[24px] object-contain">
        <div class="flex justify-between w-full">
          <div class="flex flex-col">
            <h3 class="text-xl font-medium">${model}</h3>
            <p class="text-[#90A3BF] mb-[6px]">${type}</p>
            <button type="button" data-id="${id}" class="cancel-booking"
              style="font-size: 0.875rem !important; height: 24px; padding: 0 12px !important; width: 88px !important; border-radius: 1000px !important; background-color: rgb(255, 40, 40) !important;">Cancel</button>
          </div>
          <div class="h-full flex flex-col justify-between items-end">
            <p class="text-[#90A3BF]">${formatISODate(date_created)}</p>
            <h3 class="font-bold text-2xl">$${formatToTwoDecimals(total_amount)}</h3>
          </div>
        </div>
      </li>
    `)
  })

  bookingsLoading.addClass('hidden')
  bookingsList.removeClass('hidden')

  $('.cancel-booking').on('click', async e => {
    sweetalert
      .fire({
        title: 'Are you sure to cancel this booking?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3563E9',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
      })
      .then(async (result) => {
        if (result.isConfirmed) {
          bookingsLoading.removeClass('hidden')
          bookingsList.addClass('hidden')
          const response = await serviceApi.delete('/renting/' + e.target.dataset.id)

          if (response.status == 200) {
            toast('Booking cancelled successfully','success')
            refreshBookings()
          }
        }
      })
  })
}
$('#bookings-tab').on('click', () => {
  refreshBookings()
})

const refreshRenting = async () => {
  const rentingList = $('#renting-car')
  const rentingLoading = $('#rentings img')
  rentingLoading.removeClass('hidden')
  rentingList.addClass('hidden')
  const response = await serviceApi.get('/renting')
  rentingList.empty()

  if (response.data.data.length > 0) {
    const { car_id: { card_image, model, type }, date_created, total_amount } = response.data.data[0]

    rentingList.html(`
        <img src="${getAssetUrl(card_image)}"
          class="w-[155px] me-[24px] object-contain">
        <div class="flex justify-between w-full">
          <div class="flex flex-col">
            <h3 class="text-xl font-medium">${model}</h3>
            <p class="text-[#90A3BF]">${type}</p>
          </div>
          <div class="h-full flex flex-col justify-between items-end">
            <p class="text-[#90A3BF]">${formatISODate(date_created)}</p>
            <h3 class="font-bold text-2xl">$${formatToTwoDecimals(total_amount)}</h3>
          </div>
        </div>
    `)
  }

  rentingLoading.addClass('hidden')
  rentingList.removeClass('hidden')
}
$('#rentings-tab').on('click', () => {
  refreshRenting()
})

const refreshHistory = async () => {
  const historyList = $('#history ul')
  const historyLoading = $('#history img')
  historyLoading.removeClass('hidden')
  historyList.addClass('hidden')
  const response = await serviceApi.get('/renting/history')
  historyList.empty()

  response.data.data.forEach(booking => {
    const { id, car_id: { card_image, model, type }, date_created, progress_status } = booking

    historyList.append(`
      <li class="cursor-pointer py-[12px] border-e-2 flex border-[#3563E9] pe-8">
        <img src="${getAssetUrl(card_image)}"
          class="w-[155px] me-[24px] object-contain">
        <div class="flex justify-between w-full">
          <div class="flex flex-col">
            <h3 class="text-xl font-medium">${model}</h3>
            <p class="text-[#90A3BF]">${type}</p>
          </div>
          <div class="h-full flex flex-col justify-between items-end">
            <p class="text-[#90A3BF]">${formatISODate(date_created)}</p>
            <span
              class="${progress_status == 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'} text-sm font-medium ms-2 px-2.5 py-0.5 rounded">${snakeToCapitalizedWithSpaces(progress_status)}</span>
          </div>
        </div>
      </li>
    `)
  })

  historyLoading.addClass('hidden')
  historyList.removeClass('hidden')
}
$('#history-tab').on('click', () => {
  refreshHistory()
})

$('div[role="tab"]').on('click', function () {
  window.location.hash = $(this).attr('id')
})

for (let i = 0; i < $('div[role="tab"]').length; i++) {
  if (window.location.hash === '#' + $('div[role="tab"]').eq(i).attr('id')) {
    $('div[role="tab"]').eq(i).trigger('click')
  }
}