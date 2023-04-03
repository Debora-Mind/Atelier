<?php

namespace Dam\Atelier\Model\Modelos;

use Dam\Atelier\Entity\Modelo;
use Doctrine\ORM\EntityManagerInterface;

trait Funcoes
{
    public function buscarModelos($modelos, $busca)
    {
        $modelosFiltrados = $modelos->filter(function($modelo) use ($busca) {
            return $modelo->getCodBarras() == $busca || strpos($modelo->getModelo(), $busca) !== false;
        });

        return $modelosFiltrados;
    }
}
