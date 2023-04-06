<?php

namespace Dam\Atelier\Helper;

use Nyholm\Psr7\Response;

trait VerificarPermissoesTrait
{
    use FlashMessageTrait;

    function verificarPermissoes($permissoesNecessarias)
    {
        $faltandoPermissoes = array_diff($permissoesNecessarias, $_SESSION['permissoes']);

        if (!empty($faltandoPermissoes)) {
            $this->defineMensagem(
                'danger',
                'Usuário sem permissão para prosseguir'
            );
            $redirecionar = $_SERVER['HTTP_REFERER'] ?? '/';
            header('Location: ' . $redirecionar);
            die();
        }
    }
}
