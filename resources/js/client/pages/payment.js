import { cities } from "../config/location.master-data.js";
import { sweetalert, toast } from "../services/sweetalert2.js";
import $ from "jquery";
import select2 from "select2";
import Viewer from "viewerjs";
import { FileUploadWithPreview, Events } from 'file-upload-with-preview';
import 'file-upload-with-preview/dist/style.css';

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

let userId = $('meta[name="user-id"]').attr("content");
let carId = $('meta[name="car-id"]').attr("content");
let csrfToken = $('meta[name="csrf-token"]').attr("content");

$("#book-button").on("click", async function () {
    if (!isMissingRequiredData()) {
        $(this).addClass("disabled-button");
        $("#loading-backdrop").css("display", "flex");

        // Construct FormData for file upload (payment proof)
        let formData = new FormData();
        formData.append("car_id", carId);
        formData.append("customer_id", userId);
        formData.append("pick_up_city", requiredPayload.pick_up_city);
        formData.append("pick_up_datetime", requiredPayload.pick_up_datetime);
        formData.append("drop_off_city", requiredPayload.drop_off_city);
        formData.append("drop_off_datetime", requiredPayload.drop_off_datetime);
        formData.append("name", requiredPayload.name);
        formData.append("phone", requiredPayload.phone);
        formData.append("address", requiredPayload.address);
        formData.append("payment_proof", paymentProof.cachedFileArray[0]);

        try {
            const response = await fetch("/book", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
            });

            if (!response.ok) {
                const result = await response.json();

                if (response.status === 422) {
                    // Handle validation errors
                    const errorMessages = result.errors || [];
                    let errorText = "Please fix the following errors:\n";

                    // Format the error messages into a readable string
                    for (const [field, messages] of Object.entries(errorMessages)) {
                        errorText += `${field}: ${messages.join(", ")}\n`;
                    }

                    toast(errorText, "error"); // Show the validation errors to the user
                } else {
                    // Handle other non-OK responses
                    throw new Error(result.message || "Something went wrong");
                }
            } else {
                // If status is 201 (Created) and booking is successful
                sweetalert
                    .fire({
                        title: "Booking Successful!",
                        text: "Your booking has been confirmed.",
                        icon: "success",
                        confirmButtonColor: "#3563E9",
                        confirmButtonText: "OK",
                    })
                    .then(() => {
                        $("#loading-backdrop").css("display", "none");
                        window.location.href = "/profile#bookings";
                    });
            }
        } catch (error) {
            $("#loading-backdrop").css("display", "none");
            toast(error.message, "error");
        } finally {
            $(this).removeClass("disabled-button");
        }
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
