<?php

namespace Dam\Atelier\Controller;

use Dam\Atelier\Helper\FlashMessageTrait;
use Dam\Atelier\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizaLogin implements RequestHandlerInterface
{
    use FlashMessageTrait;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repositorioDeUsuarios;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioDeUsuarios = $entityManager
            ->getRepository(Usuario::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $email = filter_var(
            $request->getParsedBody()['email'],
            FILTER_VALIDATE_EMAIL
        );

        $redirecionamentoLogin = new Response(302, ['Location' => '/Login']);
        if (is_null($email) || $email === false) {
            $this->defineMensagem(
                'danger',
                'O e-mail digitado não é um e-mail válido.'
            );

            return $redirecionamentoLogin;
        }

        $senha = filter_input(
            INPUT_POST,
            'senha',
            FILTER_SANITIZE_SPECIAL_CHARS
        );

        /** @var Usuario $usuario */
        $usuario = $this->repositorioDeUsuarios
            ->findOneBy(['email' => $email]);

        if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            $this->defineMensagem('danger', 'E-mail ou senha inválidos');

            return $redirecionamentoLogin;
        }

        $_SESSION['logado'] = true;

        return new Response(302, ['Location' => '/listar-cursos']);
    }
}