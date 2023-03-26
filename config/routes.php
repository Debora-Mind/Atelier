<?php

use Dam\Atelier\Controller\{FormularioLogin, IndexController, RealizaLogin};
return [
    '/' => IndexController::class,
    '/login' => FormularioLogin::class,
    '/realiza-login' => RealizaLogin::class,
];
