import api from './authAPI.js';
import { toast } from '../services/sweetalert2.js'

export const fetchProfile = async (refresh = false) => {
  let profile;

  if (!refresh) {
    profile = JSON.parse(localStorage.getItem('profile'));
  
    if (!profile && localStorage.getItem('access_token')) {
      const response = await api.get('/users');

      if (response.status == 200) {
        profile = response.data.data[0];
        localStorage.setItem('profile', JSON.stringify(profile));
      }
    }
  } else {
    if (localStorage.getItem('access_token')) {
      const response = await api.get('/users');

      if (response.status == 200) {
        profile = response.data.data[0];
        localStorage.setItem('profile', JSON.stringify(profile));
      }
    }
  }

  return profile;
}

function updateLocalProfile(data) {
  localStorage.setItem('profile', JSON.stringify(data));
}

export async function updateProfileImage(fileInput) {
  try {
    // Step 1: Upload the file
    const file = fileInput; // Get the selected file
    const formData = new FormData();
    formData.append('file', file);

    const uploadResponse = await api.post('/files', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });

    const fileId = uploadResponse.data.data.id; // Get the uploaded file's ID

    // Step 2: Update the user's avatar
    const updateResponse = await api.patch(`/users/${(await fetchProfile()).id}`, {
      avatar: fileId, // Update the avatar field with the file ID
    });

    const data = updateResponse.data.data
    updateLocalProfile(data);

    toast('Profile updated successfully', 'success');

    return data.avatar;
  } catch (error) {
    toast(`Error updating profile image: ${error.message}`, 'error');
  }
}

export async function removeProfileImage() {
  try {
    // Step 1: Fetch the current user's profile
    const profile = await fetchProfile();

    if (!profile.avatar) {
      console.warn('No profile image to remove.');
      return null; // Exit if there's no avatar to remove
    }

    const fileId = profile.avatar; // Get the current avatar file ID

    // Step 2: Remove the avatar field from the user's profile
    const updateResponse = await api.patch(`/users/${profile.id}`, {
      avatar: null, // Set the avatar field to null
    });

    const updatedData = updateResponse.data.data;
    updateLocalProfile(updatedData); // Update the local profile cache

    // Step 3: Delete the file from Directus
    await api.delete(`/files/${fileId}`);
    console.log('Profile image and file removed successfully.');
  } catch (error) {
    console.error('Error removing profile image:', error.message);
    throw error;
  }
}
