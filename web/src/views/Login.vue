<template>
  <el-row>
    <el-col :span="6" :offset="6">
      <el-input v-model="form.email" placeholder="Contact email"></el-input>
      <el-input v-model="form.password" type="password" placeholder="Password"></el-input>
      <el-button @click="send">Login</el-button>
    </el-col>
  </el-row>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'
import axios from 'axios'
import { Action } from 'vuex-class'
import { ActionMethod } from 'vuex'

@Component
export default class Login extends Vue {
  private form = {
    email: '',
    password: ''
  }

  private async send (): Promise<void> {
    await this.setCSRFCookie()
  }

  private async setCSRFCookie (): Promise<void> {
    await axios({ method: 'get', url: '/sanctum/csrf-cookie', baseURL: 'http://localhost:80' }).then(() => {
      this.login()
    })
  }

  private async login (): Promise<void> {
    await axios.post('login', this.form).then((response) => {
      this.setToken(response.data)
    })
  }

  @Action ['setToken']: ActionMethod
}
</script>

<style scoped>

</style>
