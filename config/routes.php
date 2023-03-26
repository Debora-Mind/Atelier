<?php

use Dam\Atelier\Controller\{IndexController, Login, RealizaLogin};

return [
    '/' => IndexController::class,
    '/login' => Login::class,
    '/realiza-Login' => RealizaLogin::class,
];
