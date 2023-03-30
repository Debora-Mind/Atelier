<?php

namespace Dam\Atelier\Entity;

use Doctrine\ORM\Mapping\{Entity, ManyToOne, Table, Id, Column, GeneratedValue};

#[Entity]
#[Table(name: "faltas")]
class Faltas implements \JsonSerializable
{
    #[Id]
    #[GeneratedValue(strategy: 'AUTO')]
    #[Column(unique: true)]
    private int $id;

    #[Column]
    #[ManyToOne(targetEntity: Funcionario::class, inversedBy: 'faltas')]
    private Funcionario $funcionario;

    #[Column(type: 'json')]
    private array $listaDeFaltas = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function getFuncionario(): Funcionario
    {
        return $this->funcionario;
    }

    public function setFuncionario(Funcionario $funcionario): self
    {
        $this->funcionario = $funcionario;

        return $this;
    }

    public function addFalta(string $data_falta): void
    {
        $this->listaDeFaltas[] = $data_falta;
    }

    public function getListaDeFaltas(): array
    {
        return $this->listaDeFaltas;
    }

    public function countFaltas(): int
    {
        return count($this->listaDeFaltas);
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'id_funcionario' => $this->funcionario->getId(),
            'faltas' => $this->listaDeFaltas,
            'num_faltas' => $this->countFaltas(),
        ];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'id_funcionario' => $this->funcionario,
            'faltas' => $this->listaDeFaltas,
            'num_faltas' => $this->countFaltas(),
        ];
    }

}
