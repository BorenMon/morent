import $ from "jquery";
import { redirectSearch } from "./services/utils.js";
import { toast } from "./services/sweetalert2.js";
import sweetalert2 from "sweetalert2";

// Function to open mobile menu
$("#menu-icon").on("click", () => {
    $("#mobile-menu").css("transform", "translateX(0)");
    $("#nav-backdrop").css("display", "block");
});

// Function to close mobile menu
const closeMobileMenu = () => {
    $("#mobile-menu").css("transform", "translateX(100%)");
    $("#nav-backdrop").css("display", "none");
};

// Close mobile menu on backdrop click or close icon click
$("#nav-backdrop").on("click", closeMobileMenu);
$("#close-icon").on("click", closeMobileMenu);

// Media query function to auto-close menu at specific screen width
const handleResize = (e) => {
    if (e.matches) {
        // If the screen width is smaller or equal to 1024px
        closeMobileMenu(); // Automatically close the mobile menu
    }
};

// Create a media query list object to watch for screen width <= 1024px
const mediaQuery = window.matchMedia("(min-width: 1024px)"); // Adjust to your desired screen width

// Add listener to the media query to handle screen size change
mediaQuery.addEventListener("change", handleResize);

// Search Implementation
const inputs = document.querySelectorAll(".search-input");
const searchButtons = document.querySelectorAll(".search-icon");

if (!window.location.pathname.includes("/cars")) {
    inputs.forEach((input) => {
        input.addEventListener("keypress", function (event) {
            // Check if the pressed key is Enter
            if (event.key === "Enter") {
                // Prevent the default action (if necessary)
                event.preventDefault();

                redirectSearch(input.value);
            }
        });

        input.addEventListener("input", function () {
            const currentValue = input.value;
            inputs.forEach((otherInput) => {
                // Update all other inputs except the current one
                if (otherInput !== input) {
                    otherInput.value = currentValue;
                }
            });
        });
    });

    searchButtons.forEach((button) => {
        button.addEventListener("click", () => {
            redirectSearch(inputs[0].value);
        });
    });
}

const profileImage = document.getElementById("nav-profile");
if (profileImage) {
    const dropdownMenu = profileImage.nextElementSibling; // Selects the dropdown div next to the image

    profileImage.addEventListener("click", function (event) {
        event.stopPropagation(); // Prevents the click from bubbling up
        dropdownMenu.classList.toggle("hidden"); // Toggles the visibility
    });

    document.addEventListener("click", function (event) {
        // Hide dropdown if clicked outside
        if (
            !dropdownMenu.contains(event.target) &&
            !profileImage.contains(event.target)
        ) {
            dropdownMenu.classList.add("hidden");
        }
    });
}

$(".logout").on("click", (e) => {
    e.preventDefault();
    sweetalert2
        .fire({
            title: "Are you sure to logout?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3563E9",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        })
        .then((result) => {
            if (result.isConfirmed) {
                fetch("/logout", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    credentials: "same-origin",
                }).then(() => {
                    toast("You have been logged out.", "success");
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                });
            }
        });
});
