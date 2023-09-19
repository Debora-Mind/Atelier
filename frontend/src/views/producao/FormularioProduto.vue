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
            <span>Impostos</span>
          </a>
        </li>
        <li id="aba3" @click="selecionarAba('3')" class="aba">
          <a>
            <span>Tributário</span>
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
          <label class="label">Descrição</label>
          <div class="control">
            <input class="input is-small" type="text" autofocus>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Tipo de Produto</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Departamento</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Classe</label>
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
          <label class="label">Cliente</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Referência de Fabrica</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Código Real</label>
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
          <label class="label">Grupo</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 py-0 column is-one-fifth">
          <label class="label">Subgrupo</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Código Real</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-1 column is-one-quarter">
          <label class="label">Código de Barras Real</label>
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
        <div class="column pt-0">
          <div class="file is-small is-info has-name column is-half p-0">
            <label class="file-label">
              <input class="file-input" type="file" name="resume">
              <span class="file-cta">
                <span class="file-icon">
                  <fa icon="fa-upload"></fa>
                </span>
                <span class="file-label">
                  Foto
                </span>
              </span>
              <span class="file-name">
                Screen Shot 2017-07-29 at 15.54.25.png
              </span>
            </label>
          </div>
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
                  Roteiro
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
          <label class="label">Valor</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Valor Entrada</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Valor Saída</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Lucro Bruto</label>
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
          <label class="label">Código CFOP Saída</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Código CFOP Entrada</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">CEST</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Percentual MVA</label>
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
          <label class="label">PIS</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 py-0 column is-one-fifth">
          <label class="label">Calculo PIS</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Aliquota PIS</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 py-0 column is-one-fifth">
          <label class="label">COFINS</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 py-0 column is-one-fifth">
          <label class="label">Calculo COFINS</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Aliquota COFINS</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 py-0 column is-one-fifth">
          <label class="label">IPI</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 py-0 column is-one-fifth">
          <label class="label">Calculo IPI</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Aliquota IPI</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 py-0 column is-one-fifth">
          <label class="label">ICMS A</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 py-0 column is-one-fifth">
          <label class="label">ICMS B</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Calculo ICMS</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Aliquota ICMS</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
    </div>
    <div hidden id="conteudo3" class="p-4 conteudo">
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-third">
          <label class="label">Un. Med. Entrada</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Un. Med. Saída</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Un. Med. Tributada</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-fifth">
          <label class="label">Benefício Fiscal</label>
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
          <label class="label">Cliente</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Quantidade Tributada</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Valor Tributario</label>
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
          <label class="label">Tipo de Item</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <div class="columns m-0">
        <div class="field m-0 pt-0 column is-one-quarter">
          <label class="label">Nomenclatura Mercosul</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 pt-1 column is-one-quarter">
          <label class="label">Origem do Produto</label>
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
        <div class="column pt-0">
          <div class="is-small is-info is-half p-0">
            <input class="checkbox" type="checkbox" name="resume">
            <label class="menu-label"> Vender sem Estoque </label>
          </div>
        </div>
      </div>
      <div class="columns m-0">
        <div class="column pt-0">
          <div class="is-small is-info is-half p-0">
            <input class="checkbox" type="checkbox" name="resume">
            <label class="menu-label"> Vendido por Peso </label>
          </div>
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
        <a href="/producao/produtos" class="button is-danger">
          Cancelar
        </a>
      </p>
    </div>
  </div>
</template>

<script lang="ts">
export default {
  name: "FormularioProduto",
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