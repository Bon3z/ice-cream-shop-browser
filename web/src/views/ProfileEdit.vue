<template>
  <el-row>
    <el-col :span="8" :offset="8">
      <el-input v-model="profile.name" placeholder="name"></el-input>
      <el-input v-model="profile.city" placeholder="city"></el-input>
      <el-input v-model="profile.description" placeholder="description"></el-input>
      <el-input v-model="profile.street_name" placeholder="street_name"></el-input>
      <el-input v-model="profile.street_number" placeholder="street_number"></el-input>
      <el-input v-model="profile.unit_number" placeholder="unit_number"></el-input>
      <el-input v-model="profile.postal" placeholder="postal"></el-input>
      <el-input v-model="profile.latitude" placeholder="latitude"></el-input>
      <el-input v-model="profile.longitude" placeholder="longitude"></el-input>
      <el-button type="warning" @click="updateProfile">Update</el-button>
      <div v-if="success">
        <el-alert type="success">{{success}}</el-alert>
      </div>
    </el-col>
    <el-col>
      <div v-for="(photo, index) in photos" :key="index" class="container" @click="deleteImage(photo.id)">
        <el-image
          :src="photo.url"
          fit="fit"
          :alt="photo.name"
          class="image"
        />
        <el-button type="danger" icon="el-icon-error" class="delete"></el-button>
      </div>
    </el-col>
  </el-row>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'
import axios from 'axios'
import { Photo } from '@/models/Photo'

@Component
export default class ProfileEdit extends Vue {
  private profileId!: number
  private profilePhotos: Array<Photo> = []
  private success = ''

  private profile = {
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

  async created (): Promise<void> {
    this.profileId = this.$route.params.id
    await this.getProfile()
    await this.getProfilePhotos()
  }

  private async updateProfile (): Promise<void> {
    await axios.put(`shops/profile/${this.profileId}`, this.profile).then((response) => {
      this.success = response.data.message
    })
  }

  private async getProfile (): Promise<void> {
    await axios.get(`shops/profile/${this.profileId}`).then((response) => {
      this.profile = response.data
    })
  }

  private async getProfilePhotos (): Promise<void> {
    await axios.get(`shops/profile/photos/${this.profileId}`).then((response) => {
      this.profilePhotos = response.data.photos
    })
  }

  private async deleteImage (photoId): Promise<void> {
    await axios.delete(`shops/profile/photos/${photoId}`)
    await this.getProfilePhotos()
  }

  get photos (): Array<Photo> {
    return this.profilePhotos
  }
}
</script>

<style scoped>
.container {
  display: inline-block;
  margin: 5px;
  padding: 5px;
}

.image {
  width: 200px;
  height: 200px;
  display: block;
}

.delete {
  padding: 5px;
  vertical-align: bottom;
}
</style>
