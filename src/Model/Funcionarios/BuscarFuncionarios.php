<?php

namespace Dam\Atelier\Model\Funcionarios;

use Dam\Atelier\Model\FuncaoTrait;

class BuscarFuncionarios
{
    use FuncaoTrait;

    public function busca($repositorio, $pesquisa)
    {
        return $this->buscarFuncionarios($repositorio, $pesquisa);
    }

}