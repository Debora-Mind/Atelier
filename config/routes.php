<?php

use Dam\Atelier\Controller\{ExcluirUsuario,
    Exclusao,
    FormularioEdicao,
    FormularioEdicaoUsuario,
    FormularioLogin,
    FormularioModelo,
    FormularioUsuario,
    IndexController,
    ListarModelos,
    ListarUsuarios,
    Persistencia,
    PersistenciaUsuario,
    RealizaLogin,
    RealizaSaida};

return [
    '/' => IndexController::class,
    '/login' => FormularioLogin::class,
    '/realiza-login' => RealizaLogin::class,
    '/modelos' => ListarModelos::class,
    '/novo-modelo' => FormularioModelo::class,
    '/salvar-modelo' => Persistencia::class,
    '/alterar-modelo' => FormularioEdicao::class,
    '/excluir-modelo' => Exclusao::class,
    '/dar-saida' => RealizaSaida::class,
    '/usuarios' => ListarUsuarios::class,
    '/novo-usuario' => FormularioUsuario::class,
    '/salvar-usuario' => PersistenciaUsuario::class,
    '/excluir-usuario' => ExcluirUsuario::class,
    '/alterar-usuario' => FormularioEdicaoUsuario::class,
];
