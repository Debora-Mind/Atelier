<template>
  <div id="main">
    <div class="tabs is-boxed mb-0">
      <ul>
        <li id="aba1" @click="selecionarAba('1')" class="aba is-active">
          <a>
            <span>Principal</span>
          </a>
        </li>
        <li id="aba2" @click="selecionarAba('2')" class="aba">
          <a>
            <span>Contato</span>
          </a>
        </li>
        <li id="aba3" @click="selecionarAba('3')" class="aba">
          <a>
            <span>Endereço</span>
          </a>
        </li>
        <li id="aba4" @click="selecionarAba('4')" class="aba">
          <a>
            <span>Parâmetros</span>
          </a>
        </li>
      </ul>
    </div>

    <div id="conteudo1" class="p-4 conteudo">
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-third">
          <label class="label">Tipo de Pessoa</label>
          <div class="control">
            <input class="input is-small" type="text" autofocus>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">CNPJ</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Inscrição Estadual</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Nome Fantasia</label>
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
        <div class="field m-0 pt-0 column is is-one-third">
          <label class="label">Razão Social</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Inscrição Municipal</label>
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
          <label class="label">Nacionalidade</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Data de Abertura</label>
          <div class="control">
            <input class="input is-small" type="date">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">CNAE</label>
          <div class="control">
            <input class="input is-small" type="date">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
    </div>
    <div hidden id="conteudo2" class="p-4 conteudo">
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-third">
          <label class="label">Telefone</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">E-mail</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
    </div>
    <div hidden id="conteudo3" class="p-4 conteudo">
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-third">
          <label class="label">CEP</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is is-one-third">
          <label class="label">Endereço</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Número</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Complemento</label>
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
          <label class="label">Bairro</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Estado</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-1 column is-one-quarter">
          <label class="label">Município</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
    </div>
    <div hidden id="conteudo4" class="p-4 conteudo">
      <div class="columns m-0">
        <div class="column is-full pt-0">
          <input hidden name="warning" type="checkbox">
          <fa class="fa" icon="toggle-off" />
          <label for="danger" class="menu-label">
            Cliente
          </label>
        </div>
      </div>
      <div class="columns m-0">
        <div class="column is-full pt-0">
          <input hidden name="warning" type="checkbox">
          <fa class="fa" icon="toggle-off" />
          <label for="danger" class="menu-label">
            Fornecedor
          </label>
        </div>
      </div>
      <div class="columns m-0">
        <div class="column is-full pt-0">
          <input hidden name="warning" type="checkbox">
          <fa class="fa" icon="toggle-off" />
          <label for="danger" class="menu-label">
            Transportadora
          </label>
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
        <a href="/empresa/clientes" class="button is-danger">
          Cancelar
        </a>
      </p>
    </div>
  </div>
</template>

<script lang="ts">
export default {
  name: "FormularioEmpresa",
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

.fa {
  height: 1.6rem;
  color: #4e71dd;
}

</style>