<template>
  <div id="conteudo">
    <div class="columns">
      <div class="field column is-one-fifth">
        <label class="label">Código de Barras</label>
        <div class="control">
          <input class="input is-small" type="text" autofocus>
        </div>
      </div>
      <div class="field column is-one-fifth">
        <label class="label">Referência</label>
        <div class="control">
          <input class="input is-small" type="text">
        </div>
      </div>
      <div class="field column is-one-fifth">
        <label class="label">Semana</label>
        <div class="control">
          <input class="input is-small" type="text">
        </div>
      </div>
      <div class="field column is-one-quarter">
        <label class="label">Nota Fiscal</label>
        <div class="control">
          <input class="input is-small" type="text">
        </div>
      </div>
    </div>
    <div class="field is-one-fifth is-vcentered">
      <button class="button is-primary is-small mr-4">
        <fa icon="search" class="mr-1"/>Buscar</button>
      <a href="/producao/taloes/formulario" class="button is-info is-small mr-4">
        <fa icon="plus" class="mr-1"/>Novo</a>
    </div>

    <!--    TABELA      -->
    <table class="table is-striped is-hoverable is-fullwidth">
      <thead>
      <tr>
        <th style="width: 4%">#</th>
        <th class="px-0">Referência</th>
        <th class="px-0" style="width: 8%">Produção</th>
        <th class="px-0" style="width: 8%">Sublote</th>
        <th class="px-0" style="width: 8%">Semana</th>
        <th class="px-0" style="width: 8%">Quantidade</th>
        <th class="px-0" style="width: 8%">Valor E.</th>
        <th class="px-0" style="width: 8%">Valor S.</th>
        <th class="px-0" style="width: 8%">Entrada</th>
        <th class="px-0" style="width: 10%">Saída</th>
        <th class="px-0 has-text-centered" style="width: 12%">Ações</th>
      </tr>
      </thead>
      <tbody>
      <tr class="bg-success">
        <th>1</th>
        <td class="is-vcentered">Sandália</td>
        <td class="is-vcentered">10</td>
        <td class="is-vcentered">25</td>
        <td class="is-vcentered">13</td>
        <td class="is-vcentered">10</td>
        <td class="is-vcentered">1,56</td>
        <td class="is-vcentered">2,02</td>
        <td class="is-vcentered">10/08/2023</td>
        <td class="is-vcentered">13/08/2023 08:52</td>
        <td class="has-text-centered is-vcentered has-text-info">
          <span class="m-1"><fa icon="eye" /></span>
          <span class="m-1"><fa icon="file-pdf" /></span>
          <span class="m-1"><fa icon="camera" /></span>
          <span class="m-1"><fa icon="edit" /></span>
          <span class="m-1 has-text-danger"><fa icon="trash-can" /></span>
        </td>
      </tr>
      <tr class="bg-danger">
        <th>2</th>
        <td class="is-vcentered">Sapato</td>
        <td class="is-vcentered">10</td>
        <td class="is-vcentered">25</td>
        <td class="is-vcentered">13</td>
        <td class="is-vcentered">10</td>
        <td class="is-vcentered">1,56</td>
        <td class="is-vcentered">2,02</td>
        <td class="is-vcentered">15/08/2023</td>
        <td class="is-vcentered"></td>
        <td class="has-text-centered is-vcentered has-text-info">
          <span class="m-1"><fa icon="eye" /></span>
          <span class="m-1"><fa icon="file-pdf" /></span>
          <span class="m-1"><fa icon="camera" /></span>
          <span class="m-1"><fa icon="edit" /></span>
          <span class="m-1 has-text-danger"><fa icon="trash-can" /></span>
        </td>
      </tr>
      <tr class="bg-warning">
        <th>3</th>
        <td class="is-vcentered">Sapatilha</td>
        <td class="is-vcentered">10</td>
        <td class="is-vcentered">25</td>
        <td class="is-vcentered">13</td>
        <td class="is-vcentered">10</td>
        <td class="is-vcentered">1,56</td>
        <td class="is-vcentered">2,02</td>
        <td class="is-vcentered">15/08/2023</td>
        <td class="is-vcentered">15/08/2023 13:55</td>
        <td class="has-text-centered is-vcentered has-text-info">
          <span class="m-1"><fa icon="eye" /></span>
          <span class="m-1"><fa icon="file-pdf" /></span>
          <span class="m-1"><fa icon="camera" /></span>
          <span class="m-1"><fa icon="edit" /></span>
          <span class="m-1 has-text-danger"><fa icon="trash-can" /></span>
        </td>
      </tr>
      <tr class="bg-success">
        <th>4</th>
        <td class="is-vcentered">Calçado</td>
        <td class="is-vcentered">10</td>
        <td class="is-vcentered">25</td>
        <td class="is-vcentered">13</td>
        <td class="is-vcentered">10</td>
        <td class="is-vcentered">1,56</td>
        <td class="is-vcentered">2,02</td>
        <td class="is-vcentered">16/08/2023</td>
        <td class="is-vcentered">17/08/2023 10:25</td>
        <td class="has-text-centered is-vcentered has-text-info">
          <span class="m-1"><fa icon="eye" /></span>
          <span class="m-1"><fa icon="file-pdf" /></span>
          <span class="m-1"><fa icon="camera" /></span>
          <span class="m-1"><fa icon="edit" /></span>
          <span class="m-1 has-text-danger"><fa icon="trash-can" /></span>
        </td>
      </tr>
      </tbody>
      <tfoot>
      <tr>
        <th colspan="11"><abbr title="Position">Resumo</abbr></th>
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
  name: "TaloesView"
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

.bg-danger {
  background: #f6b3b3 !important;
}
.bg-warning {
  background: #f6edb3 !important;
}
.bg-success {
  background: #b3f6b6 !important;
}

</style>