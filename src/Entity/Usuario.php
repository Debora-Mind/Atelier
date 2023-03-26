<?php

namespace Dam\Atelier\Entity;

use Doctrine\ORM\Mapping\{GeneratedValue, Id, Entity, Column};

//@Table(name="usuarios")
#[Entity]
class Usuario
{

    #[Id, GeneratedValue(strategy: 'AUTO'), Column]
    private int $id;

    #[Column]
    private $email;

    #[Column]
    private $senha;

    public function senhaEstaCorreta(string $senhaPura): bool
    {
        return password_verify($senhaPura, $this->senha);
    }
}
