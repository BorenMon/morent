import 'cropper'
import { showLoading, hideLoading, showAlert } from '../../uiHelpers';
import * as FilePond from "filepond";
import FilePondPluginFileEncode from "filepond-plugin-file-encode";
import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import FilePondPluginImageExifOrientation from "filepond-plugin-image-exif-orientation";

const $image = $('#image');
const $uploadButton = $('#upload-cropped-image');

// Function to initialize Cropper
function initCropper() {
    $image.cropper('destroy'); // Destroy any existing instance
    $image.cropper({
        viewMode: 1,  // Ensures it fits within the container
        autoCropArea: 1, // Ensures the crop area takes full space
        responsive: true
    });
}

// Function to set the uploaded image as Cropper source
function setCropperImage(imageUrl) {
    $image.attr('src', imageUrl); // Update the image source
    $image.on('load', function () {
        initCropper(); // Reinitialize Cropper when the image is loaded
    });
}

// Listen for Bootstrap modal 'shown' event
$('#image-cropper-modal').on('shown.bs.modal', function () {
    initCropper(); // Initialize Cropper when modal is fully shown
});

// If modal is forced open during development, manually trigger
$(document).ready(function () {
    if ($('#image-cropper-modal').hasClass('show')) {
        initCropper();
    }
});

let csrfToken = $('meta[name="csrf-token"]').attr('content');
let carId = $('meta[name="car-id"]').attr('content');

// Function to upload the cropped image
function uploadCroppedImage() {
    let cropper = $image.data('cropper');

    if (!cropper) {
        alert("Cropper not initialized!");
        return;
    }

    if (!carId) {
        showAlert('danger', "Car ID is missing in meta tag!");
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
        formData.append('image', blob, 'image.png');

        // Send AJAX request to Laravel
        $.ajax({
            url: `/admin/cars/${carId}/image`,
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
                $('#car-image').attr('src', response.image_url);
                $('#image-cropper-modal').modal('hide');
            },
            complete: function() {
                hideLoading();
                showAlert('success', 'Image updated successfully!');
            },
            error: function(xhr, status, error) {
                showAlert('danger', error);
                alert("Error uploading image: " + error);
                hideLoading();
            }
        });
    }, 'image/png');
}

// Button click event to upload cropped image
$uploadButton.on('click', function () {
    uploadCroppedImage();
});

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

// Register FilePond plugins
FilePond.registerPlugin(
    FilePondPluginFileEncode,
    FilePondPluginFileValidateSize,
    FilePondPluginImageExifOrientation,
    FilePondPluginImagePreview
);

const carImages = JSON.parse($('meta[name="car-images"]').attr("content") || "[]");

let existingImages = carImages.map((imagePath) => ({
    source: imagePath,
    options: {
        type: "local",
        metadata: { object_name: imagePath },
    },
}));

const pond = FilePond.create(document.querySelector('input[name="car-images"]'), {
    allowMultiple: true,
    stylePanelAspectRatio: 1,
    imagePreviewHeight: 100,
    files: existingImages,

    onaddfile: async (error, file) => {
        if (error) {
            toast(`${error.main}, ${error.sub}`, "error");
            pond.removeFile(file);
            return;
        }

        if (!file.getMetadata().object_name && !file.getMetadata().reverted) {
            sweetalert
                .fire({
                    title: "Are you sure you want to upload this file?",
                    text: "Once added, it will be stored in the car's gallery.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3563E9",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                })
                .then(async (result) => {
                    if (result.isConfirmed) {
                        const formData = new FormData();
                        formData.append("image", file.file);

                        try {
                            const response = await fetch(`/admin/cars/${carId}/images`, {
                                method: "POST",
                                body: formData,
                                headers: { "X-CSRF-TOKEN": csrfToken },
                            });

                            const data = await response.json();
                            file.setMetadata("object_name", data.image_path);
                        } catch (uploadError) {
                            console.error("File upload failed:", uploadError);
                            pond.removeFile(file);
                        }
                    } else {
                        pond.removeFile(file);
                    }
                });
        }
    },

    onremovefile: async (error, file) => {
        if (error) {
            console.error(error);
            return;
        }

        if (file.getMetadata().object_name) {
            sweetalert
                .fire({
                    title: "Are you sure you want to remove this file?",
                    text: "This action will permanently remove the image from the car's gallery.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3563E9",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                })
                .then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            await fetch(`/admin/cars/${carId}/images/${file.getMetadata().object_name}`, {
                                method: "DELETE",
                                headers: { "X-CSRF-TOKEN": csrfToken },
                            });
                        } catch (removeError) {
                            console.error("File removal failed:", removeError);
                        }
                    } else {
                        pond.addFile(file.file, {
                            metadata: {
                                object_name: file.getMetadata().object_name,
                                reverted: true,
                            },
                        });
                    }
                });
        }
    },
});
