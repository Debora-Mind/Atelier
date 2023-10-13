import axios from "axios";

const axiosInstance = axios.create({
    baseURL: 'https://do-and-make.com/',
    headers: {
        'Content-type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'Access-Control-Allow-Origin': 'https://atelier-pearl.vercel.app/'
    },
    withCredentials: true

});

export default axiosInstance;