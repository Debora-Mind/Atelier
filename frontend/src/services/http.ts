import axios from "axios";

const axiosInstance = axios.create({
    baseURL: 'https://atelier-8ws4hjml4-debora-mind.vercel.app',
    headers: {
        'Content-type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'Access-Control-Allow-Origin': ['http://localhost:8081', 'https://atelier-pearl.vercel.app/', 'https://atelier-8ws4hjml4-debora-mind.vercel.app']
    },
    withCredentials: true

});

export default axiosInstance;