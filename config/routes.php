<?php

use Dam\Atelier\Controller\{Configuracao\ListarConfiguracoesGerais,
    Configuracao\SalvarConfiguracoes,
    DarSaida\DarSaida,
    Documentos\VisualizarDocumentos,
    Documentos\VisualizarImagens,
    Documentos\VisualizarLogo,
    Empresa\ListarConfiguracoesEmpresa,
    Empresa\PersistirEmpresa,
    Funcao\ExcluirFuncao,
    Funcao\FormularioEdicaoFuncao,
    Funcao\FormularioFuncao,
    Funcao\ListarFuncoes,
    Funcao\PersistirFuncao,
    IndexController,
    Login\FormularioLogin,
    Login\RealizaLogin,
    Modelo\ExcluirModelo,
    Modelo\FormularioAdicaoModelo,
    Modelo\FormularioEdicaoModelo,
    Modelo\ListarModelos,
    Modelo\PersistenciaModelo,
    Modelo\Talao\ExcluirTalao,
    Modelo\Talao\FormularioEdicaoTalao,
    Modelo\Talao\FormularioAdicaoTalao,
    Modelo\Talao\ListarTaloes,
    Modelo\Talao\PersistenciaTalao,
    Modelo\Talao\RealizaSaidaTalao,
    Usuario\ExcluirUsuario,
    Usuario\FormularioEdicaoUsuario,
    Usuario\FormularioPermissoes,
    Usuario\FormularioUsuario,
    Usuario\ListarUsuarios,
    Usuario\PersistenciaPermissoes,
    Usuario\PersistenciaUsuario};

return [
    '/' => IndexController::class,
    '/login' => FormularioLogin::class,
    '/realiza-login' => RealizaLogin::class,
    '/modelos' => ListarModelos::class,
    '/novo-modelo' => FormularioAdicaoModelo::class,
    '/alterar-modelo' => FormularioEdicaoModelo::class,
    '/salvar-modelo' => PersistenciaModelo::class,
    '/excluir-modelo' => ExcluirModelo::class,
    '/taloes' => ListarTaloes::class,
    '/novo-talao' => FormularioAdicaoTalao::class,
    '/alterar-talao' => FormularioEdicaoTalao::class,
    '/salvar-talao' => PersistenciaTalao::class,
    '/excluir-talao' => ExcluirTalao::class,
    '/dar-saida' => RealizaSaidaTalao::class,
    '/usuarios' => ListarUsuarios::class,
    '/novo-usuario' => FormularioUsuario::class,
    '/alterar-usuario' => FormularioEdicaoUsuario::class,
    '/salvar-usuario' => PersistenciaUsuario::class,
    '/excluir-usuario' => ExcluirUsuario::class,
    '/alterar-permissoes' => FormularioPermissoes::class,
    '/salvar-permissoes' => PersistenciaPermissoes::class,
    '/configuracoes' => ListarConfiguracoesGerais::class,
    '/salvar-configuracoes' => SalvarConfiguracoes::class,
    '/funcoes' => ListarFuncoes::class,
    '/nova-funcao' => FormularioFuncao::class,
    '/alterar-funcao' => FormularioEdicaoFuncao::class,
    '/salvar-funcao' => PersistirFuncao::class,
    '/excluir-funcao' => ExcluirFuncao::class,
    '/formulario-saida' => DarSaida::class,
    '/empresa' => ListarConfiguracoesEmpresa::class,
    '/salvar-empresa' => PersistirEmpresa::class,
    '/visualizar-documento' => VisualizarDocumentos::class,
    '/visualizar-imagem' => VisualizarImagens::class,
    '/visualizar-logo' => VisualizarLogo::class,
];
