import api from "./authAPI.js";
import { toast } from "../services/sweetalert2.js";

export const fetchProfile = async (refresh = false) => {
    let profile;

    if (!refresh) {
        profile = JSON.parse(localStorage.getItem("profile"));

        if (!profile && localStorage.getItem("access_token")) {
            const response = await api.get("/users");

            if (response.status == 200) {
                profile = response.data.data[0];
                localStorage.setItem("profile", JSON.stringify(profile));
            }
        }
    } else {
        if (localStorage.getItem("access_token")) {
            const response = await api.get("/users");

            if (response.status == 200) {
                profile = response.data.data[0];
                localStorage.setItem("profile", JSON.stringify(profile));
            }
        }
    }

    return profile;
};

function updateLocalProfile(data) {
    localStorage.setItem("profile", JSON.stringify(data));
}

export async function updateProfileImage(userId, csrfToken, fileInput) {
    try {
        // Step 1: Get the selected file
        const file = fileInput;
        const formData = new FormData();
        formData.append('_method', 'PATCH');
        formData.append("avatar", file); // Append the file with the field name 'avatar'

        // Step 2: Make the PATCH request using fetch
        const response = await fetch(`/users/${userId}/avatar`, {
            method: "POST",
            body: formData, // Send the form data with the file
            headers: {
                "X-CSRF-TOKEN": csrfToken, // Add CSRF token to the request header
            },
        });

        // Step 3: Check if the response is successful
        if (!response.ok) {
            throw new Error(`Error: ${response.statusText}`);
        }

        // Step 4: Handle the response and update the profile locally
        const data = await response.json(); // Assuming the response contains the avatar URL
        updateLocalProfile(data);

        toast("Profile updated successfully", "success");

        // Return the avatar URL from the response
        return data.avatar_url;
    } catch (error) {
        toast(`Error updating profile image: ${error.message}`, "error");
    }
}

export async function removeProfileImage() {
    try {
        // Step 1: Fetch the current user's profile
        const profile = await fetchProfile();

        if (!profile.avatar) {
            console.warn("No profile image to remove.");
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
        console.log("Profile image and file removed successfully.");
    } catch (error) {
        console.error("Error removing profile image:", error.message);
        throw error;
    }
}
