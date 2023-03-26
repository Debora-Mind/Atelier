<?php

namespace Dam\Atelier\Entity;

use Doctrine\ORM\Tools\Console\Command\SchemaTool\AbstractCommand;
use Doctrine\ORM\Mapping\{GeneratedValue, Id, Entity, Column};

//Table(name="modelos")
#[Entity]
class Faltas implements \JsonSerializable
{
    #[Id, GeneratedValue(strategy: 'AUTO'), Column]
    private int $id;

    #[Column]
    private int $id_funcionario;

    #[Column]
    private array $faltas = [];

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
        $this->faltas[] .= $data_falta;
    }

    public function getFaltas()
    {
        return $this->faltas;
    }

    public function countFaltas()
    {
        return count($this->faltas);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'id_funcionario' => $this->id_funcionario,
            'faltas' => $this->faltas,
            'num_faltas' => $this->countFaltas(),
        ];
    }
}
