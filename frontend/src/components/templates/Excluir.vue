<template>
  <div id="confirmarExcluir" class="modal ">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Excluir</p>
        <button  @click="FecharModal" class="delete" aria-label="close"></button>
      </header>
      <section class="modal-card-body">
        <p v-html="this.mensagem"></p>
      </section>
      <footer class="modal-card-foot">
        <button class="button is-success" @click="excluirConfirmado">Confirmar</button>
        <button class="button" @click="FecharModal">Cancelar</button>
      </footer>
    </div>
  </div>
</template>

<script lang="js">
import http from "@/services/http";

export default {
  name: "Excluir",
  mounted() {
    this.$root.mostrarExcluir = this.mostrarExcluir;
  },
  data() {
    return {
      id: 0,
      objeto: '',
      mensagem: 'Tem certeza que deseja excluir ',
      retorno: ' excluido com sucesso!'
    }
  },
  methods: {
    async mostrarExcluir(id, objeto, preposicao) {
      if (id) {
        this.id = id;
        this.objeto = objeto;

        try {
          const response = await http.get('api/' + objeto + 's/buscar-id?id=' + id);
          var usuario = response.data.usuario;
        } catch (e) {
          this.$root.mostrarFlashMenssage('danger', 'Erro', e);
          console.error('Erro ao buscar dados:', e);
        }

        this.mensagem += preposicao + ' ' + usuario.usuario + ' ?';

        let elemento = document.getElementById('confirmarExcluir')
        elemento.classList.add('is-active');
      }
    },
    async excluirConfirmado() {

      await http.post('/api/' + this.objeto + 's/excluir-' + this.objeto + '?id=' + this.id)
          .then(response => {
            this.$root.mostrarFlashMenssage(response.data.tipo, response.data.titulo, response.data.mensagem);
          })
          .catch(e => {
            this.$root.mostrarFlashMenssage('danger', 'Erro', e);
            console.error('Erro ao remover dados:', e);
          });

      let elemento = document.getElementById('confirmarExcluir')
      elemento.classList.remove('is-active');

      window.location.reload();
    },
    FecharModal() {
      let elemento = document.getElementById('confirmarExcluir')
      elemento.classList.remove('is-active');
      this.limparVariaveis()
    },
    limparVariaveis() {
      this.id = 0;
      this.objeto = '';
      this.mensagem = 'Tem certeza que deseja excluir ';
      this.retorno = ' excluído com sucesso!';
    }
  },

}
</script>

<style scoped>

</style>