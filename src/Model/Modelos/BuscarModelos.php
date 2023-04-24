<?php

namespace Dam\Atelier\Model\Modelos;

use Dam\Atelier\Model\FuncaoTrait;

class BuscarModelos
{
    use FuncaoTrait;

    public function busca($repositorio, $pesquisa)
    {
        $modelos = $this->buscar($repositorio, $pesquisa);
    }

}

