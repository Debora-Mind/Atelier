<template>
  <nav class="pagination is-centered py-1" role="navigation" aria-label="pagination">
    <a class="pagination-previous" @click="previousPage()">Previous</a>
    <a class="pagination-next" @click="nextPage()">Next page</a>
    <ul class="pagination-list">
      <li v-for="page in totalPages" :key="page">
        <a class="pagination-link" @click="goToPage(page)" :class="{ 'is-current': page === currentPage }">{{ page }}</a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Paginador",
  data() {
    return {
      currentPage: 1,
    }
  },
  props: {
    perPage: Number,
    itens: Array,
  },
  computed: {
    totalPages() {
      return Math.ceil(this.itens.length / this.perPage);
    },
    itensPorPagina() {
      return this.getItensPorPagina()
    }
  },
  methods: {
    previousPage() {
      if (this.currentPage > 1) {
        this.currentPage -= 1
        this.$emit("update:currentPage", this.currentPage);
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage += 1
        this.$emit("update:currentPage", this.currentPage);
      }
    },
    goToPage(page) {
      this.currentPage = page
      this.$emit("update:currentPage", page);
    },
    getItensPorPagina() {
      try {
        const startIndex = (this.currentPage - 1) * this.perPage; // Usar this.perPage se aplicável
        return this.itens.slice(startIndex, startIndex + this.perPage);
      } catch (e) {
        console.log(e)
      }
    }
  }
}
</script>

<style scoped>

</style>