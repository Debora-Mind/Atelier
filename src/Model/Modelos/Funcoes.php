<?php

namespace Dam\Atelier\Model\Modelos;

use Dam\Atelier\Entity\Modelo;
use Doctrine\ORM\EntityManagerInterface;

trait Funcoes
{
    public function buscarModelos($repositorio, $busca)
    {
        $modelos = $repositorio->createQueryBuilder('m')
            ->where('m.cod_barras = :buscaExata')
            ->orWhere('m.modelo LIKE :buscaMeio')
            ->setParameter('buscaExata', $busca)
            ->setParameter('buscaMeio', '%'.$busca.'%')
            ->getQuery()
            ->getResult();

        return $modelos;
    }
}
