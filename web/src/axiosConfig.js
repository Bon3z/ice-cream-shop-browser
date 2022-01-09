import axios from 'axios'
import store from '@/store'

axios.defaults.baseURL = 'http://localhost:80/api/'

axios.interceptors.request.use(
  request => {
    const token = store.getters.getToken

    if (token) {
      request.headers.Authorization = `Bearer ${token}`
    }

    return request
  },
  error => Promise.reject(error)
)

export default {}
