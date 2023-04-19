<?php

namespace Dam\Atelier\Entity\Empresa;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "empresa")]
class Empresa
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "text")]
    private $descricao;

    #[ORM\Column(type: "boolean")]
    private $ativo = false;

    #[ORM\Column(type: "text", nullable: true)]
    private $tema = 'Claro';

    #[ORM\Column(type: "blob", nullable: true)]
    private $logo;

    #[ORM\Column(type: "json", nullable: true)]
    private $configuracoes;

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

    public function getTema(): string
    {
        return $this->tema;
    }

    public function setTema(string $tema): Empresa
    {
        $this->tema = $tema;
        return $this;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    public function getConfiguracoes()
    {
        return $this->configuracoes;
    }

    public function setConfiguracoes(int $configuracao, ?bool $ativo, ?int $numero)
    {
        if ($this->configuracoes === null) {
            $this->configuracoes = [$configuracao => [$ativo ?? false, $numero ?? 0]];
        } elseif (array_key_exists($configuracao, $this->configuracoes)) {
            $this->configuracoes[$configuracao] = [$ativo, $numero];
        } else {
            $this->configuracoes += [$configuracao => [$ativo, $numero]];
        }
        return $this;
    }

}
