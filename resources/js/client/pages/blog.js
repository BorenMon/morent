import '/js/main.js'
import '/js/modules/splide.min.js'
import { fetchCollection, fetchItemById, getAssetUrl  } from '../services/publicAPI.js'
import { formatISODate } from '../services/utils.js';

// Get the current URL
const urlParams = new URLSearchParams(window.location.search);

// Get the value of the 'id' parameter
const id = urlParams.get('id');

if (id) {
  // Fetch the item by ID
  fetchItemById('blogs', id)
   .then(item => {
      $('#published-date').text(formatISODate(item.date_created));
      $('#title').text(item.title);
      $('#description').text(item.description);
      let tags = item.tags ? item.tags.split(',').map(tag => tag.trim()) : [];
      $('#tags').append($.map(tags, function(tag) {
        return `<li class="tag">${tag}</li>`;
      }));
      $('#thumbnail').attr('src', getAssetUrl(item.thumbnail));

      // Create a shadow root for blog content
      const blogContainer = document.getElementById('blog-content');
      const shadowRoot = blogContainer.attachShadow({ mode: 'open' });

      // Append your content inside the shadow DOM
      shadowRoot.innerHTML = item.content;

      if (tags.length > 0) {
        $('#related-container').css({ display: 'block'});
        const displayRelated = async () => {
          tags = tags.join(' ').split(' ');
          const relatedQuery = tags.map((tag, i) => {
            return `filter[_or][${i}][tags][_contains]=${tag}`;
          }).join('&');
          const relateds = (await fetchCollection(`blogs?limit=9&filter[status][_eq]=published&${relatedQuery}`)).data;
        
          const postsWrapper = document.getElementById('posts-wrapper');
          postsWrapper.innerHTML = ''; // Clear previous content
        
          relateds.forEach((related) => {
            const li = document.createElement('li');
            li.className = 'splide__slide post-card';
            const {
              id,
              thumbnail,
              date_created,
              title,
              description
            } = related;
            
            li.innerHTML = `
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
            `
        
            postsWrapper.appendChild(li);
          });
        }
        
        displayRelated().then(() => {
          new Splide('#related', {
            type: 'loop',
            autoplay: true,
            interval: 3000,
            arrows: false,
            pagination: false,
            gap: '32px',
            perPage: 3,
            breakpoints: {
              1200: {
                perPage: 2
              },
              900: {
                perPage: 1
              }
            }
          }).mount();

          $('.skeleton-loading').addClass('!hidden');
          $('.loaded').removeClass('!hidden');
        });
      }
    })
   .catch(error => {
      $('#body-wrapper').html(`
        <div id="body" class="container-fluid text-center">
          <h2 class="text-2xl font-bold text-[#333333] my-[128px]">${error.message}</h2>
        </div>
      `);
      console.error('Error fetching blog:', error);
    });
} else {
  window.location.href = '/pages/blogs.html';
}