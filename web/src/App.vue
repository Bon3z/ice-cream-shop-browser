<template>
  <el-col id="app">
    <div id="nav">
      <router-link to="/">Home</router-link>
      <div v-if="token" class="router">
        <router-link to="/profile/new">Add new profile</router-link>
        <router-link to="/shop/profiles">Edit</router-link>
      </div>
      <div v-else>
        <router-link to="/register">Add new shop</router-link>
        <router-link to="/login">Login</router-link>
      </div>
    </div>
    <router-view />
  </el-col>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'
import { AuthStoreMethods } from '@/enums/AuthStoreMethods'
import { Getter } from 'vuex-class'

@Component
export default class App extends Vue {
  @Getter [AuthStoreMethods.getToken]: string
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

body {
  margin: 0;
}

.router {
  display: inline-block;
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
