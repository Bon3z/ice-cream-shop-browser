import Vue from 'vue'
import VueRouter, { RouteConfig } from 'vue-router'
import HomePage from '@/views/HomePage.vue'
import Register from '@/views/Register.vue'
import Login from '@/views/Login.vue'
import NewProfile from '@/views/NewProfile.vue'

Vue.use(VueRouter)

const routes: Array<RouteConfig> = [
  {
    path: '/',
    name: 'HomePage',
    component: HomePage
  },
  {
    path: '/register',
    name: 'Register',
    component: Register
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/profile/new',
    name: 'NewProfile',
    component: NewProfile
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
