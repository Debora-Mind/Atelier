<template>
  <div class="coluns">
    <form ref="formulario" method="post" class="box column is-half is-offset-one-quarter p-6">
      <h1 class="title has-text-centered">Vamos trabalhar?</h1>
      <div class="field">
        <label class="label">Usuário</label>
        <div class="control">
          <input id="usuario" name="usuario" class="input" type="text" inputmode="text" @keyup.enter="focusSenhaField">
        </div>
      </div>

      <div class="field">
        <label class="label">Senha</label>
        <div class="control">
          <input id="senha" name="senha" class="input" type="password" placeholder="********"
                 inputmode="text" @keyup.enter="fazerLogin" ref="senhaInput">
        </div>
      </div>
      <div class="buttons is-right">
        <button type="button" class="button is-primary" @click="fazerLogin" @touchstart="fazerLogin">Login</button>
      </div>
        <small class="has-text-danger">
          {{ erroValidacao && (erroValidacao.usuario || erroValidacao.senha)}}
        </small>
    </form>
  </div>
  <Footer />
</template>

<script>
import Footer from "@/components/Footer";
import http from "@/services/http";
export default {
  name: "LogIn",
  components: {Footer},
  data() {
    return {
      mensagem: [],
      erroValidacao: [],
      session: []
    }
  },
  methods: {
    async fazerLogin() {

      const formData = new FormData(this.$refs.formulario);

      await http.post('/api/login', formData)
          .then(response => {
            console.log(response.data)
            this.erroValidacao = response.data.erroValidacao
            sessionStorage.setItem('logado', response.data.session.logado)
            sessionStorage.setItem('usuario', response.data.session.usuario)
            sessionStorage.setItem('empresa', response.data.session.empresa)
          })
          .catch(e => {
            console.error('Erro ao enviar dados:', e);
          });
      if (sessionStorage.getItem('logado') === 'true') {
        window.location.reload();
      }
    },
    focusSenhaField() {
      this.$refs.senhaInput.focus();
    }
  },
}
</script>

<style scoped>
* {
  max-height: 100%;
}
.coluns {
  background: #00d0b1;
  display: flex;
  align-items: center;
  height: 100vh;
}
</style>