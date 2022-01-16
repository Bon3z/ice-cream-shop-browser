<template>
  <div>
    <el-col v-for="(ingredient, index) in menu" :key="index" :span="12" :offset="6">
      <el-col class="ingredient">
        <div v-if="editedIngredient.id === ingredient.id">
          <el-input v-model="editedIngredient.name" />
          <el-input v-model="editedIngredient.price" />
          <el-input v-model="editedIngredient.serving_type" />
          <el-button class="button" icon="el-icon-edit" type="success" @click="updateIngredient(ingredient)" circle></el-button>
          <el-button class="button" icon="el-icon-delete" type="danger" @click="deleteIngredient(ingredient.id)" circle></el-button>
        </div>
        <div v-else>
          <el-col :span="6">{{ ingredient.name }}</el-col>
          <el-col :span="6">{{ ingredient.servingType }}</el-col>
          <el-col :span="6">{{ ingredient.price }}PLN</el-col>
          <el-button class="button" icon="el-icon-edit" type="warning" circle @click="prepareIngredientEditForm(ingredient)"></el-button>
          <el-button class="button" icon="el-icon-delete" type="danger" @click="deleteIngredient(ingredient.id)" circle></el-button>
        </div>
      </el-col>
      <div>
        <div v-for="(allergen, index) in ingredient.allergens" :key="index">
          <el-col class="allergen">
            <div v-if="editedAllergen.id === allergen.id">
              <el-input v-if="editedAllergen.id" v-model="editedAllergen.name" />
              <el-input v-if="editedAllergen.id" v-model="editedAllergen.description" />
              <el-button class="button" icon="el-icon-check" type="success" @click="updateAllergen(allergen.id)" circle></el-button>
              <el-button class="button" icon="el-icon-delete" type="danger" @click="deleteAllergen(allergen.id)" circle></el-button>
            </div>
            <div v-else>
              <el-col :span="9">{{ allergen.name }}</el-col>
              <el-col :span="9">{{ allergen.description }}</el-col>
              <el-button class="button" icon="el-icon-edit" type="warning" @click="prepareAllergenEditForm(allergen)" circle></el-button>
              <el-button class="button" icon="el-icon-delete" type="danger" @click="deleteAllergen(allergen.id)" circle></el-button>
            </div>
          </el-col>
        </div>
        <div v-if="pendingNewAllergenId === ingredient.id">
          <el-input v-model="editedAllergen.name" />
          <el-input v-model="editedAllergen.description" />
          <el-button class="button" icon="el-icon-check" type="success" @click="createAllergen(ingredient.id)" circle></el-button>
        </div>
        <el-button class="button" type="success" @click="pendingNewAllergenId = ingredient.id" round>Add allergen</el-button>
      </div>
    </el-col>
    <el-col :span="12" :offset="6">
      <div>
        <div v-if="pendingNewIngredient">
          <el-input v-model="editedIngredient.name" placeholder="Name" />
          <el-input v-model="editedIngredient.price" placeholder="Price per unit" />
          <el-input v-model="editedIngredient.serving_type" placeholder="Serving type" />
          <el-button class="button" icon="el-icon-check" type="success" @click="createIngredient" circle></el-button>
        </div>
        <el-button class="button" type="success" @click="pendingNewIngredient = true" round>Add ingredient</el-button>
      </div>
    </el-col>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'
import axios from 'axios'
import { Allergen } from '@/models/Allergen'
import { Ingredient } from '@/models/Ingredient'

@Component
export default class MenuEdit extends Vue {
  private profileId!: string
  private menuId!: number
  private menu: Array<Ingredient> = []
  private pendingNewAllergenId = 0
  private pendingNewIngredient = false
  private editedAllergen: Allergen = {
    id: 0,
    name: '',
    description: ''
  }

  private editedIngredient: Ingredient = {
    id: 0,
    name: '',
    price: 0,
    serving_type: ''
  }

  async created (): Promise<void> {
    this.profileId = this.$route.params.id
    await this.getProfileMenu()
  }

  private async getProfileMenu (): Promise<void> {
    await axios.get(`shops/profile/${this.profileId}/menu`).then((response) => {
      console.log(response)
      this.menu = response.data.menu
      this.menuId = response.data.id
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
    this.editedIngredient.serving_type = ingredient.serving_type
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
    this.editedIngredient.serving_type = ''
  }

  private async updateIngredient (ingredient: Ingredient): Promise<void> {
    const al = this.menu.filter(ing => ing.id === ingredient.id)
    const form = { ingredient: this.editedIngredient, allergens: al[0].allergens[0] }
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
    await axios.delete(`shops/ingredient/allergen/${id}`).then(() => {
      this.getProfileMenu()
    })
  }

  private async createIngredient (): Promise<void> {
    const form = { ingredient: this.editedIngredient }
    console.log(form)
    await axios.post(`shops/menu/${this.menuId}`, form).then((r) => {
      console.log(r)
      this.clearIngredientEditForm()
      this.getProfileMenu()
    })
  }
}
</script>

<style scoped>
.button {
  margin-top: 5px;
}

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
