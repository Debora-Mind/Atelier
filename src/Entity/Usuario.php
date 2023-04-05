<?php

namespace Dam\Atelier\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\{GeneratedValue, Id, Entity, Column, JoinColumn, ManyToOne, Table};

#[Entity]
#[Table(name: "usuario")]
class Usuario
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Id, GeneratedValue(strategy: 'AUTO'), Column(unique: 'True')]
    private int $id;

    #[Column]
    private $usuario;

    #[Column]
    private $senha;

    #[ManyToOne(targetEntity: 'Funcionario')]
    #[JoinColumn(name: 'funcionario', referencedColumnName: 'id')]
    private ? Funcionario $funcionario;

    #[Column]
    private $permissoes = [];

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

        $funcionarioId = (int) $this->funcionario;

        if (!$funcionarioId) {
            throw new \InvalidArgumentException('Identificador de funcionário inválido');
        }

        $funcionarios = $this->entityManager->getRepository(Funcionario::class);
        $funcionario = $funcionarios->find($funcionarioId);

        return $funcionario;
    }

    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;
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
