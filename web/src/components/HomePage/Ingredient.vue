<template>
  <el-dropdown trigger="click" @command="handleCommand">
      <span class="el-dropdown-link">
        <div>
          <span v-if="selectedIngredient !== ''">{{ selectedIngredient }}</span>
          <span v-else>
            Select ingredient
          </span>
          <i class="el-icon-arrow-down el-icon--right"></i>
        </div>
      </span>
    <el-dropdown-menu slot="dropdown">
      <el-dropdown-item v-for="(ingredient, index) in ingredients"
                        :key="index"
                        :command="ingredient.name"
      >{{ ingredient.name }}</el-dropdown-item>
    </el-dropdown-menu>
  </el-dropdown>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator'

@Component
export default class Ingredient extends Vue {
  @Prop(Array) readonly ingredients: Array<string> | undefined
  @Prop(String) selectedIngredient: string | undefined

  private handleCommand (ingredient: string): void {
    this.selectedIngredient = ingredient
    this.$emit('ingredient-selected', this.selectedIngredient)
  }
}
</script>

<style scoped>

</style>
