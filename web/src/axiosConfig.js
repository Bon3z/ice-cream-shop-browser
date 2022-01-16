import axios from 'axios'
import store from '@/store'
import { AuthStoreMethods } from '@/enums/AuthStoreMethods'

axios.defaults.baseURL = 'http://localhost:80/api/'

axios.interceptors.request.use(
  request => {
    const token = store.getters[AuthStoreMethods.getToken]

    if (token) {
      request.headers.Authorization = `Bearer ${token}`
    }

    return request
  },
  error => Promise.reject(error)
)

export default {}
