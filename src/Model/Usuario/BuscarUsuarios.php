<?php

namespace Dam\Atelier\Model\Usuario;

use Dam\Atelier\Model\FuncaoTrait;

class BuscarUsuarios
{
    use FuncaoTrait;

    public function busca($repositorio, $pesquisa)
    {
        $usuarios = $this->buscarUsuarios($repositorio, $pesquisa);
    }

}

