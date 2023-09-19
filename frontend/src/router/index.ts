import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'painelGeral',
    component: () => import('../views/PainelGeral.vue')
  },
  {
    path: '/notas',
    name: 'notasView',
    component: () => import('../views/notas/NotasView.vue')
  },
  {
    path: '/notas/formulario',
    name: 'formularioNotas',
    component: () => import('../views/notas/FormularioNotas.vue')
  },
  {
    path: '/producao/produtos',
    name: 'produtosView',
    component: () => import('../views/producao/ProdutosView.vue')
  },
  {
    path: '/producao/produtos/formulario',
    name: 'formularioProdutos',
    component: () => import('../views/producao/FormularioProduto.vue')
  },
  {
    path: '/producao/taloes',
    name: 'taloesView',
    component: () => import('../views/producao/TaloesView.vue')
  },
  {
    path: '/producao/taloes/formulario',
    name: 'formularioTalao',
    component: () => import('../views/producao/FormularioTalao.vue')
  },
  {
    path: '/producao/taloes/saida',
    name: 'talaoSaida',
    component: () => import('../views/producao/TaloesSaida.vue')
  },
  {
    path: '/usuarios',
    name: 'usuariosView',
    component: () => import('../views/usuarios/UsuariosView.vue')
  },
  {
    path: '/usuarios/formulario',
    name: 'formularioUsuario',
    component: () => import('../views/usuarios/FormularioUsuario.vue')
  },
  {
    path: '/empresa/formulario',
    name: 'formularioEmpresa',
    component: () => import('../views/empresa/FormularioEmpresa.vue')
  },
  {
    path: '/empresa/clientes',
    name: 'clientesView',
    component: () => import('../views/empresa/ClientesView.vue')
  },
  {
    path: '/empresa/clientes/formulario',
    name: 'formularioCliente',
    component: () => import('../views/empresa/FormularioCliente.vue')
  },
  {
    path: '/painel-geral',
    name: 'painelGeral',
    component: () => import('../views/PainelGeral.vue')
  },

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
