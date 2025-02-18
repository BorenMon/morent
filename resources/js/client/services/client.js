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

        toast("Profile updated successfully", "success");

        // Return the avatar URL from the response
        return data.avatar_url;
    } catch (error) {
        toast(`Error updating profile image: ${error.message}`, "error");
    }
}
