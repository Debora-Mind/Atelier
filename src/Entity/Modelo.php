<?php

namespace Dam\Atelier\Entity;

use Doctrine\ORM\Tools\Console\Command\SchemaTool\AbstractCommand;
use Doctrine\ORM\Mapping\{GeneratedValue, Id, Entity, Column};

//Table(name="modelos")
#[Entity]
class Modelo implements \JsonSerializable
{
    #[Id, GeneratedValue(strategy: 'AUTO'), Column]
    private int $id;

    #[Column]
    private string $modelo;

    #[Column]
    private string $producao;

    #[Column(type: 'integer')]
    private string $sublote;

    #[Column(type: 'integer')]
    private string $quantidade;

    #[Column(type: 'float')]
    private string $valor;

    #[Column]
    private string $cod_barras;

    #[Column(type: 'data')]
    private string $data_entrada;

    #[Column(type: 'data')]
    private string $data_saida;

    public function __construct()
    {
        $this->data_entrada = date('d/m/Y');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getModelo(): string
    {
        return $this->modelo;
    }

    public function setModelo(string $modelo): Modelo
    {
        $this->modelo = $modelo;
        return $this;
    }

    public function getProducao(): string
    {
        return $this->producao;
    }

    public function setProducao(string $producao): Modelo
    {
        $this->producao = $producao;
        return $this;
    }

    public function getSublote(): string
    {
        return $this->sublote;
    }

    public function setSublote(string $sublote): Modelo
    {
        $this->sublote = $sublote;
        return $this;
    }

    public function getQuantidade(): string
    {
        return $this->quantidade;
    }

    public function setQuantidade(string $quantidade): Modelo
    {
        $this->quantidade = $quantidade;
        return $this;
    }

    public function getValor(): string
    {
        return $this->valor;
    }

    public function setValor(string $valor): Modelo
    {
        $this->valor = $valor;
        return $this;
    }

    public function getCodBarras(): string
    {
        return $this->cod_barras;
    }

    public function setCodBarras(string $cod_barras): Modelo
    {
        $this->cod_barras = $cod_barras;
        return $this;
    }

    public function getDataEntrada(): string
    {
        return $this->data_entrada;
    }

    public function getDataSaida(): string
    {
        return $this->data_saida;
    }

    public function setDataSaida(string $data_saida): Modelo
    {
        $this->data_saida = $data_saida;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'modelo' => $this->modelo,
            'producao' => $this->producao,
            'sublote' => $this->sublote,
            'quantidade' => $this->quantidade,
            'valor' => $this->valor,
            'cod_barras' => $this->cod_barras,
            'data_entrada' => $this->data_entrada,
            'data_saida' => $this->data_saida,
        ];
    }
}
