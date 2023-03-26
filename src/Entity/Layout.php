<?php

namespace Dam\Atelier\Entity;

use Doctrine\ORM\Tools\Console\Command\SchemaTool\AbstractCommand;
use Doctrine\ORM\Mapping\{GeneratedValue, Id, Entity, Column};
use mysql_xdevapi\DatabaseObject;

//Table(name="modelos")
#[Entity]
class Layout implements \JsonSerializable
{
    #[Id, GeneratedValue(strategy: 'AUTO'), Column]
    private int $id;

    #[Column]
    private \DateTimeImmutable $data;

    #[Column]
    private Relacao $id_relacao;

    public function __construct()
    {

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getData(): \DateTimeImmutable
    {
        return $this->data;
    }

    public function setData(\DateTimeImmutable $data): Layout
    {
        $this->data = $data;
        return $this;
    }

    public function getIdRelacao(): Relacao
    {
        return $this->id_relacao;
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
