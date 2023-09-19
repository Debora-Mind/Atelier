<template>
  <div id="conteudo" class="columns">
    <div class="column is-three-quarters">
      <div class="columns">
        <div class="field column is-one-quarter">
          <label class="label">Código de Barras</label>
          <div class="control">
            <input class="input is-small" type="text" autofocus>
          </div>
        </div>
        <div class="field column is-one-fifth">
          <label class="label">Produção/Sublote</label>
          <div class="control">
            <input class="input is-small" type="text">
          </div>
        </div>
      </div>
      <div class="field is-one-fifth is-vcentered">
        <button class="button is-primary is-small mr-4">
          <fa icon="box" class="mr-1"/>Saída</button>
      </div>

      <!--    TABELA      -->
      <table class="table is-striped is-hoverable is-fullwidth">
        <thead>
        <tr>
          <th class="is-size-5 pl-1" colspan="9">Últimas Saídas</th>
        </tr>
        </thead>
        <thead>
        <tr>
          <th style="width: 4%">#</th>
          <th class="px-0">Referência</th>
          <th class="px-0" style="width: 10%">Produção</th>
          <th class="px-0" style="width: 10%">Sublote</th>
          <th class="px-0" style="width: 10%">Semana</th>
          <th class="px-0" style="width: 12%">Quantidade</th>
          <th class="px-0" style="width: 12%">Entrada</th>
          <th class="px-0" style="width: 15%">Saída</th>
          <th class="px-0 has-text-centered" style="width: 8%">Ações</th>
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
          <td class="is-vcentered">10/08/2023</td>
          <td class="is-vcentered">13/08/2023 08:52</td>
          <td class="has-text-centered is-vcentered has-text-info">
            <span class="m-1"><fa icon="file-pdf" /></span>
            <span class="m-1"><fa icon="camera" /></span>
          </td>
        </tr>
        <tr class="bg-danger">
          <th>2</th>
          <td class="is-vcentered">Sapato</td>
          <td class="is-vcentered">10</td>
          <td class="is-vcentered">25</td>
          <td class="is-vcentered">13</td>
          <td class="is-vcentered">10</td>
          <td class="is-vcentered">15/08/2023</td>
          <td class="is-vcentered"></td>
          <td class="has-text-centered is-vcentered has-text-info">
            <span class="m-1"><fa icon="file-pdf" /></span>
            <span class="m-1"><fa icon="camera" /></span>
          </td>
        </tr>
        <tr class="bg-warning">
          <th>3</th>
          <td class="is-vcentered">Sapatilha</td>
          <td class="is-vcentered">10</td>
          <td class="is-vcentered">25</td>
          <td class="is-vcentered">13</td>
          <td class="is-vcentered">10</td>
          <td class="is-vcentered">15/08/2023</td>
          <td class="is-vcentered">15/08/2023 13:55</td>
          <td class="has-text-centered is-vcentered has-text-info">
            <span class="m-1"><fa icon="file-pdf" /></span>
            <span class="m-1"><fa icon="camera" /></span>
          </td>
        </tr>
        <tr class="bg-success">
          <th>4</th>
          <td class="is-vcentered">Calçado</td>
          <td class="is-vcentered">10</td>
          <td class="is-vcentered">25</td>
          <td class="is-vcentered">13</td>
          <td class="is-vcentered">10</td>
          <td class="is-vcentered">16/08/2023</td>
          <td class="is-vcentered">17/08/2023 10:25</td>
          <td class="has-text-centered is-vcentered has-text-info">
            <span class="m-1"><fa icon="file-pdf" /></span>
            <span class="m-1"><fa icon="camera" /></span>
          </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
          <th colspan="11"><abbr title="Position">08:54h desde a última saída</abbr></th>
        </tr>
        </tfoot>
      </table>
    </div>
    <div class="column is-one-quarter">
      <article class="message is-danger is-small">
        <div class="message-header">
          <p>Meta Dia</p>
        </div>
        <div class="message-body">
          <ul>
            <li>Total: 0</li>
          </ul>
        </div>
      </article>
      <article class="message is-info is-small">
        <div class="message-header">
          <p>Resultado Dia</p>
        </div>
        <div class="message-body">
          <ul>
            <li>Total: 0</li>
          </ul>
        </div>
      </article>
    </div>
  </div>
</template>

<script>
export default {
  name: "TaloesSaida"
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