<template>
  <div>
    <el-col v-for="(ingredient, index) in menu" :key="index" :span="12" :offset="6">
      <el-col class="ingredient">
        <div v-if="editedIngredient.id === ingredient.id">
          <el-input v-model="editedIngredient.name" />
          <el-input v-model="editedIngredient.price" />
          <el-input v-model="editedIngredient.servingType" />
          <el-button icon="el-icon-edit" type="success" @click="updateIngredient(ingredient)" circle></el-button>
          <el-button icon="el-icon-delete" type="danger" @click="deleteIngredient(ingredient.id)" circle></el-button>
        </div>
        <div v-else>
          <el-col :span="6">{{ ingredient.name }}</el-col>
          <el-col :span="6">{{ ingredient.servingType }}</el-col>
          <el-col :span="6">{{ ingredient.price }}PLN</el-col>
          <el-button icon="el-icon-edit" type="warning" circle @click="prepareIngredientEditForm(ingredient)"></el-button>
          <el-button icon="el-icon-delete" type="danger" @click="deleteIngredient(ingredient.id)" circle></el-button>
        </div>
      </el-col>
      <div>
        <div v-for="(allergen, index) in ingredient.allergens" :key="index">
          <el-col class="allergen">
            <div v-if="editedAllergen.id === allergen.id">
              <el-input v-if="editedAllergen.id" v-model="editedAllergen.name" />
              <el-input v-if="editedAllergen.id" v-model="editedAllergen.description" />
              <el-button icon="el-icon-check" type="success" @click="updateAllergen(allergen.id)" circle></el-button>
              <el-button icon="el-icon-delete" type="danger" @click="deleteAllergen(allergen.id)" circle></el-button>
            </div>
            <div v-else>
              <el-col :span="9">{{ allergen.name }}</el-col>
              <el-col :span="9">{{ allergen.description }}</el-col>
              <el-button icon="el-icon-edit" type="warning" @click="prepareAllergenEditForm(allergen)" circle></el-button>
              <el-button icon="el-icon-delete" type="danger" @click="deleteAllergen(allergen.id)" circle></el-button>
            </div>
          </el-col>
        </div>
        <div v-if="pendingNewAllergen">
          <el-input v-model="editedAllergen.name" />
          <el-input v-model="editedAllergen.description" />
          <el-button icon="el-icon-check" type="success" @click="createAllergen(ingredient.id)" circle></el-button>
        </div>
        <el-button type="success" icon="el-icon-plus" @click="pendingNewAllergen = true" circle />
      </div>
    </el-col>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'
import axios from 'axios'
import { Menu } from '@/models/Menu'
import { Allergen } from '@/models/Allergen'
import { Ingredient } from '@/models/Ingredient'

@Component
export default class MenuEdit extends Vue {
  private profileId!: string
  private menu: Array<Menu> = []
  private pendingNewAllergen = false
  private editedAllergen: Allergen = {
    id: 0,
    name: '',
    description: ''
  }

  private editedIngredient: Ingredient = {
    id: 0,
    name: '',
    price: 0,
    servingType: ''
  }

  async created (): Promise<void> {
    this.profileId = this.$route.params.id
    await this.getProfileMenu()
  }

  private async getProfileMenu (): Promise<void> {
    await axios.get(`shops/profile/${this.profileId}/menu`).then((response) => {
      console.log(response)
      this.menu = response.data.menu
    })
    console.log(this.menu)
  }

  private prepareAllergenEditForm (allergen: Allergen): void {
    this.editedAllergen.id = allergen.id
    this.editedAllergen.name = allergen.name
    this.editedAllergen.description = allergen.description
  }

  private prepareIngredientEditForm (ingredient: Ingredient): void {
    this.editedIngredient.id = ingredient.id
    this.editedIngredient.name = ingredient.name
    this.editedIngredient.price = ingredient.price
    this.editedIngredient.servingType = ingredient.servingType
  }

  private clearAllergenEditForm (): void {
    this.editedAllergen.id = 0
    this.editedAllergen.name = ''
    this.editedAllergen.description = ''
  }

  private clearIngredientEditForm (): void {
    this.editedIngredient.id = 0
    this.editedIngredient.name = ''
    this.editedIngredient.price = 0
    this.editedIngredient.servingType = ''
  }

  private async updateIngredient (ingredient: Ingredient): Promise<void> {
    console.log(this.editedIngredient)
    const al = this.menu.filter(ing => ing.id === ingredient.id)
    const form = { ingredient: this.editedIngredient, allergens: al[0].allergens[0] }
    console.log(form)
    await axios.put(`shops/menu/${ingredient.id}`, form).then(() => {
      this.getProfileMenu()
      this.clearAllergenEditForm()
      this.clearIngredientEditForm()
    })
  }

  private async createAllergen (ingredientId: number): Promise<void> {
    await axios.post(`shops/ingredient/${ingredientId}`, this.editedAllergen).then(() => {
      this.pendingNewAllergen = false
      this.clearAllergenEditForm()
      this.getProfileMenu()
    })
  }

  private async updateAllergen (allergenId: number): Promise<void> {
    await axios.put(`/shops/ingredient/allergen/${allergenId}`, this.editedAllergen).then(() => {
      this.clearAllergenEditForm()
      this.getProfileMenu()
    })
  }

  private async deleteIngredient (id: number): Promise<void> {
    await axios.delete(`shops/menu/${id}`).then(() => {
      this.getProfileMenu()
    })
  }

  private async deleteAllergen (id: number): Promise<void> {
    console.log(id)
  }
}
</script>

<style scoped>
.ingredient {
  box-shadow: 2px 2px #4c5965;
  font-weight: bold;
  font-size: 28px;
  margin: 10px 0 0 10px;
  padding: 20px;
  background-color: #9ea7ac;
  border-radius: 5px 5px 0 0;
  height: 100%;
  width: 100%;
}

.allergen {
  background-color: #7c8588;
  box-shadow: 2px 2px #4c5965;
  font-weight: bold;
  font-size: 18px;
  margin-left: 10px;
  padding: 20px;
  border-radius: 0 0 5px 5px;
  width: 100%;
}
</style>
