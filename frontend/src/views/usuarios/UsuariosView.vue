<template>
  <div id="conteudo">
    <div class="columns">
      <div class="field column is-one-quarter">
        <label class="label">Usuários</label>
        <div class="control">
          <input ref="busca" class="input is-small" type="text" autofocus @keyup.enter="buscar">
        </div>
      </div>
    </div>
    <div class="field is-one-fifth is-vcentered">
      <button class="button is-primary is-small mr-4" @click="buscar">
        <fa icon="search" class="mr-1"/>Buscar</button>
      <router-link to="/usuarios/formulario" class="button is-info is-small mr-4">
        <fa icon="plus" class="mr-1"/>Novo</router-link>
    </div>

    <!--    TABELA      -->
    <table class="table is-striped is-hoverable is-fullwidth">
      <thead>
      <tr>
        <th style="width: 5%">#</th>
        <th class="px-0" style="width: 20%">Usuários</th>
        <th class="px-0">Funcionário</th>
        <th class="px-0 has-text-centered" style="width: 10%">Ações</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="item in usuariosPorPagina" :key="item.id">
        <th>{{ item.id }}</th>
        <td class="is-vcentered">{{ item.usuario }}</td>
        <td class="is-vcentered">{{ item.nome }}</td>
        <td class="has-text-centered is-vcentered has-text-info">
          <a class="m-1"><fa icon="bars" /></a>
          <router-link :to="'usuarios/formulario?id=' + item.id" class="m-1"><fa icon="edit" /></router-link>
          <a class="m-1 has-text-danger"  @click="excluir( item.id )"><fa icon="trash-can" /></a>
        </td>
      </tr>
      </tbody>
      <tfoot>
      <tr>
        <th colspan="8">Total: {{ usuarios.length }}</th>
      </tr>
      </tfoot>
    </table>

    <!--    PAGINADOR   -->
    <Paginador :perPage="perPage" :itens="usuarios" @update:currentPage="updateCurrentPage" />
    <Excluir ref="Excluir" />
  </div>
</template>

<script lang="js">
import http from "../../services/http";
import Paginador from "@/components/templates/Paginador";
import Excluir from "@/components/templates/Excluir";

export default {
  name: "UsuariosView",
  components: {Paginador, Excluir},
  data() {
    return {
      usuarios: [],
      perPage: 5,
      currentPage: 1,
      confirmar: {
        preposicao: 'o usuário',
        objeto: 'usuario',
        id: null
      },
    }
  },
  async mounted() {
    await this.listar();
  },
  methods: {
    excluir(id) {
        this.$refs.Excluir.mostrarExcluir(id, this.confirmar.objeto, this.confirmar.preposicao);
    },
    listar: async function () {
      try {
        const response = await http.get('api/usuarios/listar');
        this.usuarios = response.data.usuarios;
      } catch (e) {
        this.$root.mostrarFlashMenssage('danger', 'Erro', e);
        console.error(e);
      }
    },
    updateCurrentPage(page) {
      this.currentPage = page;
    },
    buscar: async function () {
      try {
        const busca = this.$refs.busca.value;
        const response = await http.post('api/usuarios/buscar', busca);
        this.usuarios = response.data.usuarios;
      } catch (e) {
        this.$root.mostrarFlashMenssage('danger', 'Erro', e);
        console.error(e);
      }
    },

  },
  computed: {
    usuariosPorPagina() {
      const startIndex = (this.currentPage - 1) * this.perPage;
      return this.usuarios.slice(startIndex, startIndex + this.perPage);
    },
  },
}
</script>

<style scoped>
#conteudo {
  margin: 1rem;
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