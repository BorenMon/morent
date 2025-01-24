/**
* Theme: Velonic - Responsive Bootstrap 5 Admin Dashboard
* Author: Techzaa
* Component: Dragula component
*/

import select2 from 'select2';
select2(window, jQuery);

import moment from "moment"
window.moment = moment;
import 'daterangepicker/moment.min.js';
import 'daterangepicker/daterangepicker.js';

import Dropzone from 'dropzone';

!function ($) {
    "use strict";

    var FileUpload = function () {
        this.$body = $("body")
    };


    /* Initializing */
    FileUpload.prototype.init = function () {
        // Disable auto discovery

        Dropzone.autoDiscover = false;



        $('[data-plugin="dropzone"]').each(function () {
            var actionUrl = $(this).attr('action')
            var previewContainer = $(this).data('previewsContainer');

            var opts = { url: actionUrl};
            if (previewContainer) {
                opts['previewsContainer'] = previewContainer;
            }

            var uploadPreviewTemplate = $(this).data("uploadPreviewTemplate");
            if (uploadPreviewTemplate) {
                opts['previewTemplate'] = $(uploadPreviewTemplate).html();
            }

            var dropzoneEl = $(this).dropzone(opts);
            
        });
    },

        //init fileupload
        $.FileUpload = new FileUpload, $.FileUpload.Constructor = FileUpload

}(window.jQuery),

//initializing FileUpload
function ($) {
"use strict";
    $.FileUpload.init()
}(window.jQuery);