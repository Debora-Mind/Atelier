<?php

namespace Dam\Atelier\Entity\Modelo\Talao;

use Doctrine\ORM\Mapping\{Column, Entity, GeneratedValue, Id, JoinColumn, ManyToOne, Table};
use Dam\Atelier\Entity\Empresa\Empresa;
use Dam\Atelier\Entity\Modelo\Modelo;

#[Entity]
#[Table(name: "talao")]
class Talao implements \JsonSerializable
{
    #[Id, GeneratedValue(strategy: 'AUTO'), Column(unique: 'True')]
    private int $id;

    #[ManyToOne(targetEntity: Modelo::class)]
    #[JoinColumn(name: 'modelo_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Modelo $modelo;

    #[Column(type: 'string')]
    private string $producao;

    #[Column(type: 'integer')]
    private string $sublote;

    #[Column(type: 'integer')]
    private string $quantidade;

    #[Column(type: 'integer')]
    private string $semana;

    #[Column(type: 'string')]
    private string $cod_barras;

    #[Column(type: 'date')]
    private \DateTime $data_entrada;

    #[Column(nullable: true)]
    private ? string $data_saida;

    #[Column(type: 'string')]
    private string $notaFiscal;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getModelo(): Modelo
    {
        return $this->modelo;
    }

    public function setModelo(Modelo $modelo): self
    {
        $this->modelo = $modelo;
        return $this;
    }

    public function getProducao(): string|null
    {
        if ($this->producao === '0') {
            return null;
        }
        return $this->producao;
    }

    public function setProducao(string $producao): self
    {
        $this->producao = $producao;
        return $this;
    }

    public function getSublote(): string|null
    {
        if ($this->sublote === '0') {
            return null;
        }
        return $this->sublote;
    }

    public function setSublote(string $sublote): self
    {
        $this->sublote = $sublote;
        return $this;
    }

    public function getQuantidade(): string|null
    {
        if ($this->quantidade === '0') {
            return null;
        }
        return $this->quantidade;
    }

    public function setQuantidade(string $quantidade): self
    {
        $this->quantidade = $quantidade;
        return $this;
    }

    public function getSemana(): string|null
    {
        if ($this->semana === '0') {
            return null;
        }
        return $this->semana;
    }

    public function setSemana(string $semana): self
    {
        $this->semana = $semana;
        return $this;
    }

    public function getCodBarras(): string
    {
        return $this->cod_barras;
    }

    public function setCodBarras(string $cod_barras): self
    {
        $this->cod_barras = $cod_barras;
        return $this;
    }

    public function setDataEntrada(\DateTime $data_entrada): self
    {
        $this->data_entrada = $data_entrada;
        return $this;
    }

    public function getDataEntrada(): \DateTime
    {
        return $this->data_entrada;
    }

    public function getDataSaida(bool $formatado = false): mixed
    {
        if ($formatado === true) {
            $timestamp = strtotime(str_replace('/', '-', $this->data_saida));
            $data_formatada = date('Y-m-d\TH:i:s', $timestamp);
            return $data_formatada;
        }
        return $this->data_saida;
    }

    public function setDataSaida(): self
    {
        date_default_timezone_set('America/Sao_Paulo');
        $data = new \DateTime();
        $this->data_saida = $data->format('d/m/Y H:i');
        return $this;
    }

    public function getNotaFiscal(): string
    {
        return $this->notaFiscal;
    }

    public function setNotaFiscal(string $notaFiscal): self
    {
        $this->notaFiscal = $notaFiscal;
        return $this;
    }

    public function cor()
    {
        if (isset($this->data_saida)) {
            return 'green';
        }
        return 'black';
    }

    public function button()
    {
        if (isset($this->data_saida)) {
            return 'bi bi-check-square';
        }
        return 'bi bi-square';
    }

    public function disabled()
    {
        if (isset($this->data_saida)) {
            return 'disabled';
        }
        return '';
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'modelo' => $this->modelo,
            'producao' => $this->producao,
            'sublote' => $this->sublote,
            'quantidade' => $this->quantidade,
            'cod_barras' => $this->cod_barras,
            'data_entrada' => $this->data_entrada->format('d/m/y H:i'),
            'data_saida' => $this->data_saida,
        ];
    }
}
