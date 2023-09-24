import axios from "axios";

const axiosInstance = axios.create({
    baseURL: 'https://atelier-pearl.vercel.app/',
    headers: {
        'Content-type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'Access-Control-Allow-Origin': 'https://atelier-pearl.vercel.app/'
    },
    withCredentials: true

});

export default axiosInstance;