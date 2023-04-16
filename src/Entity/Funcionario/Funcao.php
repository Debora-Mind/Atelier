<?php

namespace Dam\Atelier\Entity\Funcionario;

use Doctrine\ORM\Mapping\{Column, Entity, GeneratedValue, Id, JoinColumn, ManyToOne, Table};
use Dam\Atelier\Entity\Empresa\Empresa;

#[Entity]
#[Table(name: "funcao")]
class Funcao implements \JsonSerializable
{
    #[Id, GeneratedValue(strategy: 'AUTO'), Column(unique: 'True')]
    private int $id;

    #[Column]
    private string $descricao;

    #[ManyToOne(targetEntity: Empresa::class)]
    #[JoinColumn(name: 'empresa_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Empresa $empresa;

    public function setId($id): Funcao
    {
        $this->id = $id;
        return $this;
    }

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

    public function getEmpresa(): Empresa
    {
        return $this->empresa;
    }

    public function setEmpresa(Empresa $empresa): Funcao
    {
        $this->empresa = $empresa;
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
