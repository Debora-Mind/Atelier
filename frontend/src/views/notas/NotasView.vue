<template>
  <div id="conteudo">
    <div class="columns">
      <div class="field column is-one-quarter">
        <label class="label">Empresa</label>
        <div class="control">
          <input class="input is-small" type="text" autofocus>
        </div>
      </div>
      <div class="field column is-one-fifth">
        <label class="label">Nº NF-e</label>
        <div class="control">
          <input class="input is-small" type="text">
        </div>
      </div>
      <div class="field column is-one-fifth">
        <label class="label">Modelo</label>
        <div class="control">
          <input class="input is-small" type="text">
        </div>
      </div>
      <div class="field column is-one-fifth">
        <label class="label">Série</label>
        <div class="control">
          <input class="input is-small" type="text">
        </div>
      </div>
    </div>
    <div class="field is-one-fifth is-vcentered">
        <button class="button is-primary is-small mr-4">
          <fa icon="search" class="mr-1"/>Buscar</button>
        <a href="/notas/formulario" class="button is-info is-small mr-4">
          <fa icon="plus" class="mr-1"/>Novo</a>
        <button class="button is-info is-small mr-4">
          <fa icon="signal" class="mr-1"/>Status SEFAZ</button>
    </div>

    <!--    TABELA      -->
    <table class="table is-striped is-hoverable is-fullwidth">
      <thead>
      <tr>
        <th>Ações</th>
        <th>Cliente</th>
        <th><abbr title="Played">Status</abbr></th>
        <th><abbr title="Won">Retorno</abbr></th>
        <th><abbr title="Drawn">NºNF-e</abbr></th>
        <th><abbr title="Drawn">Série</abbr></th>
        <th><abbr title="Drawn">Protocolo</abbr></th>
        <th><abbr title="Drawn">Chave</abbr></th>
      </tr>
      </thead>
      <tbody>
        <template v-for="nota in notas" :key="nota.id">
        <tr>
        <th>
          <div class="select is-small">
            <select>
              <option>Ações NF-e</option>
              <option>Faturar</option>
            </select>
          </div>
        </th>
        <td class="is-vcentered">{{ nota.cliente }} - {{ nota.doc_cliente }}</td>
        <td class="is-vcentered mt-2 p-1 has-text-centered hero is-small"
            :class="'is-' + nota.cor_status"> {{ nota.status }}</td>
        <td class="is-vcentered">{{ nota.retorno }}</td>
        <td class="is-vcentered">{{ nota.numero_nfe }}</td>
        <td class="is-vcentered">{{ nota.ide_serie }}</td>
        <td class="is-vcentered">{{ nota.nProt }}</td>
        <td class="is-vcentered">{{ nota.ide_chave_nfe }}</td>
      </tr>
      </template>
      </tbody>
      <tfoot>
      <tr>
        <th colspan="8">Total: {{ notas.length }}</th>
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
import http from "@/services/http";

export default {
  name: "NotasView",
  data() {
    return {
      notas: [],
      clientes: [],
      status: []
    }
  },
  async mounted() {
    try {
      const data = await http.get('api/notas/listar')
      this.notas = data.data.nfes; // jsonData contém os dados como JSON
      console.log(this.notas)
    }catch (e) {
      console.log(e)
    }
  },
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