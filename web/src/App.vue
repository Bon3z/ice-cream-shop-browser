<template>
  <div id="app">
    <div id="nav">
      <div v-if="token">
        <router-link to="/profile/new">Add new profile</router-link>
      </div>
      <div v-else>
        <router-link to="/register">Add new shop</router-link>
        <router-link to="/login">Login</router-link>
      </div>
      <router-link to="/">Home</router-link> |
    </div>
    <router-view/>
  </div>
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
