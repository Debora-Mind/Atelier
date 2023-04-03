<?php

namespace Dam\Atelier\Model\Modelos;

use ArrayObject;
use Dam\Atelier\Entity\Modelo;
use Doctrine\ORM\EntityManagerInterface;

trait Funcoes
{
    public function buscarModelos(array $modelos, $busca)
    {
        $modelosFiltrados = array_filter($modelos, function($modelo) use ($busca) {
            if (!($modelo instanceof Modelo)) {
                return false;
            }
            return $modelo->getCodBarras() == $busca || strpos($modelo->getModelo(), $busca) !== false;
        });

        return $modelosFiltrados;
    }

}
