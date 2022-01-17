<template>
  <el-dropdown trigger="click" @command="handleCommand">
      <span class="el-dropdown-link">
        <div>
          <span v-if="selectedCity !== ''">{{ selectedCity }}</span>
          <span v-else>
            Select city
          </span>
          <i class="el-icon-arrow-down el-icon--right"></i>
        </div>
      </span>
    <el-dropdown-menu slot="dropdown">
      <el-dropdown-item v-for="(city, index) in cities"
                        :key="index"
                        :command="city.name"
      >{{ city.name }}</el-dropdown-item>
    </el-dropdown-menu>
  </el-dropdown>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator'

@Component
export default class City extends Vue {
  @Prop(Array) readonly cities: Array<string> | undefined
  @Prop(String) selectedCity: string | undefined

  private handleCommand (city: string): void {
    this.selectedCity = city
    this.$emit('city-selected', this.selectedCity)
  }
}
</script>

<style scoped>

</style>
