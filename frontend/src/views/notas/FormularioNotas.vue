<template>
  <div id="conteudo">
    <div class="tabs is-boxed mb-0">
      <ul>
        <li class="is-active">
          <a>
            <span>Principal</span>
          </a>
        </li>
        <li>
          <a>
            <span>Outros</span>
          </a>
        </li>
      </ul>
    </div>

    <div id="principal" class="p-4">
      <div class="columns m-0">
        <div class="field m-0 py-0 column">
          <label class="label">Cliente</label>
          <div class="control">
            <input class="input is-small" type="text" autofocus>
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 py-0 column is-one-quarter">
          <label class="label">Empresa</label>
          <div class="control has-icons-right">
            <input class="input is-small is-disabled" type="text" value="Nome da empresa" disabled>
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 py-0 column is-one-fifth">
          <label class="label">Número NF-e</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 py-0 column is-one-fifth">
          <label class="label">Série</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
      </div>
      <span>Itens da NF-e</span>
      <hr class="mt-0 mb-4">
      <div class="columns m-0">
        <div class="field m-0 py-0 column is-one-quarter">
          <label class="label">Produto</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 py-0 column is-one-fifth">
          <label class="label">Quantidade</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
        <div class="field m-0 py-0 column is-one-fifth">
          <label class="label">Valor</label>
          <div class="control has-icons-right">
            <input class="input is-small" type="text">
            <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span>
          </div>
          <small hidden class="is-danger">Mensagem</small>
        </div>
          <div class="field">
            <a class="button is-small is-info mt-5"><fa icon="plus" class="mr-1"/> Adicionar</a>
          </div>
      </div>
      <table class="table is-striped is-hoverable is-fullwidth mt-3">
        <thead>
        <tr>
          <th>#</th>
          <th>Produto</th>
          <th>Quantidade</th>
          <th>Valor</th>
          <th>Ações</th>
        </tr>
        </thead>
      </table>
    </div>

    <div id="botoes" class="field is-grouped is-grouped-right p-3">
      <p class="control">
        <a class="button is-primary">
          <fa icon="floppy-disk" class="mr-1" />Salvar
        </a>
      </p>
      <p class="control">
        <a href="/notas" class="button is-danger">
          Cancelar
        </a>
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: "FormularioNotas"
}
</script>

<style scoped>
  #conteudo {
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

  #principal {
    background: white;
    border: solid 1px #d5d4d4;
  }

  #botoes {
    border: solid 1px lightgrey;
    border-radius: 0 0 5px 5px;
    background: whitesmoke;
  }

</style>