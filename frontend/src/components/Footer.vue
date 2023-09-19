<template>
  <footer class="footer is-fixed-bottom">
    <div class="content has-text-centered">
      <span class="teste">Do-And-Make Desenvolvimento de Sistemas &copy; 2023</span>
    </div>
  </footer>
</template>

<script>
export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Footer"
}
</script>

<style scoped>
 .footer {
   position: fixed;
   bottom: 0;
   width: 100%;
   text-align: center;
   padding: initial;
 }

 .teste {
   padding: 0;
   margin: 0;
   width: 100%;
 }
</style>