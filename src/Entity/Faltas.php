<?php

namespace Dam\Atelier\Entity;

use Doctrine\ORM\Tools\Console\Command\SchemaTool\AbstractCommand;
use Doctrine\ORM\Mapping\{GeneratedValue, Id, Entity, Column, ManyToOne};

//Table(name="faltas")
#[Entity]
class Faltas implements \JsonSerializable
{
    #[Id, GeneratedValue(strategy: 'AUTO'), Column(unique: 'True')]
    private int $id;

    #[Column]
    #[ManyToOne(targetEntity: 'Faltas', inversedBy: 'Funcionario')]
    private int $id_funcionario;

    #[Column]
    private array $listaDeFaltas = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdFuncionario(): int
    {
        return $this->id_funcionario;
    }

    public function setIdFuncionario(int $id_funcionario): Faltas
    {
        $this->id_funcionario = $id_funcionario;
        return $this;
    }

    public function addFaltas($data_falta)
    {
        $this->listaDeFaltas[] .= $data_falta;
    }

    public function getListaDeFaltas()
    {
        return $this->listaDeFaltas;
    }

    public function countFaltas()
    {
        return count($this->listaDeFaltas);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'id_funcionario' => $this->id_funcionario,
            'faltas' => $this->listaDeFaltas,
            'num_faltas' => $this->countFaltas(),
        ];
    }
}
