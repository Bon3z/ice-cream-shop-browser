<template>
  <el-row>
    <el-col :span="12" :offset="6">
      <el-input v-model="shop.name" placeholder="name"></el-input>
      <el-input v-model="shop.city" placeholder="city"></el-input>
      <el-input v-model="shop.description" placeholder="description"></el-input>
      <el-input v-model="shop.street_name" placeholder="street_name"></el-input>
      <el-input v-model="shop.street_number" placeholder="street_number"></el-input>
      <el-input v-model="shop.unit_number" placeholder="unit_number"></el-input>
      <el-input v-model="shop.postal" placeholder="postal"></el-input>
      <el-input v-model="shop.latitude" placeholder="latitude"></el-input>
      <el-input v-model="shop.longitude" placeholder="longitude"></el-input>
      <el-button @click="send">Add new shop</el-button>
      <div v-if="success">
        <el-alert type="success">{{ success }}</el-alert>
        <el-button @click="$router.push(`shops/${shopId}`)">Go to the new profile page</el-button>
      </div>
    </el-col>
  </el-row>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'
import axios from 'axios'

@Component
export default class NewProfile extends Vue {
  private shop = {
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

  private success = null;
  private shopId = null;

  private async send (): Promise<void> {
    axios.post('/shops', this.shop).then((response) => {
      console.log(response)
      this.success = response.data.message
      this.shopId = response.data.shopId
    })
  }
}
</script>

<style scoped>

</style>
