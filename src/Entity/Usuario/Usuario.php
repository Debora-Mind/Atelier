<?php

namespace Dam\Atelier\Entity\Usuario;

use Dam\Atelier\Entity\Empresa\Empresa;
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

    #[Column(type: 'json', nullable: true)]
    private $permissoes = [];

    #[ManyToOne(targetEntity: Empresa::class)]
    #[JoinColumn(name: 'empresa_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Empresa $empresa;

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

    public function getPermissoes(): array
    {
        return $this->permissoes;
    }

    public function setPermissoes(array $permissoes): Usuario
    {
        $this->permissoes = $permissoes;
        return $this;
    }

    public function addPermissao($permissao)
    {
        $this->permissoes [] = $permissao;
    }

    public function removePermissoes()
    {
        $this->permissoes = [];
    }

    public function getEmpresa(): Empresa
    {
        return $this->empresa;
    }

    public function setEmpresa(Empresa $empresa): Usuario
    {
        $this->empresa = $empresa;
        return $this;
    }

}
