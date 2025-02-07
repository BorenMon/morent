/**
 * Theme: Velonic - Responsive Bootstrap 5 Admin Dashboard
 * Author: Techzaa
 * Module/App: Time Picker
 */

import t from 'bootstrap-touchspin'
t(window, jQuery);

import moment from 'moment'
window.moment = moment;


// import 'daterangepicker/moment.min.js';
import daterangepicker from 'daterangepicker/daterangepicker.js'
window.daterangepicker = daterangepicker;
import 'bootstrap-timepicker/js/bootstrap-timepicker.min.js';
import  'bootstrap-maxlength/dist/bootstrap-maxlength.min.js';

import 'flatpickr/dist/flatpickr.js'
import 'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js';

import './timepicker.init'
import './typehead.init'


import 'jquery-mask-plugin'

if ($.mask) {
    $('[data-toggle="input-mask"]').each(function (idx, obj) {
        var maskFormat = $(obj).data("maskFormat");
        var reverse = $(obj).data("reverse");
        if (reverse != null)
            $(obj).mask(maskFormat, { 'reverse': reverse });
        else
            $(obj).mask(maskFormat);
    });
}
