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
                          :is-editable="false"
                          class="profile-card"
            />
          </div>
        </el-row>
        <el-row v-if="isDataLoaded">
          <el-pagination
            :page-size="paginationInfo.per_page"
            layout="sizes, prev, pager, next"
            @current-change='changePage'
            @size-change="changePerPage"
            :current-page ="paginationInfo.currentPage"
            :total="paginationInfo.total"
            :page-sizes="[9, 18, 36]"
          ></el-pagination>
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
import { Pagination } from '@/models/Pagination'

@Component({
  components: {
    ProfileCard,
    City,
    Ingredient
  }
})
export default class HomePage extends Vue {
  private profiles: Array<Profile> = []
  private paginationInfo: Pagination = {
    total: 0,
    current_page: 0,
    per_page: 0,
    count: 0,
    total_pages: 0
  }

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

    if (this.paginationInfo.current_page !== 0) {
      url = `${url}&page=${this.paginationInfo.current_page}`
    }

    await axios.get(url).then((response) => {
      this.paginationInfo = response.data.pagination
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

  private async changePage (page: number): Promise<void> {
    this.paginationInfo.current_page = page
    await this.getProfiles()
  }

  private async changePerPage (perPage: number): Promise<void> {
    this.query.perPage = perPage
    await this.getProfiles()
  }

  private async getOptions (): Promise<void> {
    await axios.get('/options').then((response) => {
      this.options = response.data.options
    })
  }

  get isDataLoaded (): boolean {
    return this.profiles.length > 0
  }
}
</script>

<style scoped>
.profile-card {
  padding: 5px;
}
</style>
