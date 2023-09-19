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
      <li><a><fa icon="gauge-high" /> Painel Geral</a></li>
      <li><a><fa icon="gears" /> Testes</a></li>
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
            <li><a>Visão Geral</a></li>
            <li><a>Relatórios</a></li>
          </ul>
        </template>
      </li>
      <li>
        <a class="expande" :class="{ 'is-active': menus[1].expande }" @click="expandir(1)">
          <fa icon="scroll" /> Notas</a>
        <template v-if="menus[1].expande">
          <ul>
            <li><a href="/notas">Emissão de Nota</a></li>
            <li><a>Nota de Saída</a></li>
          </ul>
        </template>
      </li>
      <li>
        <a class="expande" :class="{ 'is-active': menus[2].expande }" @click="expandir(2)">
          <fa icon="box-open" /> Produção</a>
        <template  v-if="menus[2].expande">
          <ul>
            <li><a>Metas</a></li>
            <li><a href="/producao/taloes">Entrada de Talão</a></li>
            <li><a href="/producao/taloes/saida">Saída de Talão</a></li>
            <li><a href="/producao/produtos">Produtos</a></li>
            <li><a>Montar Layout</a></li>
            <li><a>Relatórios</a></li>
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
        <a class="" href="/usuarios"><fa icon="user" /> Usuários</a>
      </li>
      <li>
        <a class="expande" :class="{ 'is-active': menus[3].expande }" @click="expandir(3)">
          <fa icon="shop" /> Empresa</a>
        <template  v-if="menus[3].expande">
          <ul>
            <li><a href="/empresa/formulario">Dados Cadastrais</a></li>
            <li><a href="/empresa/clientes">Clientes</a></li>
          </ul>
        </template>
      </li>
    </ul>
    <ul class="menu-list">
      <li>
        <a class=""><fa icon="id-badge" /> Funcionários</a>
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
