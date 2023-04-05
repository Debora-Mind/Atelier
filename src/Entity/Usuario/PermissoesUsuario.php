<?php

namespace Dam\Atelier\Entity\Usuario;

use Doctrine\ORM\Mapping as ORM;

use Dam\Atelier\Entity\Funcionario\Funcionario;

#[ORM\Entity]
#[ORM\Table(name: "permissoes_usuario")]
class PermissoesUsuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\ManyToOne(targetEntity: Usuario::class)]
    #[ORM\JoinColumn(name: "id_usuario", referencedColumnName: "id")]
    private Usuario $usuario;

    #[ORM\ManyToOne(targetEntity: Permissoes::class)]
    #[ORM\JoinColumn(name: "id_permissoes", referencedColumnName: "id")]
    private Permissoes $permissoes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getPermissoes(): ?Permissoes
    {
        return $this->permissoes;
    }

    public function setPermissoes(Permissoes $permissoes): self
    {
        $this->permissoes = $permissoes;

        return $this;
    }
}
