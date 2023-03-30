<?php

namespace Dam\Atelier\Model\Modelos;

use Dam\Atelier\Entity\Modelo;
use Doctrine\ORM\EntityManagerInterface;
use Dam\Atelier\Model\Modelos\Funcoes;
use Doctrine\ORM\EntityRepository;

class BuscarModelos
{
    use Funcoes;

    public function busca($repositorio, $pesquisa)
    {
        // chamando a função buscarModelos da trait
        $modelos = $this->buscarModelos($repositorio, $pesquisa);
    }

}

