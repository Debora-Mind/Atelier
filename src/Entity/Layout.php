<?php

namespace Dam\Atelier\Entity;

use Doctrine\ORM\Mapping\{Entity, OneToOne, Table, Id, Column, GeneratedValue};

#[Entity]
#[Table(name: "layout")]
class Layout implements \JsonSerializable
{
    #[Id]
    #[GeneratedValue(strategy: 'AUTO')]
    #[Column(unique: true)]
    private int $id;

    #[Column(type: 'date')]
    private \DateTime $data;

    #[OneToOne(mappedBy: 'layout', targetEntity: Relacao::class)]
    private Relacao $relacao;

    public function __construct()
    {
        $this->relacao = new Relacao();
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

    public function getRelacao(): Relacao
    {
        return $this->relacao;
    }

    public function addRelacao($relacao)
    {
        $this->relacao->addRelacao($relacao);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'data' => $this->getData(),
            'relacao' => $this->relacao,
        ];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'data' => $this->getData(),
            'relacao' => $this->relacao->toArray(),
        ];
    }
}
