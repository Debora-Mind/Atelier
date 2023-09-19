<template>
  <article v-if="mensagem" id="flash-message" :class="'message is-' + tipo">
    <div class="message-header">
      <p>{{ titulo }}</p>
<!--      <button class="delete" aria-label="delete"></button>-->
    </div>
    <div class="message-body" v-html="mensagem"></div>
  </article>
</template>

<script>
export default {
  name: "FlashMessenger",
  data() {
    return {
      tipo: '',
      titulo: '',
      mensagem: ''
    };
  },
  methods: {
    mostrarFlashMenssage(tipo, titulo, mensagem) {
      if(mensagem) {
        this.tipo = tipo
        this.titulo = titulo
        this.mensagem = mensagem

        setTimeout(() => {
          this.mensagem = null;
        }, 5000);
      }
    },
  },
  mounted() {
    this.$root.mostrarFlashMenssage = this.mostrarFlashMenssage;
  },
}
</script>

<style scoped>
#flash-message {
  position: absolute;
  z-index: 999;
  width: 30%;
  right: -100%;
  top: 4rem;
  min-height: 7rem;
  animation: slideInAndOut 5s linear;
}

@keyframes slideInAndOut {
  0% {
    right: -100%;
  }
  10% {
    right: 1rem;
  }
  90% {
    right: 1rem
  }
  100% {
    right: -100%;
  }
}
</style>

