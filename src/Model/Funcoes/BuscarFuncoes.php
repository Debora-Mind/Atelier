<?php

namespace Dam\Atelier\Model\Funcoes;

use Dam\Atelier\Model\Funcoes;

class BuscarFuncoes
{
    use Funcoes;

    public function busca($repositorio, $pesquisa)
    {
        $funcoes = $this->buscarFuncoes($repositorio, $pesquisa);
    }

}