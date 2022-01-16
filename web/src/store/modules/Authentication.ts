import Vue from 'vue'
import Vuex, { Module } from 'vuex'
import { RootState } from '@/models/states/root'
import { UserState } from '@/models/states/User'
import { AuthStoreMethods } from '@/enums/AuthStoreMethods'

Vue.use(Vuex)

export const auth: Module<UserState, RootState> = {
  state: {
    token: localStorage.getItem('token') || ''
  },
  getters: {
    [AuthStoreMethods.getToken]: (state): string => state.token
  },
  mutations: {
    [AuthStoreMethods.setToken] (state, token: string): void {
      localStorage.setItem('token', token)
      state.token = token
    }
  },
  actions: {
    [AuthStoreMethods.setToken] ({ commit }, token: string): void {
      commit(AuthStoreMethods.setToken, token)
    }
  }
}
