<?php

namespace Dam\Atelier\Model;

use Dam\Atelier\Entity\Funcionario\Funcao;
use Dam\Atelier\Entity\Funcionario\Funcionario;
use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Entity\Modelo\Talao\Talao;
use Dam\Atelier\Entity\Usuario\Usuario;

trait Funcoes
{
    public function buscar($objeto, $busca, $tipo)
    {
        if ($tipo == 'talao'){
            $objetoFiltrado = array_filter($objeto, function ($objeto) use ($busca) {
                if (!($objeto instanceof Talao)) {
                    return false;
                }
                return $objeto->getCodBarras() == $busca || strpos($objeto->getModelo()->getModelo(), $busca) !== false;
            });
        } elseif ($tipo == 'modelo') {
            $objetoFiltrado = array_filter($objeto, function ($objeto) use ($busca) {
                if (!($objeto instanceof Modelo)) {
                    return false;
                }
                return strpos($objeto->getModelo(), $busca) !== false;
            });
        }

        return $objetoFiltrado;
    }

    public function buscarUsuarios(array $usuarios, $busca)
    {
        $usuariosFiltrados = array_filter($usuarios, function($usuario) use ($busca) {
            if (!($usuario instanceof Usuario)) {
                return false;
            }
            return strpos($usuario->getUsuario(), $busca) !== false;
        });

        return $usuariosFiltrados;
    }

    public function buscarFuncoes(array $funcoes, $busca)
    {
        $funcoesFiltradas = array_filter($funcoes, function($funcao) use ($busca) {
            if (!($funcao instanceof Funcao)) {
                return false;
            }
            return strpos($funcao->getDescricao(), $busca) !== false;
        });

        return $funcoesFiltradas;
    }

    public function buscarFuncionarios(array $funcionarios, $busca)
    {
        $funcionariosFiltrados = array_filter($funcionarios, function($funcionario) use ($busca) {
            if (!($funcionario instanceof Funcionario)) {
                return false;
            }
            return strpos($funcionario->getNome(), $busca) !== false;
        });

        return $funcionariosFiltrados;
    }

}
