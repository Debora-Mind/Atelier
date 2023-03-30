<?php

namespace Dam\Atelier\Entity;

use Doctrine\ORM\Mapping\{GeneratedValue, Id, Entity, Column, OneToOne, Table};

#[Entity]
#[Table(name: "relacao")]
class Relacao implements \JsonSerializable
{
    #[Id, GeneratedValue(strategy: 'AUTO'), Column(unique: true)]
    private int $id;

    #[Column]
    private array $relacoes;

    #[Column]
    #[OneToOne(mappedBy: Layout::class, inversedBy: Relacao::class)]
    private Layout $id_layout;

    public function __construct()
    {
        $this->relacoes = [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getData(): \DateTimeImmutable
    {
        return $this->data;
    }

    public function setData(\DateTimeImmutable $data): Relacao
    {
        $this->data = $data;
        return $this;
    }

    public function addRelacao(string $relacao)
    {
        $this->relacoes[] .= $relacao;
    }

    public function getRelacoes(): array
    {
        return $this->relacoes;
    }

    public function getIdLayout(): Layout
    {
        return $this->id_layout;
    }

    public function setIdLayout(Layout $id_layout): Relacao
    {
        $this->id_layout = $id_layout;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'relacoes' => $this->relacoes,
            'id_layout' => $this->id_layout,
        ];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'relacoes' => $this->relacoes,
            'id_layout' => $this->id_layout->getId(),
        ];
    }
}
