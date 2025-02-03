import axios from '../modules/axios.min.js';
import directusConfig from '../config/directus.config.js';

// Create an axios instance with the base URL from the config
const api = axios.create({
  baseURL: `${directusConfig.baseURL}/items`,
});

// Function to get the full URL of an asset file
export const getAssetUrl = (fileId) => {
  return `${directusConfig.baseURL}/assets/${fileId}`;
};

// Fetch all items from a specific collection
export const fetchCollection = async (collectionName) => {
  try {
    const response = await api.get(`/${collectionName}`);
    return response.data; // Directus response typically has a 'data' object
  } catch (error) {
    console.error(`Error fetching ${collectionName}:`, error);
    throw error;
  }
};

// Fetch a single item by ID from a specific collection
export const fetchItemById = async (collectionName, itemId) => {
  try {
    const response = await api.get(`/${collectionName}/${itemId}`);
    return response.data.data; // Return the specific item
  } catch (error) {
    console.error(`Error fetching item ${itemId} from ${collectionName}:`, error);
    throw error;
  }
};
