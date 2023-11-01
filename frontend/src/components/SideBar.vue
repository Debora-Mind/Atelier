<template>
  <aside class="menu column has-background-dark is-one-fifth pt-5 px-2">
    <div class="navbar-brand">
      <h3><a class="navbar-item" href="/"><fa icon="gear"  class="mr-2"/>TÉCNICO<sup>1.0.0</sup></a></h3>

      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
    <hr>
    <ul class="menu-list">
      <li><router-link to=""><fa icon="gauge-high" /> Painel Geral</router-link></li>
      <li><router-link to=""><fa icon="gears" /> Testes</router-link></li>
    </ul>
    <hr>
    <p class="menu-label">
      Administração
    </p>
    <ul class="menu-list">
      <li>
        <a class="expande" :class="{ 'is-active': menus[0].expande }" @click="expandir(0)">
          <fa icon="chart-line" /> Faturamento</a>
        <template v-if="menus[0].expande">
          <ul>
            <li><router-link to="">Visão Geral</router-link></li>
            <li><router-link to="">Relatórios</router-link></li>
          </ul>
        </template>
      </li>
      <li>
        <a class="expande" :class="{ 'is-active': menus[1].expande }" @click="expandir(1)">
          <fa icon="scroll" /> Notas</a>
        <template v-if="menus[1].expande">
          <ul>
            <li><router-link to="/notas">Emissão de Nota</router-link></li>
            <li><router-link to="">Nota de Saída</router-link></li>
          </ul>
        </template>
      </li>
      <li>
        <a class="expande" :class="{ 'is-active': menus[2].expande }" @click="expandir(2)">
          <fa icon="box-open" /> Produção</a>
        <template  v-if="menus[2].expande">
          <ul>
            <li><router-link to="">Metas</router-link></li>
            <li><router-link to="/producao/taloes">Entrada de Talão</router-link></li>
            <li><router-link to="/producao/taloes/saida">Saída de Talão</router-link></li>
            <li><router-link to="/producao/produtos">Produtos</router-link></li>
            <li><router-link to="">Montar Layout</router-link></li>
            <li><router-link to="">Relatórios</router-link></li>
          </ul>
        </template>
      </li>
    </ul>
    <hr>
    <p class="menu-label">
      Sistema
    </p>
    <ul class="menu-list">
      <li>
        <router-link to="/usuarios"><fa icon="user" /> Usuários</router-link>
      </li>
      <li>
        <a class="expande" :class="{ 'is-active': menus[3].expande }" @click="expandir(3)">
          <fa icon="shop" /> Empresa</a>
        <template  v-if="menus[3].expande">
          <ul>
            <li><router-link to="/empresa/formulario">Dados Cadastrais</router-link></li>
            <li><router-link to="/empresa/clientes">Clientes</router-link></li>
          </ul>
        </template>
      </li>
    </ul>
    <ul class="menu-list">
      <li>
        <router-link to=""><fa icon="id-badge" /> Funcionários</router-link>
      </li>
    </ul>
  </aside>
</template>

<script>
export default {
  name: "SideBar",
  data() {
    return {
      menus: [
        { id: 'faturamento', expande: false },
        { id: 'notas', expande: false },
        { id: 'producao', expande: false },
        { id: 'empresa', expande: false },
      ],
    }
  },

  methods: {
    expandir(menuId) {
      const menu = this.menus[menuId];
      if (menu) {
        this.menus[menuId].expande = !this.menus[menuId].expande
      }
    }
  }
}
</script>

<style scoped>
.menu-list li a {
  color: whitesmoke;
}

.menu-list li a:hover {
  background: #00d0b1;
}

.menu-list li a.is-active {
  background: #00d0b1;
}
.navbar-item {
  color: #00d0b1;
}

.navbar-item:hover {
  color: #00d0b1;
}

.menu-label{
  color: #00d0b1
}

.is-one-fifth {
  width: 36vh;
}

aside {
  min-height: 100vh;
  max-width: 100%;
}
 hr {
   height: 1px;
   margin: 2px;
 }

aside.menu {
  position: relative;
}

h3 {
  font-size: 1.4rem;
}
</style>
