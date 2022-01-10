import Vue from 'vue'
import VueRouter, { RouteConfig } from 'vue-router'
import HomePage from '@/views/HomePage.vue'
import Register from '@/views/Register.vue'
import Login from '@/views/Login.vue'
import NewProfile from '@/views/NewProfile.vue'
import UserProfiles from '@/views/UserProfiles.vue'
import ProfileEdit from '@/views/ProfileEdit.vue'

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
  },
  {
    path: '/shop/profiles',
    name: 'UserProfiles',
    component: UserProfiles
  },
  {
    path: '/shop/profile/:id/edit',
    name: 'ProfileEdit',
    component: ProfileEdit
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
