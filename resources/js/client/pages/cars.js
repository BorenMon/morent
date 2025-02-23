import $ from "jquery";
import { formatToTwoDecimals, debounce } from "../services/utils.js";

const debouncedRefreshCars = debounce(function (value) {
    defaultRefreshCars(value, true);
}, 300);

let filter_count;
let total_page;

const displayCars = async (queryString) => {
    $("#skeleton-loading").removeClass("hidden");
    $("#loaded").addClass("hidden");

    try {
        const response = await fetch(`/cars/json?${queryString}`);
        const result = await response.json();

        const carData = result.data;
        filter_count = result.total; // Laravel's paginator provides total count
        total_page = result.last_page; // Last page number
        changePagination();

        const $cars = $("#cars"); // Select the container
        $cars.empty(); // Clear previous content

        carData.forEach((car) => {
            const {
                id,
                model,
                type,
                card_image_url,
                gasoline,
                steering,
                capacity,
                price,
                has_promotion,
                promotion_price,
            } = car;

            // Create car card using jQuery
            const $div = $("<div></div>")
                .addClass("car-card")
                .attr("data-id", id).html(`
                <div>
                  <div class="-mt-[5px]">
                    <div class="text-[20px] font-bold text-[#1A202C]">${model}</div>
                    <div class="text-[14px] font-bold text-[#90A3BF]">${type}</div>
                  </div>
                </div>
                <a href="/cars/${id}"><img src="${card_image_url}" alt=""></a>
                <div class="space-y-[24px]">
                  <div>
                    <div>
                      <img src="/client/icons/gas-station.svg" alt="" class="icon">
                      <span>${gasoline}L</span>
                    </div>
                    <div>
                      <img src="/client/icons/car.svg" alt="" class="icon">
                      <span>${steering}</span>
                    </div>
                    <div>
                      <img src="/client/icons/profile-2user.svg" alt="" class="icon">
                      <span>${capacity} People</span>
                    </div>
                  </div>
                  <div>
                    <div class="font-bold">
                      <div>
                        <span class="text-[20px] text-[#1A202C]">$${formatToTwoDecimals(
                            has_promotion ? promotion_price : price
                        )}/</span> <span class="text-[#90A3BF] text-[14px]">day</span>
                      </div>
                      ${
                          has_promotion
                              ? `<s class="text-[14px] text-[#90A3BF]">$${formatToTwoDecimals(
                                    price
                                )}</s>`
                              : ""
                      }
                    </div>
                    <button><a href="${getPaymentUrl(id)}">Book Now</a></button>
                  </div>
                </div>
            `);

            // Append each car card to the container
            $cars.append($div);
        });

        $("#skeleton-loading").addClass("hidden");
        $("#loaded").removeClass("hidden");
    } catch (error) {
        console.error("Error fetching cars:", error);
    }
};

const changePagination = () => {
    if (filter_count > 0) {
        $("#showing-from").text((page - 1) * 9 + 1);
        $("#showing-to").text(Math.min(page * 9, filter_count));
        $("#filter_count").text(filter_count);

        $("#pagination-container > div:nth-child(1)").css("display", "block");
        $("#pagination-container > div:nth-child(2)").css("display", "block");
        $("#pagination-container > p").css("display", "none");

        generatePagination(page, total_page);
    } else {
        $("#pagination-container > div:nth-child(1)").css("display", "none");
        $("#pagination-container > div:nth-child(2)").css("display", "none");
        $("#pagination-container > p").css("display", "block");
    }
};

function queryParamsBuilder(page, keyword, types, capacities, maxPrice) {
    let queryParams = new URLSearchParams();
    queryParams.append("page", page);

    if (keyword) {
        queryParams.append("search", keyword);
    }

    if (types.length > 0) {
        types.forEach((type) => queryParams.append("type[]", type));
    }

    if (capacities.length > 0) {
        capacities.forEach((capacity) =>
            queryParams.append("capacity[]", capacity)
        );
    }

    if (maxPrice) {
        queryParams.append("max_price", maxPrice);
    }

    return decodeURIComponent(queryParams.toString());
}

const defaultRefreshCars = (otherKeyword, restartPage) => {
    if (restartPage) page = 1;
    if (otherKeyword !== undefined) keyword = otherKeyword;

    refreshCars(queryParamsBuilder(page, keyword, types, capacities, maxPrice));
};

function refreshCars(queryString) {
    displayCars(queryString);
}

// Event listener for search input
$(".search-input").on("input", function () {
    const currentValue = $(this).val();
    $(".search-input").val(currentValue); // Sync inputs
    $("#skeleton-loading").removeClass("hidden");
    $("#loaded").addClass("hidden");
    debouncedRefreshCars(currentValue);
});

// Filter event listeners
$("#max-price").on("input", (e) => {
    maxPrice = $(e.target).val();
    $("#max-price-value").text(formatToTwoDecimals(maxPrice));
    debouncedRefreshCars();
});

$(".type-filter").on("change", function (e) {
    const value = e.target.value;
    if (e.target.checked) types.push(value);
    else types = types.filter((t) => t !== value);
    defaultRefreshCars();
});

$(".capacity-filter").on("change", function (e) {
    const value = e.target.value;
    if (e.target.checked) capacities.push(value);
    else capacities = capacities.filter((c) => c !== value);
    defaultRefreshCars();
});

// Initialize filters
const urlParams = new URLSearchParams(window.location.search);
let keyword = urlParams.get("keyword") || "";
let page = 1;
let types = [];
let capacities = [];
let maxPrice = 100;
defaultRefreshCars(keyword, false);

function generatePagination(currentPage, totalPages) {
    const paginationContainer = $("#pagination"); // Select the container

    // Clear existing pagination (if any)
    paginationContainer.empty();

    // Previous button
    const prevButton = $(
        '<div class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0"><span class="sr-only">Previous</span><img src="/client/icons/backward-arrow.svg" alt=""></div>'
    );

    // Disable when on first page
    if (currentPage === 1) {
        prevButton.addClass("disabled").css("pointer-events", "none");
    }

    paginationContainer.append(prevButton);

    // Number of pages to display before and after the current page
    const maxPagesToShow = 5;
    const halfMaxPages = Math.floor(maxPagesToShow / 2);

    // Calculate start and end page numbers to display
    let startPage = Math.max(1, currentPage - halfMaxPages);
    let endPage = Math.min(totalPages, currentPage + halfMaxPages);

    // Adjust if we're near the start or end
    if (currentPage - halfMaxPages <= 0) {
        endPage = Math.min(
            totalPages,
            endPage + (halfMaxPages - currentPage + 1)
        );
    }
    if (currentPage + halfMaxPages >= totalPages) {
        startPage = Math.max(
            1,
            startPage - (currentPage + halfMaxPages - totalPages)
        );
    }

    // Page links
    for (let i = startPage; i <= endPage; i++) {
        const pageLink = $(
            '<div class="cursor-pointer relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0"></div>'
        );
        pageLink.text(i);

        // Highlight the current page
        if (i === currentPage) {
            pageLink.addClass("z-10 bg-[#3563E9] text-white");
        }

        paginationContainer.append(pageLink);

        // Add event listener to each page link
        pageLink.on("click", function (e) {
            e.preventDefault();
            generatePagination(i, totalPages); // Regenerate pagination for selected page
            page = i;
            defaultRefreshCars(undefined, false);
        });
    }

    // If there are pages not displayed, add ellipsis
    if (endPage < totalPages) {
        const ellipsis = $(
            '<span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>'
        );
        paginationContainer.append(ellipsis);
    }

    // Next button
    const nextButton = $(
        '<div class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0"><span class="sr-only">Next</span><img src="/client/icons/forward-arrow.svg" alt=""></div>'
    );

    // Disable when on last page
    if (currentPage === totalPages) {
        nextButton.addClass("disabled").css("pointer-events", "none");
    }

    paginationContainer.append(nextButton);

    // Add event listeners for previous and next buttons
    prevButton.on("click", function (e) {
        prevAction(e, totalPages);
    });

    nextButton.on("click", function (e) {
        nextAction(e, totalPages);
    });
}

const prevAction = (e, totalPages) => {
    e.preventDefault();
    if (page > 1) {
        generatePagination(page - 1, totalPages); // Go to previous page
        --page;
        defaultRefreshCars(undefined, false);
    }
};

const nextAction = (e, totalPages) => {
    e.preventDefault();
    if (page < totalPages) {
        generatePagination(page + 1, totalPages); // Go to next page
        ++page;
        defaultRefreshCars(undefined, false);
    }
};

$("#prev-button").on("click", (e) => prevAction(e, total_page));
$("#next-button").on("click", (e) => nextAction(e, total_page));

const paymentBaseUrl = $('meta[name="payment-base-url"]').attr("content");

function getPaymentUrl(carId) {
    if (paymentBaseUrl != "#") {
        return paymentBaseUrl.replace("#", carId);
    }

    return "#";
}

$("#types li input").each(function () {
    $(this).on("change", function (e) {
        if (e.target.checked) {
            types.push(e.target.value);
        } else {
            types = types.filter((type) => type !== e.target.value);
        }
        defaultRefreshCars(undefined, true);
    });
});

const capacityChecks = [
    $('input[id="2 Person"]'),
    $('input[id="4 Person"]'),
    $('input[id="6 Person"]'),
    $('input[id="8 or More"]'),
];

capacityChecks.forEach((capacity) => {
    capacity.on("change", (e) => {
        if (e.target.checked) {
            capacities.push(e.target.value);
        } else {
            capacities = capacities.filter(
                (capacity) => capacity !== e.target.value
            );
        }
        defaultRefreshCars(undefined, true);
    });
});

$("#filter-button").on("click", () => {
    $("#filter").addClass("open");
    $("#filter-backdrop").css("display", "block");
});

const closeFilter = () => {
    $("#filter-backdrop").css("display", "none");
    $("#filter").removeClass("open");
};

$("#close-filter").on("click", closeFilter);
$("#filter-backdrop").on("click", closeFilter);

const filterHandleResize = (e) => {
    if (e.matches) {
        closeFilter();
    }
};

const filterMediaQuery = window.matchMedia("(min-width: 1100px)");

filterMediaQuery.addEventListener("change", filterHandleResize);
