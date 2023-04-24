<?php

namespace Dam\Atelier\Entity\Modelo;

use Doctrine\ORM\Mapping\{Column, Entity, GeneratedValue, Id, JoinColumn, ManyToOne, Table};
use Dam\Atelier\Entity\Empresa\Empresa;
use Doctrine\ORM\Mapping as ORM;
use Nyholm\Psr7\UploadedFile;

#[Entity]
#[Table(name: "modelo")]
class Modelo implements \JsonSerializable
{
    #[Id, GeneratedValue(strategy: 'AUTO'), Column(unique: 'True')]
    private int $id;

    #[Column]
    private string $modelo;

    #[Column(type: 'float')]
    private string $valorEntrada;

    #[Column(type: 'float')]
    private string $valorSaida;

    #[ManyToOne(targetEntity: Empresa::class)]
    #[JoinColumn(name: 'empresa_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Empresa $empresa;

    #[ORM\Column(type: "blob", nullable: true)]
    private $imagemModelo;

    #[ORM\Column(type: "blob", nullable: true)]
    private $roteiro;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
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

    public function getValorEntrada(bool $virgula = false): string|null
    {
        if ($this->valorEntrada === '0') {
            return null;
        }
        if ($virgula){
            return str_replace('.', ',',$this->valorEntrada);
        }
        return $this->valorEntrada;
    }

    public function setValorEntrada(string $valor): Modelo
    {
        $this->valorEntrada = $valor;
        return $this;
    }

    public function getValorSaida(bool $virgula = false): string|null
    {
        if ($this->valorSaida === '0') {
            return null;
        }
        if ($virgula){
            return str_replace('.', ',',$this->valorSaida);
        }
        return $this->valorSaida;
    }

    public function setValorSaida(string $valor): Modelo
    {
        $this->valorSaida = $valor;
        return $this;
    }

    public function getEmpresa(): Empresa
    {
        return $this->empresa;
    }

    public function setEmpresa(Empresa $empresa): self
    {
        $this->empresa = $empresa;
        return $this;
    }

    public function getImagemModelo()
    {
        return $this->imagemModelo;
    }

    public function setImagemModelo($foto): self
    {
        $this->imagemModelo = $foto;
        return $this;
    }

    public function getRoteiro()
    {
        return $this->roteiro;
    }

    public function setRoteiro($uploadedFile): self
    {
        $this->roteiro = $uploadedFile;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'modelo' => $this->modelo,
            'valorEntrada' => $this->valorEntrada,
            'valorSaida' => $this->valorSaida,
        ];
    }
}
