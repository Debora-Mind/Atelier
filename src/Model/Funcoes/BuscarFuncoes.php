<?php

namespace Dam\Atelier\Model\Funcoes;

use Dam\Atelier\Model\FuncaoTrait;

class BuscarFuncoes
{
    use FuncaoTrait;

    public function busca($repositorio, $pesquisa)
    {
        $funcoes = $this->buscarFuncoes($repositorio, $pesquisa);
    }

}