import $ from "jquery";
import { updateProfileImage } from "../services/client.js";
import { toast, sweetalert } from "../services/sweetalert2.js";
import "https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js";
import * as FilePond from "filepond";
import FilePondPluginFileEncode from "filepond-plugin-file-encode";
import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import FilePondPluginImageExifOrientation from "filepond-plugin-image-exif-orientation";
import { urlToFilePondObject } from "../services/filepond.js";
import { getAssetUrl } from "../services/publicAPI.js";
import api from "../services/authAPI.js";
import {
    areObjectsEqual,
    formatISODate,
    formatToTwoDecimals,
    snakeToCapitalizedWithSpaces,
} from "../services/utils.js";
import serviceApi from "../services/authServiceAPI.js";

let userId = $('meta[name="user-id"]').attr("content");
let csrfToken = $('meta[name="csrf-token"]').attr("content");

document.addEventListener("DOMContentLoaded", function () {
    // Get all the tabs and tab contents
    let tabs = document.querySelectorAll(".tab");
    let tabContents = document.querySelectorAll("[role='tabpanel']");

    // Check if there's a hash in the URL (e.g., #bookings, #profile-settings)
    let hash = window.location.hash;

    if (hash) {
        // Find the tab based on the hash and activate it
        let activeTab = document.querySelector(`[data-tabs-target="${hash}"]`);
        if (activeTab) {
            setActiveTab(activeTab);
        }

        // Show the corresponding tab content based on the hash
        let activeContent = document.querySelector(hash);
        if (activeContent) {
            activeContent.classList.remove("hidden");
        }
    }

    // Event listener for tab clicks
    tabs.forEach((tab) => {
        tab.addEventListener("click", function () {
            // Update the active tab
            setActiveTab(this);

            // Show the corresponding tab content
            let targetId = this.getAttribute("data-tabs-target");
            let targetContent = document.querySelector(targetId);

            // Hide all tab contents
            tabContents.forEach((content) => content.classList.add("hidden"));

            // Show the selected tab content
            if (targetContent) {
                targetContent.classList.remove("hidden");
            }

            // Update the URL hash without reloading the page
            history.pushState(null, null, targetId);
        });
    });

    function setActiveTab(selectedTab) {
        // Deactivate all tabs
        tabs.forEach((tab) => {
            tab.classList.remove(
                "border-b-2",
                "border-gray-700",
                "text-gray-900"
            );
            tab.setAttribute("aria-selected", "false");
        });

        // Activate the selected tab
        selectedTab.classList.add(
            "border-b-2",
            "border-gray-700",
            "text-gray-900"
        );
        selectedTab.setAttribute("aria-selected", "true");
    }
});

const uploadProfileButton = $("#upload-save-profile");
const uploadProfileInput = $("#upload-profile");
const profilePic = $("#profile-pic");
const removeButton = $("#remove-cancel-profile");
let profileFile;
let localProfilePic = profilePic.attr("src");
const defaultProfilePicSrc = "/client/images/sample-profile.jpg";
let currentProfilePicSrc = localProfilePic
    ? localProfilePic
    : defaultProfilePicSrc;
let processingFile;

const disableRemoveButton = () => {
    if (currentProfilePicSrc === defaultProfilePicSrc) {
        removeButton.attr("disabled", true);
        removeButton.css("cursor", "not-allowed");
    }
};

const enableRemoveButton = () => {
    removeButton.attr("disabled", false);
    removeButton.css("cursor", "pointer");
};

disableRemoveButton();

const updateProfilePic = (src) => {
    profilePic.attr("src", src);
};

updateProfilePic(currentProfilePicSrc);

const isProfileInputDisabled = () => {
    return uploadProfileInput.is(":disabled");
};

uploadProfileButton.on("click", async () => {
    if (!isProfileInputDisabled()) {
        uploadProfileInput.trigger("click");
    } else {
        $("#loading-backdrop").css("display", "flex");
        $("#nav-profile").attr(
            "src",
            await updateProfileImage(userId, csrfToken, profileFile)
        );
        $("#loading-backdrop").css("display", "none");
        uploadProfileInput.attr("disabled", false);
        removeButton.text("Remove");
        uploadProfileButton.html(`
      Change
    `);
    }
});

removeButton.on("click", async () => {
    if (isProfileInputDisabled()) {
        uploadProfileInput.attr("disabled", false);
        removeButton.text("Remove");
        uploadProfileButton.html(`
      Change
    `);
        resetProfilePic();
    } else {
        sweetalert
            .fire({
                title: "Are you sure to remove profile picture?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3563E9",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
            })
            .then(async (result) => {
                if (result.isConfirmed) {
                    $("#loading-backdrop").css("display", "flex");
                    await fetch(`/users/${userId}/avatar`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                            Accept: "application/json",
                        },
                    });
                    $("#loading-backdrop").css("display", "none");
                    toast("Profile removed successfully", "success");
                    localProfilePic = undefined;
                    $("#nav-profile").attr("src", defaultProfilePicSrc);
                    updateProfilePic(defaultProfilePicSrc);
                }
            });
    }
    disableRemoveButton();
});

const resetProfilePic = () => {
    profileFile = undefined;
    uploadProfileInput.val("");
    updateProfilePic(currentProfilePicSrc);
};

uploadProfileInput.on("change", (e) => {
    profileFile = e.target.files[0];

    if (profileFile.size <= 2000000) {
        updateProfilePic(URL.createObjectURL(profileFile));
        uploadProfileButton.html("Save");
        uploadProfileInput.attr("disabled", true);
        removeButton.text("Cancel");
        enableRemoveButton();
    } else {
        toast("File size must be at most 2 MB.", "error");
        resetProfilePic();
    }
});

// Register FilePond plugins
FilePond.registerPlugin(
    FilePondPluginFileEncode,
    FilePondPluginFileValidateSize,
    FilePondPluginImageExifOrientation,
    FilePondPluginImagePreview
);

const idCardObjectName = $('meta[name="user-id-card"]').attr("content");
const idCardUrl = $('meta[name="user-id-card-url"]').attr("content");

let idCardImages = [];

if (idCardObjectName)
    idCardImages.push({
        object_name: idCardObjectName,
        url: idCardUrl,
    });

Promise.all(idCardImages.map((file) => urlToFilePondObject(file))).then(
    (idCardImages) => {
        const pond1 = FilePond.create(
            document.querySelector('input[name="id-card"]'),
            {
                allowMultiple: false,
                stylePanelAspectRatio: 1,
                imagePreviewHeight: 100,
                files: idCardImages,

                // Prompt before adding a file
                onaddfile: async (error, file) => {
                    if (error) {
                        toast(`${error.main}, ${error.sub}`, "error");
                        pond1.removeFile(file);
                        return;
                    }

                    // Prompt to confirm if the user wants to add the file
                    if (
                        !file.getMetadata().object_name &&
                        !file.getMetadata().reverted
                    ) {
                        sweetalert
                            .fire({
                                title: "Are you sure you want to add this file?",
                                text: "Whenever file is added, your status will be unverified until our staff rechecks it.",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3563E9",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Yes",
                                cancelButtonText: "No",
                            })
                            .then(async (result) => {
                                if (result.isConfirmed) {
                                    // Proceed with file upload if confirmed
                                    if (!file.getMetadata().object_name) {
                                        const formData = new FormData();
                                        formData.append("id_card", file.file);

                                        try {
                                            const uploadResponse =
                                                await api.post(
                                                    "/files",
                                                    formData,
                                                    {
                                                        headers: {
                                                            "Content-Type":
                                                                "multipart/form-data",
                                                        },
                                                    }
                                                );

                                            // Set metadata with file ID after successful upload and link
                                            file.setMetadata(
                                                "object_name",
                                                createResponse.data.data.id
                                            );
                                        } catch (uploadError) {
                                            console.error(
                                                "File upload failed:",
                                                uploadError
                                            );
                                        }
                                    }
                                } else {
                                    pond1.removeFile(file); // This ensures you're using the correct instance to remove the file after prompt
                                }
                            });
                    }
                },

                // Prompt before removing a file
                onremovefile: async (error, file) => {
                    if (error) {
                        console.error(error);
                        return;
                    }

                    if (file.getMetadata().object_name) {
                        processingFile = file;

                        // Prompt to confirm if the user wants to remove the file
                        sweetalert
                            .fire({
                                title: "Are you sure you want to remove this file?",
                                text: "Whenever file is removed, your status will be unverified until our staff rechecks it.",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3563E9",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Yes",
                                cancelButtonText: "No",
                            })
                            .then(async (result) => {
                                if (result.isConfirmed) {
                                    // Proceed with file removal if confirmed
                                    try {
                                        await api.delete(
                                            "items/junction_directus_users_files/" +
                                                file.getMetadata().id
                                        );
                                    } catch (removeError) {
                                        console.error(
                                            "File removal failed:",
                                            removeError
                                        );
                                    }
                                } else {
                                    pond1.addFile(processingFile.file, {
                                        metadata: {
                                            object_name: processingFile.getMetadata().object_name,
                                            reverted: true,
                                        },
                                    }); // Re-add the file if removal is canceled
                                }
                            });
                    }
                },
            }
        );
    }
);

let generalInfo = {
    name: $('input[name="name"]').val(),
    email: $('input[name="email"]').val(),
    phone: $('input[name="phone"]').val(),
    address: $('input[name="address"]').val(),
};

const requiredGeneralInfo = ["name", "email", "phone", "address"];

let newGeneralInfo = { ...generalInfo };

Object.keys(generalInfo).forEach((key) => {
    const input = $('input[name="' + key + '"]');
    input.val(generalInfo[key]);
    input.on("input", (e) => {
        newGeneralInfo[key] = e.target.value;
        checkGeneralInfo();
    });
});

const saveGeneralInfo = $("#save-general-info");

setTimeout(() => saveGeneralInfo.text("Save"), 3000);

const isGeneralInfoNotPassed = () =>
    areObjectsEqual(generalInfo, newGeneralInfo) ||
    requiredGeneralInfo.some((key) => newGeneralInfo[key] === "");

const checkGeneralInfo = () => {
    if (isGeneralInfoNotPassed()) saveGeneralInfo.addClass("disabled-button");
    else saveGeneralInfo.removeClass("disabled-button");
};

checkGeneralInfo();

const changePasswordFields = [
    "current_password",
    "new_password",
    "new_password_confirmation",
];

changePasswordFields.forEach((field) => {
    const input = $('input[name="' + field + '"]');
    input.on("input", (e) => {
        checkPassword();
    });
});

const checkPassword = () => {
    if (
        changePasswordFields.some(
            (field) => $(`input[name="${field}"]`).val() == ""
        )
    )
        $("#change-password").addClass("disabled-button");
    else $("#change-password").removeClass("disabled-button");
};

checkPassword();
