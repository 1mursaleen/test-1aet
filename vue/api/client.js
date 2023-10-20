import axios from 'axios'
// window.axios = axios

window.axios = axios.create({
    baseURL: import.meta.env.VITE_APP_API_URL,
    headers: {
        'X-Requested-With': 'XMLHttpRequest'
    },
    withCredentials: true
    // timeout: 1000,
})

