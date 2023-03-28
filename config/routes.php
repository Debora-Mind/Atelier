<?php

use Dam\Atelier\Controller\{Exclusao,
    FormularioEdicao,
    FormularioLogin,
    FormularioModelo,
    IndexController,
    ListarModelos,
    Persistencia,
    RealizaLogin};

return [
    '/' => IndexController::class,
    '/login' => FormularioLogin::class,
    '/realiza-login' => RealizaLogin::class,
    '/modelos' => ListarModelos::class,
    '/novo-modelo' => FormularioModelo::class,
    '/salvar-modelo' => Persistencia::class,
    '/alterar-modelo' => FormularioEdicao::class,
    '/excluir-modelo' => Exclusao::class,
];
