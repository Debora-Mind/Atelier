<?php

namespace Dam\Atelier\Model\Modelos;

use Dam\Atelier\Model\FuncaoTrait;

class BuscarModelos
{
    use FuncaoTrait;

    public function busca($repositorio, $pesquisa, $tipo)
    {
        $modelos = $this->buscar($repositorio, $pesquisa, $tipo);
    }

}

