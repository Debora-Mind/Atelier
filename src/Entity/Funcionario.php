<?php

namespace Dam\Atelier\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\{Entity, JoinColumn, ManyToOne, OneToMany, OneToOne, Table, Id, Column, GeneratedValue};

#[Entity]
#[Table(name: "funcionario")]
class Funcionario implements \JsonSerializable
{
    #[Id, GeneratedValue(strategy: 'AUTO'), Column(unique: true)]
    private int $id;

    #[Column]
    private string $nome;

    #[Column]
    private string $cpf;

    #[Column(type: 'date')]
    private \DateTime $data_nascimento;

    #[Column(nullable: true)]
    private string $matricula;

    #[ManyToOne(targetEntity: Funcao::class)]
    #[JoinColumn(name: 'funcao_id', referencedColumnName: 'id')]
    private Funcao $funcao;

    #[Column(type: 'float', nullable: true)]
    private float $valor_hora;

    #[OneToOne(mappedBy: 'funcionario', targetEntity: Faltas::class)]
    private Faltas $faltas;

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): Funcionario
    {
        $this->nome = $nome;
        return $this;
    }

    public function addFalta(Faltas $falta): void
    {
        $this->faltas->addFalta();
    }

    public function countFaltas(): int
    {
        return $this->faltas->countFaltas();
    }

    public function getFaltas(): array
    {
        return $this->faltas->toArray();
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): Funcionario
    {
        $this->cpf = $cpf;
        return $this;
    }

    public function getDataNascimento(): \DateTime
    {
        return $this->data_nascimento;
    }

    public function setDataNascimento(\DateTime $data_nascimento): self
    {
        $this->data_nascimento = $data_nascimento;
        return $this;
    }

    public function getMatricula(): ?string
    {
        return $this->matricula;
    }

    public function setMatricula(?string $matricula): self
    {
        $this->matricula = $matricula;
        return $this;
    }

    public function getFuncao(): Funcao
    {
        return $this->funcao;
    }

    public function setFuncao(Funcao $funcao): self
    {
        $this->funcao = $funcao;
        return $this;
    }

    public function getValorHora(): ?float
    {
        return $this->valor_hora;
    }

    public function setValorHora(?float $valor_hora): self
    {
        $this->valor_hora = $valor_hora;
        return $this;
    }

    public function jsonSerialize() : mixed
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'data_nascimento' => $this->data_nascimento->format('d/m/y'),
            'matricula' => $this->matricula,
            'funcao' => $this->funcao->toArray(),
            'valor_hora' => $this->valor_hora,
            'faltas' => $this->faltas->toArray(),
        ];
    }

    public function toArray(): array
    {
        $faltas = [];
        foreach ($this->faltas as $falta) {
            $faltas[] = $falta->getDataFalta()->format('d/m/Y');
        }

        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'data_nascimento' => $this->data_nascimento->format('d/m/Y'),
            'matricula' => $this->matricula,
            'funcao' => $this->funcao->getDescricao(),
            'valor_hora' => $this->valor_hora,
            'faltas' => $faltas,
        ];
    }
}
