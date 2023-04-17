<?php

namespace Dam\Atelier\Controller\Login;

use Dam\Atelier\Entity\Usuario\Usuario;
use Dam\Atelier\Helper\FlashMessageTrait;
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
        $usuario = filter_var(
            $request->getParsedBody()['usuario'],
            FILTER_SANITIZE_SPECIAL_CHARS
        );

        $redirecionamentoLogin = new Response(302, ['Location' => '/login']);
        if (is_null($usuario) || $usuario === false) {
            $this->defineMensagem(
                'danger',
                'O usuário digitado não é um usuário válido.'
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
            ->findOneBy(['usuario' => $usuario]);

        if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            $this->defineMensagem('danger', 'Usuário ou senha inválidos');

            return $redirecionamentoLogin;
        }

        $_SESSION['logado'] = true;
        $_SESSION['permissoes'] = $usuario->getPermissoes();
        $_SESSION['empresa'] = $usuario->getEmpresa()->getId();
        $_SESSION['pagina_anterior'] = '/';

        return new Response(302, ['Location' => '/']);
    }
}
