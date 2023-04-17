<?php

namespace Dam\Atelier\Entity\Configuracao;

use Dam\Atelier\Entity\Empresa\Empresa;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity]
#[ORM\Table(name: "configuracoes")]
class ConfiguracaoGeral
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "text")]
    private $descricao;

    #[ORM\Column(type: "boolean")]
    private $ativo = false;

    #[ORM\Column(type: "integer", nullable: true)]
    private $numero = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAtivo(): bool
    {
        return $this->ativo;
    }

    public function setAtivo(string $ativo): self
    {
        $this->ativo = $ativo;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;
        return $this;
    }
}
