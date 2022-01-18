<template>
  <el-col :span="8">
    <el-card>
      <div slot="header" class="clearfix card-header">
        <el-col :span="12" class="card-title">{{ name }}</el-col>
        <el-col :span="12">
          <el-button class="button"
                     type="success"
                     @click="$router.push(`/shop/profile/${id}`)"
                     icon="el-icon-right"
                     circle
          />
          <el-button v-if="isEditable"
                     class="button"
                     type="warning"
                     icon="el-icon-edit"
                     @click="$router.push(`/shop/profile/${id}/edit`)"
                     circle
          />
        </el-col>
      </div>
      <h2>
        <el-row>
          {{ city }}
          {{ streetName }}
          {{ streetNumber }}
          <span v-if="unitNumber">/{{ unitNumber }}</span>
        </el-row>
        <el-row>
          {{ phone }}
        </el-row>
        <el-row>
          {{ description }}
        </el-row>
      </h2>
      <el-row>
        <el-popover
          placement="right"
          trigger="click">
          <ul class="infinite-list menu">
            <li v-for="(ingredient, index) in menu" :key="index" class="infinite-list-item menu-item">
              {{ ingredient.name }}
              {{ ingredient.servingType }}
              {{ ingredient.price }}PLN
            </li>
          </ul>
          <el-button slot="reference" style="font-size: 20px">Menu</el-button>
          <el-button v-if="isEditable"
                      slot="reference"
                      type="warning"
                     icon="el-icon-edit"
                     @click="$router.push(`/shop/profile/${id}/menu/edit`)"
                     circle
          />
        </el-popover>
      </el-row>
    </el-card>
  </el-col>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator'
import axios from 'axios'
import { Ingredient } from '@/models/Ingredient'

@Component
export default class ProfileCard extends Vue {
  @Prop(Number) id: number | undefined
  @Prop(String) city: string | undefined
  @Prop(String) description: string | undefined
  @Prop(String) name: string | undefined
  @Prop(String) postal: string | undefined
  @Prop(String) streetName: string | undefined
  @Prop(String) streetNumber: string | undefined
  @Prop(String) unitNumber: string | undefined
  @Prop(String) phone: string | undefined
  @Prop(String) latitude: string | undefined
  @Prop(String) longitude: string | undefined
  @Prop(Boolean) isEditable: boolean | undefined

  private menu: Array<Ingredient> = []

  async created (): Promise<void> {
    axios.get(`shops/profile/${this.id}/menu`).then((response) => {
      this.menu = response.data.menu
    })
  }
}
</script>

<style scoped>
.menu {
  list-style-type: none;
  max-height: 100px;
  overflow-y: scroll;
  font-size: 18px;
}

.button {
  float: right;
  margin: 0 5px 10px 5px;
}

.card-header {
  height: 80px;
}

.card-title {
  padding-top: 15px;
  font-size: 28px;
  font-weight: bold;
  overflow-wrap: anywhere;
}

.menu-item {
  font-size: 32px;
  font-weight: bold;
}
</style>
