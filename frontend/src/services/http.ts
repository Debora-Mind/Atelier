import axios from "axios";

const axiosInstance = axios.create({
    //baseURL: 'https://atelier2.000webhostapp.com/',
    //baseURL: 'https://do-and-make.com/',
    baseURL: 'http://localhost:8080/',

    headers: {
        'Content-type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'Access-Control-Allow-Origin': ['']
    },
    withCredentials: true

});

export default axiosInstance;