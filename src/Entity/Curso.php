<?php

namespace Dam\Atelier\Entity;

use Doctrine\ORM\Mapping\{GeneratedValue, Id, Entity, Column};

//Table(name="cursos")
#[Entity]
class Curso implements \JsonSerializable
{
    #[Id, GeneratedValue(strategy: 'AUTO'), Column]
    private int $id;

    #[Column]
    private string $descricao;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'descricao' => $this->descricao
        ];
    }
}
