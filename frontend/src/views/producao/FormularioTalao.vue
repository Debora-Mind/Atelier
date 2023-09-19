<template>
  <div id="main">
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
          <label class="label">Referência</label>
          <div class="control">
            <input class="input is-small" type="text" autofocus>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Número da Produção</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is is-one-fifth">
          <label class="label">Sublote</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Quantidade</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 py-0 column is-one-fifth">
          <label class="label">Semana</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 py-0 column is-one-fifth">
          <label class="label">Código de Barras</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Data Entrada</label>
          <div class="control">
            <input class="input is-small" type="date">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-1 column is-one-fifth">
          <label class="label">Data Saída</label>
          <div class="control">
            <input class="input is-small" type="datetime-local">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Nota Fiscal</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
    </div>

    <div id="botoes" class="field is-grouped is-grouped-right p-3">
      <p class="control">
        <a class="button is-primary">
          <fa icon="floppy-disk" class="mr-1" />Salvar
        </a>
      </p>
      <p class="control">
        <a href="/producao/taloes" class="button is-danger">
          Cancelar
        </a>
      </p>
    </div>
  </div>
</template>

<script lang="ts">
export default {
  name: "FormularioTalao",
  data() {
    return {
      abaAtiva: "conteudo1",
    }
  },
  methods: {
    selecionarAba(conteudo: string) {
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