<?php

namespace Dam\Atelier\Entity;

use Doctrine\ORM\Tools\Console\Command\SchemaTool\AbstractCommand;
use Doctrine\ORM\Mapping\{GeneratedValue, Id, Entity, Column, OneToMany, OneToOne};
use Dam\Atelier\Entity\Faltas;

//Table(name="funcionario")
#[Entity]
class Funcionario implements \JsonSerializable
{
    #[Id, GeneratedValue(strategy: 'AUTO'), Column(unique: 'True')]
    private int $id;

    #[Column]
    private string $nome;

    #[Column]
    private string $cpf;

    #[Column(type: 'date')]
    private \DateTime $data_nascimento;

    #[Column(nullable: 'true')]
    private string $matricula;

    #[Column]
    #[OneToMany(mappedBy: 'Funcionario', targetEntity: 'Funcao')]
    private Funcao $id_funcao;

    #[Column(type: 'float', nullable: 'true')]
    private float $valor_hora;

    #[Column]
    #[OneToMany(mappedBy: 'Funcionario', targetEntity: 'Faltas')]
    private Faltas $id_faltas;

    public function __construct()
    {
        $this->id_faltas = new Faltas ();
    }

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

    public function addFalta(\DateTime $data_falta)
    {
        $this->id_faltas->addFaltas($data_falta);
    }

    public function countFaltas()
    {
        return $this->id_faltas->countFaltas();
    }

    public function getFaltas(): array
    {
        return $this->id_faltas->getListaDeFaltas();
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

    public function getDataNascimento(): string
    {
        return $this->data_nascimento->format('d/m/y');
    }

    public function setDataNascimento(\DateTime $data_nascimento): Funcionario
    {
        $this->data_nascimento = $data_nascimento;
        return $this;
    }

    public function getMatricula(): string
    {
        return $this->matricula;
    }

    public function setMatricula(string $matricula): Funcionario
    {
        $this->matricula = $matricula;
        return $this;
    }

    public function getIdFuncao(): Funcao
    {
        return $this->id_funcao;
    }

    public function setIdFuncao(Funcao $id_funcao): Funcionario
    {
        $this->id_funcao = $id_funcao;
        return $this;
    }

    public function getValorHora(): float
    {
        return $this->valor_hora;
    }

    public function setValorHora(string $valor_hora): Funcionario
    {
        $this->valor_hora = $valor_hora;
        return $this;
    }

    public function getIdFaltas(): \Dam\Atelier\Entity\Faltas
    {
        return $this->id_faltas;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'data_nascimento' => $this->data_nascimento->format('d/m/y'),
            'matricula' => $this->matricula,
            'id_funcao' => $this->id_funcao,
            'valor_hora' => $this->valor_hora,
            'id_faltas' => $this->id_faltas,
        ];
    }

}
