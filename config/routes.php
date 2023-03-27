<?php

use Dam\Atelier\Controller\{
    FormularioLogin,
    FormularioModelo,
    IndexController,
    ListarModelos,
    RealizaLogin};

return [
    '/' => IndexController::class,
    '/login' => FormularioLogin::class,
    '/realiza-login' => RealizaLogin::class,
    '/modelos' => ListarModelos::class,
    '/novo-modelo' => FormularioModelo::class,
];
