<template>
  <LogIn v-if="!logado" />
  <template v-else>
    <FlashMessenger />
    <div  id="colunas" class="columns">
      <SideBar class="column" />
      <div class="column">
        <NavBar />
        <router-view />
        <Footer />
      </div>
    </div>
  </template>
</template>

<script>
import { defineComponent } from 'vue';
import LogIn from "@/views/Login.vue";
import SideBar from "@/components/SideBar.vue";
import NavBar from "@/components/NavBar.vue";
import Footer from "@/components/Footer.vue";
import FlashMessenger from "@/components/templates/FlashMessenger";
import Confirmar from "@/components/templates/Confirmar";

export default defineComponent({
  name: 'App',
  components: {Confirmar, FlashMessenger, Footer, NavBar, SideBar, LogIn},
  computed: {
    logado() {
      return true//sessionStorage.getItem("logado") === "true";
    }
  }
})
</script>
<style>
#app {
  --font-family-sans-serif: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
  -webkit-text-size-adjust: 100%;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;

  text-align: left;
  color: #2c3e50;
  max-width: 100vw;
}

body {
  min-height: 100vh;
  background: #f6f7fa;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}

</style>

<style scoped>
#colunas {
  min-height: 100vh;
  margin: 0;
  padding: 0;
}

.column {
  height: 100%;
  margin: 0;
  padding: 0;
}

</style>
