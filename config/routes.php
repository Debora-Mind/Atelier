<?php

use Dam\Atelier\Controller\{Configuracao\ListarConfiguracoesGerais,
    Configuracao\SalvarConfiguracoes,
    Funcao\FormularioFuncao,
    Funcao\ListarFuncoes,
    Funcao\PersistirFuncao,
    IndexController,
    Login\FormularioLogin,
    Login\RealizaLogin,
    Modelo\ExcluirModelo,
    Modelo\FormularioEdicaoModelo,
    Modelo\FormularioAdicaoModelo,
    Modelo\ListarModelos,
    Modelo\PersistenciaModelo,
    Modelo\RealizaSaidaModelo,
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
    '/salvar-modelo' => PersistenciaModelo::class,
    '/alterar-modelo' => FormularioEdicaoModelo::class,
    '/excluir-modelo' => ExcluirModelo::class,
    '/dar-saida' => RealizaSaidaModelo::class,
    '/usuarios' => ListarUsuarios::class,
    '/novo-usuario' => FormularioUsuario::class,
    '/salvar-usuario' => PersistenciaUsuario::class,
    '/excluir-usuario' => ExcluirUsuario::class,
    '/alterar-usuario' => FormularioEdicaoUsuario::class,
    '/alterar-permissoes' => FormularioPermissoes::class,
    '/salvar-permissoes' => PersistenciaPermissoes::class,
    '/configuracoes' => ListarConfiguracoesGerais::class,
    '/salvar-configuracoes' => SalvarConfiguracoes::class,
    '/funcoes' => ListarFuncoes::class,
    '/nova-funcao' => FormularioFuncao::class,
    '/salvar-funcao' => PersistirFuncao::class,
];
