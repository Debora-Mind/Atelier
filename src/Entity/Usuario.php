<?php

namespace Dam\Atelier\Entity;

use Doctrine\ORM\Mapping\{GeneratedValue, Id, Entity, Column};

//@Table(name="usuario")
#[Entity]
class Usuario
{

    #[Id, GeneratedValue(strategy: 'AUTO'), Column(unique: 'True')]
    private int $id;

    #[Column]
    private $usuario;

    #[Column]
    private $senha;

    #[Column(nullable: 'True')]
    private ? Funcionario $id_funcionario;

    #[Column]
    private $permissoes = [];

    public function getId(): int
    {
        return $this->id;
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

    public function getIdFuncionario()
    {
        return $this->id_funcionario;
    }

    public function setIdFuncionario($id_funcionario)
    {
        $this->id_funcionario = $id_funcionario;
        return $this;
    }

    public function getPermissoes(): array
    {
        return $this->permissoes;
    }

    public function setPermissoes(array $permissoes): Usuario
    {
        $this->permissoes = $permissoes;
        return $this;
    }

    public function senhaEstaCorreta(string $senhaPura): bool
    {
        return password_verify($senhaPura, $this->senha);
    }
}
