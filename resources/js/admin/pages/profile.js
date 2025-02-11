import 'cropper'
import { showLoading, hideLoading, showAlert } from '../uiHelpers';

const $profileImage = $('#profile-image');
const $uploadButton = $('#upload-cropped-image');

// Function to initialize Cropper
function initCropper() {
    $profileImage.cropper('destroy'); // Destroy any existing instance
    $profileImage.cropper({
        aspectRatio: 1 / 1,
        viewMode: 1,  // Ensures it fits within the container
        autoCropArea: 1, // Ensures the crop area takes full space
        responsive: true
    });
}

// Function to set the uploaded image as Cropper source
function setCropperImage(imageUrl) {
    $profileImage.attr('src', imageUrl); // Update the image source
    $profileImage.on('load', function () {
        initCropper(); // Reinitialize Cropper when the image is loaded
    });
}

// Listen for Bootstrap modal 'shown' event
$('#profile-cropper-modal').on('shown.bs.modal', function () {
    initCropper(); // Initialize Cropper when modal is fully shown
});

// If modal is forced open during development, manually trigger
$(document).ready(function () {
    if ($('#profile-cropper-modal').hasClass('show')) {
        initCropper();
    }
});

// Function to upload the cropped image
function uploadCroppedImage() {
    let cropper = $profileImage.data('cropper');

    if (!cropper) {
        alert("Cropper not initialized!");
        return;
    }

    // Get user ID and CSRF token from meta tags
    let userId = $('meta[name="user-id"]').attr('content');
    let csrfToken = $('meta[name="csrf-token"]').attr('content');

    if (!userId) {
        showAlert('danger', "User ID is missing in meta tag!");
        return;
    }

    if (!csrfToken) {
        showAlert('danger', "CSRF token is missing in meta tag!");
        return;
    }

    // Get cropped image as a Blob
    cropper.getCroppedCanvas({
        width: 400, // Resize to 200x200
        height: 400,
        imageSmoothingQuality: 'high'
    }).toBlob((blob) => {
        let formData = new FormData();
        formData.append('_method', 'PATCH'); // Spoof PATCH
        formData.append('avatar', blob, 'avatar.png');

        // Send AJAX request to Laravel
        $.ajax({
            url: `/users/${userId}/avatar`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            beforeSend: function() {
                showLoading();
            },
            success: function(response) {
                $('.account-user-avatar img').attr('src', response.avatar_url);
                $('.profile-user-img img').attr('src', response.avatar_url);
                $('#profile-cropper-modal').modal('hide');
            },
            complete: function() {
                hideLoading();
                showAlert('success', 'Avatar updated successfully!');
            },
            error: function(xhr, status, error) {
                showAlert('danger', error);
                alert("Error uploading avatar: " + error);
                hideLoading();
            }
        });
    }, 'image/png');
}

// Button click event to upload cropped image
$uploadButton.on('click', function () {
    uploadCroppedImage();
});

import select2 from 'select2';
select2(window, jQuery);

import moment from "moment";
window.moment = moment;
import 'daterangepicker/moment.min.js';
import 'daterangepicker/daterangepicker.js';

import Dropzone from 'dropzone';

!function ($) {
    "use strict";

    var FileUpload = function () {
        this.$body = $("body");
    };

    /* Initializing */
    FileUpload.prototype.init = function () {
        // Disable auto discovery
        Dropzone.autoDiscover = false;

        $('[data-plugin="dropzone"]').each(function () {
            var actionUrl = $(this).attr('action'); // Keep actionUrl but don't use it directly
            var previewContainer = $(this).data('previewsContainer');

            var opts = {
                url: actionUrl, // Required but won't be used automatically
                maxFiles: 1, // Allow only one file
                addRemoveLinks: true, // Optionally add remove button
                autoProcessQueue: false, // Prevent automatic upload
                dictMaxFilesExceeded: "You can only upload one file at a time."
            };

            if (previewContainer) {
                opts['previewsContainer'] = previewContainer;
            }

            var uploadPreviewTemplate = $(this).data("uploadPreviewTemplate");
            if (uploadPreviewTemplate) {
                opts['previewTemplate'] = $(uploadPreviewTemplate).html();
            }

            var dropzoneEl = new Dropzone(this, opts);

            // Ensure only one file is uploaded at a time
            dropzoneEl.on("addedfile", function (file) {
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]); // Remove previous file
                }
            });

            // Manually process file instead of auto-submitting
            dropzoneEl.on("addedfile", function (file) {
                console.log("File added:", file);

                // Simulate file upload
                setTimeout(() => {
                    let fakeResponse = {
                        success: true,
                        filename: file.name,
                        fileUrl: URL.createObjectURL(file) // Generate temporary URL for preview
                    };
                    dropzoneEl.emit("success", file, fakeResponse);
                    dropzoneEl.emit("complete", file);
                }, 1000);
            });

            // Custom function when upload is complete
            dropzoneEl.on("success", function (file, response) {
                console.log("Custom function triggered, file uploaded:", response);
                onFileUploaded(response); // Call custom function
            });
        });
    };

    // Custom function to handle file upload
    function onFileUploaded(response) {
        console.log("File upload completed:", response);

        // Set the uploaded image as the Cropper source
        if (response.fileUrl) {
            setCropperImage(response.fileUrl);
        }
    }

    // Initialize FileUpload
    $.FileUpload = new FileUpload, $.FileUpload.Constructor = FileUpload;

}(window.jQuery),

// Initializing FileUpload
function ($) {
    "use strict";
    $.FileUpload.init();
}(window.jQuery);
