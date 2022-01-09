<template>
  <el-row>
    <el-col :span="6" :offset="6">
      <h2>Logging credentials</h2>
      <el-input v-model="form.credentials.email" placeholder="Contact email"></el-input>
      <el-input v-model="form.credentials.name" placeholder="Company Name"></el-input>
      <el-input v-model="form.credentials.password" type="password" placeholder="Password"></el-input>
      <el-input v-model="form.credentials.password_confirmation" type="password" placeholder="Password confirmation"></el-input>
      <h2>Your shop information</h2>
      <el-input v-model="form.shop.name" placeholder="name"></el-input>
      <el-input v-model="form.shop.city" placeholder="city"></el-input>
      <el-input v-model="form.shop.description" placeholder="description"></el-input>
      <el-input v-model="form.shop.street_name" placeholder="street_name"></el-input>
      <el-input v-model="form.shop.street_number" placeholder="street_number"></el-input>
      <el-input v-model="form.shop.unit_number" placeholder="unit_number"></el-input>
      <el-input v-model="form.shop.postal" placeholder="postal"></el-input>
      <el-input v-model="form.shop.latitude" placeholder="latitude"></el-input>
      <el-input v-model="form.shop.longitude" placeholder="longitude"></el-input>
      <el-button @click="send">Sent request</el-button>
      <el-alert v-if="success" type="success">{{ success }}</el-alert>
    </el-col>
  </el-row>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'
import axios from 'axios'

@Component
export default class NewShop extends Vue {
  private form = {
    credentials: {
      email: '',
      name: '',
      password: '',
      password_confirmation: ''
    },
    shop: {
      name: '',
      city: '',
      description: '',
      street_name: '',
      street_number: '',
      unit_number: '',
      postal: '',
      latitude: '',
      longitude: ''
    }
  }

  private success = null;

  private async send (): Promise<void> {
    console.log(this.form)
    axios.post('register', this.form).then((response) => {
      console.log(response)
      this.success = response.data
    })
  }
}
</script>

<style scoped>

</style>
