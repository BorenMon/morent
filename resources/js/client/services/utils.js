export const formatToTwoDecimals = (value) => {
  return parseFloat(value).toFixed(2)
}

export const formatISODate = (isoDate) => {
  const date = new Date(isoDate)
  const options = { year: 'numeric', month: 'long', day: 'numeric' }
  return date.toLocaleDateString('en-US', options)
}

export const redirectSearch = (keyword) => {
  const isLocalhost = window.location.hostname === '127.0.0.1';
  
  // If on localhost, include `.html`, otherwise omit it for Netlify's pretty URLs
  const extension = isLocalhost ? '.html' : '';
  window.location.href = `/pages/category${extension}?keyword=${keyword}`;
}

export function debounce(func, delay) {
  let timeout
  return function (...args) {
    clearTimeout(timeout)
    timeout = setTimeout(() => func.apply(this, args), delay)
  }
}

export function areObjectsEqual(obj1, obj2) {
  // Check if both are objects
  if (typeof obj1 !== "object" || typeof obj2 !== "object" || obj1 === null || obj2 === null) {
      return false; // Either not objects or one is null
  }

  // Get keys of both objects
  const keys1 = Object.keys(obj1);
  const keys2 = Object.keys(obj2);

  // Check if number of keys is the same
  if (keys1.length !== keys2.length) {
      return false;
  }

  // Check if all keys and their values are equal
  return keys1.every(key => obj2.hasOwnProperty(key) && obj1[key] === obj2[key]);
}

/**
 * Converts a snake_case string to Capitalized Case with spaces replacing underscores.
 * 
 * @param {string} snakeCaseStr - The snake_case string to be converted.
 * @returns {string} - The string converted to Capitalized Case with spaces.
 */
export function snakeToCapitalizedWithSpaces(snakeCaseStr) {
  return snakeCaseStr
      .split('_') // Split the string by underscores
      .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()) // Capitalize each word
      .join(' '); // Join the words with spaces
}
