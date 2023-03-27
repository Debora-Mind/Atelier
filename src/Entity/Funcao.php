<?php

namespace Dam\Atelier\Entity;

use Doctrine\ORM\Tools\Console\Command\SchemaTool\AbstractCommand;
use Doctrine\ORM\Mapping\{GeneratedValue, Id, Entity, Column, ManyToOne};

//Table(name="funcao")
#[Entity]
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

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'modelo' => $this->descricao,
        ];
    }
}
