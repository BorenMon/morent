import '../main.js'
import { getAssetUrl, fetchCollection } from '../services/publicAPI.js'
import { formatISODate, debounce } from '../services/utils.js'

let filter_count
let total_page

const displayBlogs = async (queryString) => {
  $('#skeleton-loading').removeClass('hidden');
  $('#loaded').addClass('hidden');

  const result = await fetchCollection(`blogs?${queryString}`)

  const blogsData = result.data
  filter_count = result.meta.filter_count
  total_page = Math.ceil(filter_count / 9)
  changePagination()

  const $blogs = $('#posts-grid') // Select the container
  $blogs.empty() // Clear previous content

  blogsData.forEach((blog) => {
    const {
      id,
      thumbnail,
      date_created,
      title,
      description
    } = blog

    const $div = $('<div></div>').addClass('post-card').html(`
        <a href="/pages/blog.html?id=${id}">
          <img
            src="${getAssetUrl(thumbnail)}"
            alt="thumbnail"
          />
        </a>
        <div class="post-content">
          <a class="author">${formatISODate(date_created)}</a>
          <a href="/pages/blog.html?id=${id}" class="post-title">${title}</a>
          <p>${description}</p>
        </div>
      `)

    $blogs.append($div)
  })

  $('#skeleton-loading').addClass('hidden');
  $('#loaded').removeClass('hidden');
}

const prefixBlogsQueryString =
  'filter[status][_eq]=published&meta=filter_count&limit=9'

let keyword = ''
let page = 1

// Function to generate pagination dynamically
function generatePagination(currentPage, totalPages) {
  const paginationContainer = $('#pagination') // Select the container

  // Clear existing pagination (if any)
  paginationContainer.empty()

  // Previous button
  const prevButton = $(
    '<div class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0"><span class="sr-only">Previous</span><img src="/assets/icons/backward-arrow.svg" alt=""></div>'
  )

  // Disable when on first page
  if (currentPage === 1) {
    prevButton.addClass('disabled').css('pointer-events', 'none')
  }

  paginationContainer.append(prevButton)

  // Number of pages to display before and after the current page
  const maxPagesToShow = 5
  const halfMaxPages = Math.floor(maxPagesToShow / 2)

  // Calculate start and end page numbers to display
  let startPage = Math.max(1, currentPage - halfMaxPages)
  let endPage = Math.min(totalPages, currentPage + halfMaxPages)

  // Adjust if we're near the start or end
  if (currentPage - halfMaxPages <= 0) {
    endPage = Math.min(totalPages, endPage + (halfMaxPages - currentPage + 1))
  }
  if (currentPage + halfMaxPages >= totalPages) {
    startPage = Math.max(
      1,
      startPage - (currentPage + halfMaxPages - totalPages)
    )
  }

  // Page links
  for (let i = startPage; i <= endPage; i++) {
    const pageLink = $(
      '<div class="cursor-pointer relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0"></div>'
    )
    pageLink.text(i)

    // Highlight the current page
    if (i === currentPage) {
      pageLink.addClass('z-10 bg-[#3563E9] text-white')
    }

    paginationContainer.append(pageLink)

    // Add event listener to each page link
    pageLink.on('click', function (e) {
      e.preventDefault()
      generatePagination(i, totalPages) // Regenerate pagination for selected page
      page = i
      defaultRefreshBlogs(undefined, false)
    })
  }

  // If there are pages not displayed, add ellipsis
  if (endPage < totalPages) {
    const ellipsis = $(
      '<span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>'
    )
    paginationContainer.append(ellipsis)
  }

  // Next button
  const nextButton = $(
    '<div class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0"><span class="sr-only">Next</span><img src="/assets/icons/forward-arrow.svg" alt=""></div>'
  )

  // Disable when on last page
  if (currentPage === totalPages) {
    nextButton.addClass('disabled').css('pointer-events', 'none')
  }

  paginationContainer.append(nextButton)

  // Add event listeners for previous and next buttons
  prevButton.on('click', function (e) {
    prevAction(e, totalPages)
  })

  nextButton.on('click', function (e) {
    nextAction(e, totalPages)
  })
}

const prevAction = (e, totalPages) => {
  e.preventDefault()
  if (page > 1) {
    generatePagination(page - 1, totalPages) // Go to previous page
    --page
    defaultRefreshBlogs(undefined, false)
  }
}

const nextAction = (e, totalPages) => {
  e.preventDefault()
  if (page < totalPages) {
    generatePagination(page + 1, totalPages) // Go to next page
    ++page
    defaultRefreshBlogs(undefined, false)
  }
}

$('#prev-button').on('click', (e) => prevAction(e, total_page))
$('#next-button').on('click', (e) => nextAction(e, total_page))

const changePagination = () => {
  if (filter_count > 0) {
    $('#showing-from').text((page - 1) * 9 + 1)
    $('#showing-to').text(Math.min(page * 9, filter_count))
    $('#filter_count').text(filter_count)

    $('#pagination-container > div:nth-child(1)').css('display', 'block')
    $('#pagination-container > div:nth-child(2)').css('display', 'block')
    $('#pagination-container > p').css('display', 'none')

    generatePagination(page, total_page)
  } else {
    $('#pagination-container > div:nth-child(1)').css('display', 'none')
    $('#pagination-container > div:nth-child(2)').css('display', 'none')
    $('#pagination-container > p').css('display', 'block')
  }
}

function refreshBlogs(queryString) {
  displayBlogs(queryString)
}

function queryParamsBuilder(page, keyword) {
  let queryParams = new URLSearchParams()

  // Add pagination parameters
  queryParams.append('page', page)

  // Add keyword search for multiple fields (e.g., title, description)
  if (keyword) {
    queryParams.append('search', keyword)
  }

  // Return the complete query string
  return decodeURIComponent(queryParams.toString())
}

const defaultRefreshBlogs = (otherKeyword, restartPage) => {
  if (restartPage) page = 1
  if (otherKeyword !== undefined) {
    keyword = otherKeyword
  }
  refreshBlogs(prefixBlogsQueryString + '&' + queryParamsBuilder(page, keyword))
}

const debounceRefreshBlogs = debounce(function () {
  defaultRefreshBlogs(undefined, true)
}, 300)

const searchBlogsInput = document.getElementById('search-blogs')
searchBlogsInput.addEventListener('input', () => {
  keyword = searchBlogsInput.value;

  $('#skeleton-loading').removeClass('hidden');
  $('#loaded').addClass('hidden');

  debounceRefreshBlogs()
})

defaultRefreshBlogs(undefined, true);
