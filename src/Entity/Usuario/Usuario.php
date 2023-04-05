<?php

namespace Dam\Atelier\Entity\Usuario;

use Dam\Atelier\Entity\Funcionario\Funcionario;
use Doctrine\ORM\Mapping\{Column, Entity, GeneratedValue, Id, JoinColumn, ManyToOne, Table};

#[Entity]
#[Table(name: "usuario")]
class Usuario
{
    #[Id, GeneratedValue(strategy: 'AUTO'), Column(unique: 'True')]
    private int $id;

    #[Column]
    private $usuario;

    #[Column]
    private $senha;

    #[ManyToOne(targetEntity: Funcionario::class)]
    #[JoinColumn(name: 'funcionario', referencedColumnName: 'id')]
    private ? Funcionario $funcionario;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
        return $this;
    }

    public function getFuncionario()
    {
        if (!$this->funcionario) {
            return null;
        }
        return $this->funcionario;
    }

    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;
        return $this;
    }

    public function senhaEstaCorreta(string $senhaPura): bool
    {
        return password_verify($senhaPura, $this->senha);
    }
}
