<template>
  <div id="confirmar" class="modal ">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">{{ this.titulo }}</p>
        <button  @click="FecharModal" class="delete" aria-label="close"></button>
      </header>
      <section class="modal-card-body">
        <p v-html="this.mensagem"></p>
      </section>
      <footer class="modal-card-foot">
        <button class="button is-success" @click="Confirmar">Confirmar</button>
        <button class="button" @click="FecharModal">Cancelar</button>
      </footer>
    </div>
  </div>
</template>

<script lang="js">
export default {
  name: "Confirmar",
  mounted() {
    this.$root.mostrarConfirmar = this.mostrarConfirmar;
    this.$root.confirmado = this.Confirmar;
  },
  data() {
    return {
      tipo: '',
      titulo: '',
      mensagem: '',
      retorno: ''
    }
  },
  methods: {
    mostrarConfirmar(tipo, titulo, mensagem, retorno) {
      if (mensagem) {
        this.tipo = tipo;
        this.titulo = titulo;
        this.mensagem = mensagem;
        this.retorno = retorno;

        let elemento = document.getElementById('confirmar')
        elemento.classList.add('is-active');
      }
    },
    Confirmar() {
      this.$emit(this.retorno, true);

      let elemento = document.getElementById('confirmar')
      elemento.classList.remove('is-active');
    },
    FecharModal() {
      this.$emit(this.retorno, false);

      let elemento = document.getElementById('confirmar')
      elemento.classList.remove('is-active');
    },
  },

}
</script>

<style scoped>

</style>