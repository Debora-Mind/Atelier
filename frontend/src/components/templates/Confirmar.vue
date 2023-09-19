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

<script>
export default {
// eslint-disable-next-line vue/multi-word-component-names
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
        // eslint-disable-next-line vue/no-mutating-props
        this.tipo = tipo;
        // eslint-disable-next-line vue/no-mutating-props
        this.titulo = titulo;
        // eslint-disable-next-line vue/no-mutating-props
        this.mensagem = mensagem;
        // eslint-disable-next-line vue/no-mutating-props
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