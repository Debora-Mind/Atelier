<template>
  <div id="conteudo">
    <div class="columns">
      <div class="field column is-one-quarter">
        <label class="label">Cliente</label>
        <div class="control">
          <input class="input is-small" type="text" autofocus>
        </div>
      </div>
      <div class="field column is-one-fifth">
        <label class="label">CPF/CNPJ</label>
        <div class="control">
          <input class="input is-small" type="text">
        </div>
      </div>
    </div>
    <div class="field is-one-fifth is-vcentered">
      <button class="button is-primary is-small mr-4">
        <fa icon="search" class="mr-1"/>Buscar</button>
      <a href="/empresa/clientes/formulario" class="button is-info is-small mr-4">
        <fa icon="plus" class="mr-1"/>Novo</a>
    </div>

    <!--    TABELA      -->
    <table class="table is-striped is-hoverable is-fullwidth">
      <thead>
      <tr>
        <th style="width: 5%">#</th>
        <th class="px-0">Cliente</th>
        <th class="px-0" style="width: 15%">CPF/CNPJ</th>
        <th class="px-0 has-text-centered" style="width: 10%">Ações</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <th>1</th>
        <td class="is-vcentered">Picadilly</td>
        <td class="is-vcentered">123.45.456.0001-45</td>
        <td class="has-text-centered is-vcentered has-text-info">
          <span class="m-1"><fa icon="edit" /></span>
          <span class="m-1 has-text-danger"><fa icon="trash-can" /></span>
        </td>
      </tr>
      </tbody>
      <tfoot>
      <tr>
        <th colspan="4"><abbr title="Position">Resumo</abbr></th>
      </tr>
      </tfoot>
    </table>

    <!--    PAGINADOR   -->
    <nav class="pagination is-centered py-1" role="navigation" aria-label="pagination">
      <a class="pagination-previous">Previous</a>
      <a class="pagination-next">Next page</a>
      <ul class="pagination-list">
        <li><a class="pagination-link" aria-label="Goto page 1">1</a></li>
        <li><span class="pagination-ellipsis">&hellip;</span></li>
        <li><a class="pagination-link" aria-label="Goto page 45">45</a></li>
        <li><a class="pagination-link is-current" aria-label="Page 46" aria-current="page">46</a></li>
        <li><a class="pagination-link" aria-label="Goto page 47">47</a></li>
        <li><span class="pagination-ellipsis">&hellip;</span></li>
        <li><a class="pagination-link" aria-label="Goto page 86">86</a></li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  name: "ProdutosView"
}
</script>

<style scoped>
#conteudo {
  margin: 1rem;
}

.button {

}

table {
  background: #f6f7fa;
  font-size: 0.8rem;
}
tr td {
  padding: 0 2px;
}

.field {
  margin-bottom: 0;
  padding-bottom: 0;
}

.label {
  font-size: 0.8rem;
}

</style>