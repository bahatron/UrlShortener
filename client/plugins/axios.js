import axios from 'axios';

const http = axios.create({
    validateStatus: function(status) {
        return status >= 200 && status < 400; // default
    }
});

export default http;
