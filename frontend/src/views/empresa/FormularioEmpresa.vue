<template>
  <div id="main">
    <div class="tabs is-boxed mb-0">
      <ul>
        <li id="aba1" @click="selecionarAba('1')" class="aba is-active">
          <a>
            <span>Geral</span>
          </a>
        </li>
        <li id="aba2" @click="selecionarAba('2')" class="aba">
          <a>
            <span>Endereço</span>
          </a>
        </li>
        <li id="aba3" @click="selecionarAba('3')" class="aba">
          <a>
            <span>NFe</span>
          </a>
        </li>
        <li id="aba4" @click="selecionarAba('4')" class="aba">
          <a>
            <span>E-mail</span>
          </a>
        </li>
        <li id="aba5" @click="selecionarAba('5')" class="aba">
          <a>
            <span>Configurações</span>
          </a>
        </li>
      </ul>
    </div>
    <div id="conteudo1" class="p-4 conteudo">
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-third">
          <label class="label">Nome Fantasia</label>
          <div class="control">
            <input class="input is-small" type="text" autofocus :value="empresa ? empresa.nome_fantasia : ''">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Razão Social</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text" :value="empresa ? empresa.razao_social : ''">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="column pt-0">
          <div class="file is-small is-info has-name column is-half p-0">
            <label class="file-label">
              <input class="file-input" type="file" name="resume">
              <span class="file-cta">
                <span class="file-icon">
                  <fa icon="fa-upload"></fa>
                </span>
                <span class="file-label">
                  Logo
                </span>
              </span>
              <span class="file-name">
                Screen Shot 2017-07-29 at 15.54.25.png
              </span>
            </label>
          </div>
        </div>
      </div>
    </div>
    <div hidden id="conteudo2" class="p-4 conteudo">
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-third">
          <label class="label">CEP</label>
          <div class="control">
            <input class="input is-small" type="text" :value="empresa ? empresa.cep : ''">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is is-one-third">
          <label class="label">Endereço</label>
          <div class="control">
            <input class="input is-small" type="text" :value="empresa ? empresa.logradouro : ''">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Número</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text" :value="empresa ? empresa.numero : ''">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Complemento</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text" :value="empresa ? empresa.emitentexCpl : ''">
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
            <input class="input is-small" type="text" :value="empresa ? empresa.bairro : ''">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 py-0 column is-one-fifth">
          <label class="label">Estado</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text" :value="empresa ? empresa.uf : ''">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Município</label>
          <div class="control">
            <input class="input is-small" type="text" :value="empresa ? empresa.municipio : ''">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
    </div>
    <div hidden id="conteudo3" class="p-4 conteudo">
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-third">
          <label class="label">CNPJ</label>
          <div class="control">
            <input class="input is-small" type="text" :value="empresa ? empresa.cnpj : ''">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is is-one-third">
          <label class="label">Inscrição Estadual</label>
          <div class="control">
            <input class="input is-small" type="text" :value="empresa ? empresa.ie : ''">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Inscrição Municipal</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text" :value="empresa ? empresa.im : ''">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 py-0 column is-one-fifth">
          <label class="label">CNAE</label>
          <div class="control">
            <input class="input is-small" type="text" :value="empresa ? empresa.CNAE : ''">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Regime Tributário</label>
          <div class="control">
            <input class="input is-small" type="text" :value="empresa ? empresa.CRT_ID : ''">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="column is-two-fifths">
          <div class="file is-small is-info has-name column px-0">
            <label class="file-label">
              <input class="file-input" type="file" name="resume">
              <span class="file-cta">
                <span class="file-icon">
                  <fa icon="fa-upload"></fa>
                </span>
                <span class="file-label">
                  Certificado
                </span>
              </span>
              <span class="file-name">
                Screen Shot 2017-07-29 at 15.54.25.png
              </span>
            </label>
          </div>
        </div>
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Senha</label>
          <div class="control">
            <input class="input is-small" type="text" :value="empresa ? empresa.senha_centificado : ''">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
    </div>
    <div hidden id="conteudo4" class="p-4 conteudo">
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Host</label>
          <div class="control">
            <input class="input is-small" type="text" :value="empresa ? empresa.host : ''">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">E-mail</label>
          <div class="control">
            <input class="input is-small" type="text" :value="empresa ? empresa.user : ''">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Senha</label>
          <div class="control">
            <input class="input is-small" type="text" :value="empresa ? empresa.password : ''">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Segurança</label>
          <div class="control">
            <input class="input is-small" type="text" :value="empresa ? empresa.secure : ''">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Porta</label>
          <div class="control">
            <input class="input is-small" type="text" :value="empresa ? empresa.port : ''">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
    </div>
    <div hidden id="conteudo5" class="p-4 conteudo">
      <div class="columns m-0">
        <div class="column pt-0">
          <div style="display: flex;">
            <span class="mr-2 label pt-1">Ambiente</span>
            <label for="ambiente" class="radio homologacao is-active">
              <input name="ambiente" type="radio" class="bulma-ltr-rtl-mixin">
              Homogação
            </label>
            <label for="ambiente" class="radio producao">
              <input name="ambiente" type="radio" class="bulma-ltr-rtl-mixin">
              Produção
            </label>
          </div>
        </div>
      </div>
      <div class="columns m-0">
        <div class="column is-full pt-0">
            <input hidden name="danger" type="checkbox">
            <fa class="fa" :icon="'toggle-' + diasDanger" />
            <label for="danger" class="menu-label">
              modelos em destaque vermelho quando atingir <input class="dias" :value="empresa ? empresa.configuracoes : ''"> dias
            </label>
        </div>
      </div>
      <div class="columns m-0">
        <div class="column is-full pt-0">
          <input hidden name="warning" type="checkbox">
          <fa class="fa" :icon="'toggle-' + diasWarning" />
          <label for="warning" class="menu-label">
            modelos em destaque amarelo quando atingir <input class="dias"> dias
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
        <a href="/" class="button is-danger">
          Cancelar
        </a>
      </p>
    </div>
  </div>
</template>

<script>
import http from "../../services/http";
import {toArray} from "core-js/internals/async-iterator-iteration";

export default {
  name: "FormularioEmpresa",
  data() {
    return {
      abaAtiva: "conteudo1",
      empresa: [],
      erroValidacao: [],
      empresaSession: sessionStorage.getItem('empresa'),
      diasDanger: 'off',
      diasWarning: 'off',
      configuracoesEmpresa: []
    }
  },
  async mounted() {
    await this.getEmpresa(this.empresaSession);
  },
  methods: {
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

    getEmpresa: async function (id) {
      try {
        const response = await http.get('api/empresa/formulario-cliente?id=' + id);
        this.empresa = response.data.empresa
        console.log(response.data.configuracoesEmpresa)
      } catch (e) {
        this.$root.mostrarFlashMenssage('danger', 'Erro', e);
        console.error(e);
      }
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

.homologacao {
  border: solid 1px #4e72de;
  border-radius: 5px 0 0 5px;
  padding: 5px;
  margin: auto 0;
}

.homologacao.is-active {
  background: #4e72de;
  color: white;
}

.producao {
  border: solid 1px #4e72de;
  border-radius: 0 5px 5px 0;
  padding: 5px;
  margin: auto 0;
}

.producao.is-active {
  background: #4e72de;
  color: white;
}

.homologacao input {
  text-decoration: none;
}

.dias {
  width: 2rem;
}

.fa {
  height: 1.6rem;
  color: #4e71dd;
}
</style>