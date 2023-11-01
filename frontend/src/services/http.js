import axios from "axios";
const axiosInstance = axios.create({
    // baseURL: 'https://do-and-make.com/',
    baseURL: 'http://localhost:8080/',
    headers: {
        'Content-type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'Access-Control-Allow-Origin': ['https://atelier-pearl.vercel.app/', 'http://localhost:8081/']
    },
    withCredentials: true
});
export default axiosInstance;
//# sourceMappingURL=http.js.map