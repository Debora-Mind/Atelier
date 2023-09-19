<template>
  <nav class="navbar column is-flex p-0 content" role="navigation" aria-label="main navigation">
    <div class="navbar-item">
      <h2 class="ml-4 mb-0">Home</h2>
      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
    <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-end">
        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link">
            Usuário
          </a>

          <div class="navbar-dropdown">
            <a class="navbar-item">
              Perfil
            </a>
            <a class="navbar-item">
              Configurações
            </a>
            <a class="navbar-item">
              Alterar Senha
            </a>
            <hr class="navbar-divider">
            <a @click="Logout" class="navbar-item">
              Sair do Sistema
            </a>
          </div>
        </div>
      </div>

      <div class="image is-48x48 my-1">
        <img class="is-rounded" src="https://picsum.photos/200"  alt="Foto do usuário"/>
      </div>
    </div>
  </nav>
  <Confirmar ref="Confirmar" @confirmado="updateConfirmado" />

</template>

<script>

import Confirmar from "@/components/templates/Confirmar.vue";
export default {
  name: "NavBar",
  // eslint-disable-next-line vue/no-unused-components
  components: { Confirmar },
  data() {
    return {
      confirmar: {
        tipo: 'success',
        ativo: false,
        titulo: 'Sair do sistema?',
        mensagem: 'Caso queira sair do sistema clique em <b>Sair</b> para encerrar a sessão.',
      },
    }
  },
  methods: {
    Logout() {
      this.$refs.Confirmar.mostrarConfirmar(this.confirmar.tipo, this.confirmar.titulo, this.confirmar.mensagem, 'confirmado')
    },
    updateConfirmado(confirmado) {
      if (confirmado) {
        sessionStorage.clear()
        window.location.reload();
      }
    }
  }
}
</script>

<style scoped>
footer {
  justify-content: flex-end
}

nav {
  position: static;
}
</style>