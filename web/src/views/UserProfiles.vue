<template>
  <div v-if="profiles">
    <el-col>
      <el-row>
        <div v-for="(shop, index) in profiles" :key="index">
          <profile-card :city="shop.city"
                        :id="shop.id"
                        :description="shop.description"
                        :latitude="shop.latitude"
                        :longitude="shop.longitude"
                        :name="shop.name"
                        :phone="shop.phone"
                        :postal="shop.postal"
                        :street-name="shop.street_name"
                        :street-number="shop.street_number"
                        :unit-number="shop.unit_number"
                        :is-editable=true
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
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'
import axios from 'axios'
import ProfileCard from '@/components/ProfileCard.vue'
import { Profile } from '@/models/Profile'
import { Pagination } from '@/models/Pagination'
@Component({
  components: { ProfileCard }
})
export default class UserProfiles extends Vue {
  private profiles: Array<Profile> = [];
  private paginationInfo: Pagination = {
    total: 0,
    current_page: 0,
    per_page: 9,
    count: 0,
    total_pages: 0
  }

  async created (): Promise<void> {
    await this.getProfiles()
  }

  private async getProfiles (): Promise<void> {
    let url = `/profiles?perPage=${this.paginationInfo.per_page}`

    if (this.paginationInfo.current_page !== 0) {
      url = `${url}&page=${this.paginationInfo.current_page}`
    }

    await axios.get(url).then((response) => {
      this.paginationInfo = response.data.pagination
      this.profiles = response.data.profiles
    })
  }

  private async changePage (page: number): Promise<void> {
    this.paginationInfo.current_page = page
    await this.getProfiles()
  }

  private async changePerPage (perPage: number): Promise<void> {
    this.paginationInfo.per_page = perPage
    await this.getProfiles()
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
