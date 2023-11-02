<template>
  <form ref="formulario" id="main" method="post">
    <div class="tabs is-boxed mb-0">
      <ul>
        <li id="aba1" @click="selecionarAba('1')" class="aba is-active">
          <a>
            <span>Principal</span>
          </a>
        </li>
      </ul>
    </div>

    <div id="conteudo1" class="p-4 conteudo">
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Login</label>
          <div class="control">
            <input name="usuario" id="usuario" class="input is-small" type="text" autofocus :value="usuario ? usuario.usuario : ''">
          </div>
          <small class="is-danger">{{ erroValidacao && erroValidacao.usuario }}</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is is-one-fifth">
          <label class="label">Funcionário</label>
          <div class="control">
            <input name="funcionario" class="input is-small" type="text" :value="usuario ? usuario.funcionario : null">
          </div>
          <small class="is-danger">{{ erroValidacao && erroValidacao.funcionario }}</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 py-0 column is-one-fifth">
          <label class="label">Senha</label>
          <div class="control">
            <input name="senha" class="input is-small" type="password">
          </div>
          <small class="is-danger">{{ erroValidacao && erroValidacao.senha }}</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Repita a senha</label>
          <div class="control">
            <input name="senhaRepetida" class="input is-small" type="password">
          </div>
          <small class="is-danger">{{ erroValidacao && erroValidacao.senhaRepetida }}</small>
        </div>
      </div>
    </div>

    <div hidden>
      <input type="text" name="empresa_id" :value="empresa" >
      <input type="text" name="id" :value="usuario ? usuario.id : ''" >
    </div>

    <div id="botoes" class="field is-grouped is-grouped-right p-3">
      <p class="control">
        <button class="button is-primary" type="button" @click="enviarDados">
          <fa icon="floppy-disk" class="mr-1" />Salvar
        </button>
      </p>
      <p class="control">
        <a href="/usuarios" class="button is-danger">
          Cancelar
        </a>
      </p>
    </div>
  </form>
</template>

<script>
import http from "../../services/http";

export default {
  name: "FormularioUsuario",
  data() {
    return {
      mensagem: [],
      erroValidacao: [],
      usuario: [],
      empresa: sessionStorage.getItem('empresa')
    }
  },
  async mounted() {
    let id = this.$route.query.id;
    if(id) {
      await this.listar(id);
    }
  },
  methods: {
    listar: async function (id) {
      try {
        const response = await http.get('api/usuarios/formulario?id=' + id);
        this.usuario = response.data.usuario;
        console.log(response.data)
      } catch (e) {
        this.$root.mostrarFlashMenssage('danger', 'Erro', e);
        console.error(e);
      }
    },
    selecionarAba(conteudo) {
      // eslint-disable-next-line no-undef
      let conteudos = $('.conteudo').get();
      for (let i = 0; i < conteudos.length; i++) {
        conteudos[i].setAttribute('hidden', 'true')
      }
      // eslint-disable-next-line no-undef
      let conteudoAtivo = $('#conteudo' + conteudo)
      conteudoAtivo.removeAttr('hidden')

      // eslint-disable-next-line no-undef
      let abas = $('.aba').get();
      for (let i = 0; i < abas.length; i++) {
        abas[i].classList.remove('is-active')
      }
      // eslint-disable-next-line no-undef
      let abaAtiva = $('#aba' + conteudo)
      abaAtiva.addClass('is-active')
    },
    enviarDados: async function () {
      const formData = new FormData(this.$refs.formulario);
      await http.post('/api/usuarios/salvar-usuario', formData)
        .then(response => {
          this.$root.mostrarFlashMenssage(response.data.tipo, response.data.titulo, response.data.mensagem);
          console.log(response.data)
          this.erroValidacao = response.data.erroValidacao
          if(!response.data.erroValidacao) {
            this.$router.push({ name: 'usuariosView' });
          }
        })
        .catch(e => {
          this.$root.mostrarFlashMenssage('danger', 'Erro', e);
          console.error('Erro ao enviar dados:', e);
        });
    },
  }
}
</script>

<style scoped>
#main {
  margin: 1rem;
}

.label {
  font-size: 0.8rem;
}

hr {
  background: #333333;
}

table *{
  font-size: 0.8rem;
}

.conteudo {
  background: white;
  border: solid 1px #d5d4d4;
}

#botoes {
  border: solid 1px lightgrey;
  border-radius: 0 0 5px 5px;
  background: whitesmoke;
}

</style>