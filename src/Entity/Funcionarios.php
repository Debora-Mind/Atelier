<?php

namespace Dam\Atelier\Entity;

use Doctrine\ORM\Tools\Console\Command\SchemaTool\AbstractCommand;
use Doctrine\ORM\Mapping\{GeneratedValue, Id, Entity, Column};
use Dam\Atelier\Entity\Faltas;

//Table(name="modelos")
#[Entity]
class Funcionarios implements \JsonSerializable
{
    #[Id, GeneratedValue(strategy: 'AUTO'), Column]
    private int $id;

    #[Column]
    private string $nome;

    #[Column]
    private string $cpf;

    #[Column]
    private string $data_nascimento;

    #[Column(nullable: 'true')]
    private string $matricula;

    #[Column]
    private string $id_funcao;

    #[Column(nullable: 'true')]
    private string $valor_hora;

    #[Column]
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

    public function setNome(string $nome): Funcionarios
    {
        $this->nome = $nome;
        return $this;
    }

    public function addFalta($data_falta)
    {
        $this->id_faltas->addFaltas($data_falta);
    }

    public function countFaltas()
    {
        return $this->id_faltas->countFaltas();
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'modelo' => $this->nome,
        ];
    }
}
