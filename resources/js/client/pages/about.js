import '/js/main.js'
import { getAssetUrl, fetchCollection } from '../services/publicAPI.js'

const features = (
  await fetchCollection('features?filter[status][_eq]=published')
).data

const lower = document.getElementById('lower')

features.forEach((feature) => {
  const li = document.createElement('li')
  li.className = 'feature space-y-[20px]'
  const { icon, title, description } = feature

  li.innerHTML = `
      <div class="space-x-[16px] title">
        <img src="${getAssetUrl(icon)}" alt="">
        <h3>${title}</h3>
      </div>
      <p>
        ${description}
      </p>
    `

  lower.appendChild(li)
})
