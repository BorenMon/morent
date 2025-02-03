import axios from '../modules/axios.min.js';
import serviceConfig from '../config/service.config.js';
import { logout } from './auth.js';
import api from './authAPI.js'

const serviceApi = axios.create({
  baseURL: serviceConfig.baseURL,
  headers: {
      'Content-Type': 'application/json',
  },
});

// Request interceptor to add the token to each request
serviceApi.interceptors.request.use(
  config => {
      const token = localStorage.getItem("access_token");
      if (token) {
          config.headers['Authorization'] = `Bearer ${token}`;
      }
      return config;
  },
  error => Promise.reject(error)
);

// Response interceptor to handle 401 error
serviceApi.interceptors.response.use(
  response => response,
  async error => {
      const originalRequest = error.config;

      if (error.response && (error.response.status === 401)) {
          // Attempt to refresh the token if we have a refresh token
          const refreshToken = localStorage.getItem("refresh_token");

          if (refreshToken) {
              try {
                  const { data } = await axios.post(`${api.defaults.baseURL}/auth/refresh`, {
                      refresh_token: refreshToken,
                  });

                  // Store the new tokens and retry the original request
                  localStorage.setItem("access_token", data.data.access_token);
                  localStorage.setItem("refresh_token", data.data.refresh_token);
                  originalRequest.headers['Authorization'] = `Bearer ${data.data.access_token}`;
                  originalRequest._retry = true; // Prevent infinite retry loop

                  return serviceApi(originalRequest);
              } catch (refreshError) {
                  console.error("Token refresh failed:", refreshError);
                  logout(); // If refresh fails, logout the user
              }
          } else {
              logout(); // If no refresh token or refresh failed
          }
      }

      return Promise.reject(error);
  }
);

export default serviceApi;