import { cities } from "../config/location.master-data.js";
import $ from "jquery";
import select2 from "select2";
import Viewer from "viewerjs";
import { FileUploadWithPreview, Events } from 'file-upload-with-preview';
import 'file-upload-with-preview/dist/style.css';
import { formatToTwoDecimals } from '../services/utils.js'

const paymentProof = new FileUploadWithPreview('payment-proof');

new Viewer(document.getElementById('khqr'), {
  inline: false,
  navbar: false,
  toolbar: {
      zoomIn: true,
      zoomOut: true,
      play: {
          show: true,
      },
      rotateLeft: false,
      rotateRight: false,
      flipHorizontal: false,
      flipVertical: false,
  },
});

select2();

$(".city").select2({
    width: "100%",
    data: [{ id: "0", text: "Select your city", value: "" }, ...cities],
});

const requiredFields = [
    {
        selector: "#name-input",
        message: "Please enter your name.",
        key: "name",
    },
    {
        selector: "#phone-input",
        message: "Please enter a phone number.",
        key: "phone",
    },
    {
        selector: "#address-input",
        message: "Please enter an address.",
        key: "address",
    },
    {
        selector: "#pick-up .city",
        message: "Please select a pick-up city.",
        key: "pick_up_city",
    },
    {
        selector: "#pick-up .date",
        message: "Please select a pick-up date.",
        key: "pick_up_datetime",
    },
    {
        selector: "#drop-off .city",
        message: "Please select a drop-off city.",
        key: "drop_off_city",
    },
    {
        selector: "#drop-off .date",
        message: "Please select a drop-off date.",
        key: "drop_off_datetime",
    },
    {
        selector: 'input[name="terms"]',
        message: "Please agree to Terms and Conditions before booking.",
        key: "terms",
        type: "checkbox",
    },
];

const optionalFields = [
    {
        selector: 'input[name="marketing"]',
        key: "marketing",
        type: "checkbox",
    },
];

const requiredPayload = {
    name: $("#name-input").val(),
    phone: $("#phone-input").val(),
    address: $("#address-input").val(),
    pick_up_city: $("#pick-up .city").val(),
    pick_up_datetime: $("#pick-up .date").val(),
    drop_off_city: $("#drop-off .city").val(),
    drop_off_datetime: $("#drop-off .date").val(),
    terms: $('input[name="terms"]').is(":checked"),
};

const optionalPayload = {
    marketing: $('input[name="marketing"]').is(":checked"),
};

const isMissingRequiredData = () => {
    if (paymentProof.cachedFileArray.length == 0) return true;

    return Object.keys(requiredPayload).some((key) => {
        if (requiredPayload[key] == false) return true;
        if (requiredPayload[key] == "" || requiredPayload[key] == "0")
            return true;
        return false;
    })
}

const checkBookButton = () => {
    if (isMissingRequiredData()) $("#book-button").addClass("disabled-button");
    else $("#book-button").removeClass("disabled-button");
};

checkBookButton();

$("#book-button").on("click", async function () {
    if (!isMissingRequiredData()) {
        $(this).addClass("disabled-button");
        $("#loading-backdrop").css("display", "flex");

        // Create a DataTransfer object to store the file
        let dataTransfer = new DataTransfer();
        dataTransfer.items.add(paymentProof.cachedFileArray[0]);

        // Assign the file to the hidden input field
        let fileInput = document.querySelector('input[name="payment_proof"]');
        fileInput.files = dataTransfer.files;

        document.querySelector(".payment-main").submit();
    }
});

requiredFields.forEach((field) => {
    $(field.selector).on("input", () => {
        if (field.type)
            requiredPayload[field.key] = $(field.selector).is(":checked");
        else requiredPayload[field.key] = $(field.selector).val();
        checkBookButton();
    });
});

window.addEventListener(Events.IMAGE_ADDED, () => {
    checkBookButton();
});
window.addEventListener(Events.CLEAR_BUTTON_CLICKED, () => {
    checkBookButton();
});

optionalFields.forEach((field) => {
    $(field.selector).on("input", () => {
        if (field.type)
            optionalPayload[field.key] = $(field.selector).is(":checked");
        else optionalPayload[field.key] = $(field.selector).val();
    });
});

let pricePerDay = +$('meta[name="price-per-day').attr('content');
let taxPercentage = 0;

function updatePrice() {
    const startDate = $('input[name="pick_up_datetime"]').val()
    const endDate = $('input[name="drop_off_datetime"]').val();
    const start = new Date(startDate);
    const end = new Date(endDate);
    const duration = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) || 0;

    $('#duration').text(duration + ' days');
    const subTotal = duration * pricePerDay;
    $('#sub-total').text('$' + formatToTwoDecimals(subTotal));
    const tax = subTotal * taxPercentage / 100;
    $('#tax').text('$' + formatToTwoDecimals(tax));
    $('#total').text('$' + formatToTwoDecimals(subTotal + tax));
}

updatePrice();

$('input[name="pick_up_datetime"]').on('change', updatePrice);
$('input[name="drop_off_datetime"]').on('change', updatePrice);
