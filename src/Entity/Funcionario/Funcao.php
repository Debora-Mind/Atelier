<?php

namespace Dam\Atelier\Entity\Funcionario;

use Doctrine\ORM\Mapping\{Column, Entity, GeneratedValue, Id, Table};

#[Entity]
#[Table(name: "funcao")]
class Funcao implements \JsonSerializable
{
    #[Id, GeneratedValue(strategy: 'AUTO'), Column(unique: 'True')]
    private int $id;

    #[Column]
    private string $descricao;

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): Funcao
    {
        $this->descricao = $descricao;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'descricao' => $this->descricao,
        ];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'descricao' => $this->descricao,
        ];
    }
}
