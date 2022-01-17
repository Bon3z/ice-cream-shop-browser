<template>
  <div v-if="shops">
    <el-col>
      <el-row>
        <div v-for="(shop, index) in shops" :key="index">
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
                        class="profile-card"
          />
        </div>
      </el-row>
    </el-col>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'
import axios from 'axios'
import ProfileCard from '@/components/ProfileCard.vue'
import { Profile } from '@/models/Profile'
@Component({
  components: { ProfileCard }
})
export default class UserProfiles extends Vue {
  private shops: Array<Profile> = [];
  async created (): Promise<void> {
    axios.get(`shops/${this.id}/profiles`).then((response) => {
      console.log(response)
      this.shops = response.data.profiles
    })
  }
}
</script>

<style scoped>
.profile-card {
  padding: 5px;
}
</style>
