<?php

namespace Dam\Atelier\Model\Usuario;

use Dam\Atelier\Model\Funcoes;

class BuscarUsuarios
{
    use Funcoes;

    public function busca($repositorio, $pesquisa)
    {
        $usuarios = $this->buscarUsuarios($repositorio, $pesquisa);
    }

}

