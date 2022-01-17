<template>
  <div>
    <el-col class="options">
      <city :cities="options.cities"
            :selected-city="query.city"
            @city-selected="query.city = $event"
      />
      <ingredient :ingredients="options.ingredients"
                  :selected-ingredient="query.ingredient"
                  @ingredient-selected="query.ingredient = $event"
      />
      <el-button @click="getProfiles">Filter</el-button>
      <el-button @click="clearQuery">Clear</el-button>
    </el-col>
    <el-col v-if="profiles">
      <el-col>
        <el-row>
          <div v-for="(profile, index) in profiles" :key="index">
            <profile-card :city="profile.city"
                          :id="profile.id"
                          :description="profile.description"
                          :latitude="profile.latitude"
                          :longitude="profile.longitude"
                          :name="profile.name"
                          :phone="profile.phone"
                          :postal="profile.postal"
                          :street-name="profile.street_name"
                          :street-number="profile.street_number"
                          :unit-number="profile.unit_number"
                          class="profile-card"
            />
          </div>
        </el-row>
      </el-col>
    </el-col>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'
import axios from 'axios'
import { Profile } from '@/models/Profile'
import ProfileCard from '@/components/ProfileCard.vue'
import City from '@/components/HomePage/City.vue'
import Ingredient from '@/components/HomePage/Ingredient.vue'

@Component({
  components: {
    ProfileCard,
    City,
    Ingredient
  }
})
export default class HomePage extends Vue {
  private profiles: Array<Profile> = []
  private options = []
  private query = {
    city: '',
    ingredient: '',
    perPage: 9
  }

  async created (): Promise<void> {
    await this.getProfiles()
    await this.getOptions()
  }

  private async getProfiles (): Promise<void> {
    let url = `/profiles?perPage=${this.query.perPage}`

    if (this.query.ingredient !== '') {
      url = `${url}&ingredient=${this.query.ingredient}`
    }

    if (this.query.city !== '') {
      url = `${url}&city=${this.query.city}`
    }

    await axios.get(url).then((response) => {
      this.profiles = response.data.profiles
    })
  }

  private clearQuery (): void {
    this.query = {
      city: '',
      ingredient: '',
      perPage: 9
    }
  }

  private async getOptions (): Promise<void> {
    await axios.get('/options').then((response) => {
      this.options = response.data.options
    })
  }
}
</script>

<style scoped>
.profile-card {
  padding: 5px;
}
</style>
