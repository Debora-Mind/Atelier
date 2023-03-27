<?php

namespace Dam\Atelier\Entity;

use Doctrine\ORM\Tools\Console\Command\SchemaTool\AbstractCommand;
use Doctrine\ORM\Mapping\{GeneratedValue, Id, Entity, Column, OneToOne};

//Table(name="layout")
#[Entity]
class Layout implements \JsonSerializable
{
    #[Id, GeneratedValue(strategy: 'AUTO'), Column(unique: 'True')]
    private int $id;

    #[Column(type: 'date')]
    private \DateTime $data;

    #[Column]
    #[OneToOne(mappedBy: 'Layout', targetEntity: 'Relacao')]
    private Relacao $id_relacao;

    public function __construct()
    {
        $this->id_relacao = new Relacao();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getData(): string
    {
        return $this->data->format('d/m/y H:i');
    }

    public function setData(\DateTime $data): Layout
    {
        $this->data = $data;
        return $this;
    }

    public function getIdRelacao(): Relacao
    {
        return $this->id_relacao;
    }

    public function addRelacao($relacao)
    {
        $this->id_relacao->addRelacao($relacao);
    }


    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'data' => $this->data->format('d/m/y H:i'),
            'id_relacao' => $this->id_relacao,
        ];
    }
}
