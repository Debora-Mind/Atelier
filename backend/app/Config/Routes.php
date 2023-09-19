<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//Request
$routes->group('api', ['namespace' => 'App\Controllers\API'], function ($routes) {
    $routes->options('teste', 'Teste::options'); // Lidar com requisições OPTIONS para /api/teste
});
$routes->get('api/teste', 'Teste::index'); // Lidar com requisições POST para /api/teste

$routes->options('api/', function () {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
});

//Login
$routes->post('api/login', 'Login::login', ['filter' => 'cors']);

//Empresa
$routes->get('api/empresa/formulario-cliente', 'Empresa\Empresa::formulario');
$routes->post('empresa/gravar-cliente', 'Empresa\Empresa::gravarCliente');
$routes->get('empresa/editar-cliente', 'Empresa\Empresa::editarCliente');

//Usuarios

$routes->get('api/usuarios/listar', 'Usuarios\Usuarios::listar');
$routes->post('api/usuarios/buscar', 'Usuarios\Usuarios::buscar');


//FIM DAS NOVAS ROTAS

//Usuário padrão
$routes->get('sistema', 'Home::index');

//Usuário Admin
$routes->get('painel', 'Painel\Dashboard::index');

//Usuário Técnico
//$routes->get('teste', 'Notas\EnviarEmailNFe::store');

//Metas
$routes->get('producao/metas', 'Metas\Metas::index');
$routes->post('producao/metas', 'Metas\Metas::gravar');

//Empresa
$routes->get('empresa', 'Empresa\Empresa::date');
$routes->post('empresa/salvar-empresa', 'Empresa\Empresa::gravar');
$routes->get('empresa/excluir/(:num)', 'Empresa\Empresa::excluir/$1');
$routes->get('empresa/excluir/(:num)', 'Empresa\Empresa::excluir/$1');
$routes->get('empresa/clientes', 'Empresa\Empresa::ListarClientes');
$routes->get('empresa/formulario-cliente', 'Empresa\Empresa::formularioCliente');
$routes->post('empresa/gravar-cliente', 'Empresa\Empresa::gravarCliente');
$routes->get('empresa/editar-cliente', 'Empresa\Empresa::editarCliente');
$routes->get('empresa/remover-cliente', 'Empresa\Empresa::removerCliente');
//Notas
$routes->group('api', ['namespace' => 'App\Controllers\API'], function ($routes) {
    $routes->options('notas', 'Notas\NFe::options'); // Lidar com requisições OPTIONS para /api/teste
});
$routes->get('api/notas/listar', 'Notas\NFe::listar');


$routes->get('notas/cadastrar', 'Notas\NFe::formulario');
$routes->post('notas/salvar-nfe', 'Notas\NFe::gravar');
$routes->post('notas/editar-nfe', 'Notas\NFe::editar');
$routes->get('notas/faturar', 'Notas\GeraXMLPOST::store');
$routes->get('notas/transmitir', 'Notas\GeraXMLPOST::transmitir');
$routes->get('notas/imprimir', 'Notas\ImprimirPost::store');
$routes->get('notas/gerarxml', 'Notas\GeraXMLPOST::store');
$routes->get('notas/enviar-email', 'Notas\EnviarEmailNFe::enviarEmail');
$routes->get('notas/status-sefaz', 'Notas\ConsultarStatusSefaz::index');

//$routes->get('api/usuarios/salvar-usuario', 'Usuarios\Usuarios::novo');

$routes->get('api/usuarios/formulario', 'Usuarios\Usuarios::formulario', ['filter' => 'cors']);
$routes->post('api/usuarios/salvar-usuario', 'Usuarios\Usuarios::novo', ['filter' => 'cors']);
$routes->get('api/usuarios/salvar-usuario', 'Usuarios\Usuarios::novo', ['filter' => 'cors']);
//$routes->post('api/usuarios/salvar-usuario', 'Usuarios\Usuarios::editar');

$routes->post('api/usuarios/excluir-usuario', 'Usuarios\Usuarios::excluir', ['filter' => 'cors']);
$routes->post('usuarios/editar-permissoes/(:num)', 'Usuarios\Usuarios::permissaoEditar/$1');
$routes->get('usuarios/alterar-permissoes', 'Usuarios\Usuarios::permissaoGravar');
//Produção
$routes->get('producao/produtos', 'Producao\Produtos::listar');
$routes->get('producao/produtos/formulario', 'Producao\Produtos::formulario');
$routes->get('producao/editar-produto', 'Producao\Produtos::formulario');
$routes->post('producao/salvar-produto', 'Producao\Produtos::gravar');
$routes->get('producao/produtos/remover', 'Producao\Produtos::remover');
$routes->get('producao/visualizar-imagem', 'Producao\Produtos::visualizarImagem');
$routes->get('producao/visualizar-pdf', 'Producao\Produtos::visualizarPDF');
$routes->get('producao/taloes', 'Producao\Taloes::listar');
$routes->get('producao/talao/formulario', 'Producao\Taloes::formulario');
$routes->post('producao/salvar-talao', 'Producao\Taloes::gravar');
$routes->get('producao/taloes/remover', 'Producao\Taloes::remover');
$routes->get('producao/taloes/editar', 'Producao\Taloes::formulario');
$routes->get('producao/taloes/saida-taloes', 'Producao\Taloes::saida');
$routes->get('producao/taloes/saida', 'Producao\Taloes::formularioSaida');
$routes->post('producao/taloes/saida-formulario', 'Producao\Taloes::saidaFormulario');



//$routes->get('admin', 'PainelAdministrador\Home::index');
//$routes->get('admin/usuarios', 'PainelAdministrador\usuarios::index');
//$routes->match(['get', 'post'], 'admin/usuarios/gravar', 'PainelAdministrador\usuarios::gravar');
//$routes->get('admin/usuarios/excluir/(:num)', 'PainelAdministrador\usuarios::excluir/$1');
//$routes->post('admin/usuarios/editarSenha', 'PainelAdministrador\usuarios::editar');
//$routes->get('admin/categorias', 'PainelAdministrador\Notas::index');
//$routes->post('admin/categorias/gravar', 'PainelAdministrador\Notas::gravar');
//$routes->get('admin/categorias/excluir/(:num)', 'PainelAdministrador\Notas::excluir/$1');
//$routes->get('admin/categorias/editar/(:num)', 'PainelAdministrador\Notas::editar/$1');
//$routes->get('admin/noticias', 'PainelAdministrador\Noticias::index');
//$routes->post('admin/noticias/gravar', 'PainelAdministrador\Noticias::gravar');
//$routes->get('admin/noticias/excluir/(:num)', 'PainelAdministrador\Noticias::excluir/$1');
//$routes->get('admin/noticias/editar/(:num)', 'PainelAdministrador\Noticias::editar/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
