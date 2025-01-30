import 'cropper'

const $profileImage = $('#profile-image')

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
            var actionUrl = $(this).attr('action');
            var previewContainer = $(this).data('previewsContainer');

            var opts = {
                url: actionUrl,
                maxFiles: 1, // Allow only one file
                addRemoveLinks: true, // Optionally add remove button
                autoProcessQueue: true, // Automatically upload on selection
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
        });
    };

    //init fileupload
    $.FileUpload = new FileUpload, $.FileUpload.Constructor = FileUpload;

}(window.jQuery),

// Initializing FileUpload
function ($) {
    "use strict";
    $.FileUpload.init();
}(window.jQuery);
