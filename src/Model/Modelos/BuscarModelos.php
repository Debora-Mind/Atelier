<?php

namespace Dam\Atelier\Model\Modelos;

use Dam\Atelier\Model\Funcoes;

class BuscarModelos
{
    use Funcoes;

    public function busca($repositorio, $pesquisa)
    {
        $modelos = $this->buscar($repositorio, $pesquisa);
    }

}

