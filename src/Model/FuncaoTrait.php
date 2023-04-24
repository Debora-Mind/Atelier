<?php

namespace Dam\Atelier\Model;

use Dam\Atelier\Entity\Funcionario\Funcao;
use Dam\Atelier\Entity\Funcionario\Funcionario;
use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Entity\Modelo\Talao\Talao;
use Dam\Atelier\Entity\Usuario\Usuario;

trait FuncaoTrait
{
    public function buscar($objeto, $busca, $tipo)
    {
        switch($tipo) {
            case 'talao':
                $objetoFiltrado = array_filter($objeto, function ($objeto) use ($busca) {
                    if (!($objeto instanceof Talao)) {
                        return false;
                    }
                    return $objeto->getCodBarras() == $busca || strpos($objeto->getModelo()->getModelo(), $busca) !== false;
                });
                break;
            case 'modelo':
                $objetoFiltrado = array_filter($objeto, function ($objeto) use ($busca) {
                    if (!($objeto instanceof Modelo)) {
                        return false;
                    }
                    return strpos($objeto->getModelo(), $busca) !== false;
                });
                break;
            case 'funcao':
                $objetoFiltrado = array_filter($objeto, function ($objeto) use ($busca) {
                    if (!($objeto instanceof FuncaoTrait)) {
                        return false;
                    }
                    return strpos($objeto->getDescricao(), $busca) !== false;
                });
                break;
            case 'usuario':
                $objetoFiltrado = array_filter($objeto, function ($objeto) use ($busca) {
                    if (!($objeto instanceof Usuario)) {
                        return false;
                    }
                    return strpos($objeto->getUsuario(), $busca) !== false;
                });
                break;
            case 'funcionario':
                $objetoFiltrado = array_filter($objeto, function ($objeto) use ($busca) {
                    if (!($objeto instanceof Funcionario)) {
                        return false;
                    }
                    return strpos($objeto->getNome(), $busca) !== false;
                });
                break;
        }

        return $objetoFiltrado;
    }

    public function exibirImagem($imagem)
    {
        return stream_get_contents($imagem);

    }
}
