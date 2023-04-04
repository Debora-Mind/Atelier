<?php

namespace Dam\Atelier\Model\Funcionarios;

use Dam\Atelier\Model\Funcoes;

class BuscarFuncionarios
{
    use Funcoes;

    public function busca($repositorio, $pesquisa)
    {
        $funcionarios = $this->buscarFuncionarios($repositorio, $pesquisa);
    }

}