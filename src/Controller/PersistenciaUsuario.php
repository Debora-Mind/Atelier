<?php

namespace Dam\Atelier\Controller;

use Dam\Atelier\Entity\Modelo;
use Dam\Atelier\Entity\Usuario;
use Dam\Atelier\Helper\FlashMessageTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PersistenciaUsuario implements RequestHandlerInterface
{
    use FlashMessageTrait;

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $usuario = filter_var(
            $request->getParsedBody()['usuario'],
            FILTER_SANITIZE_SPECIAL_CHARS
        );

        $senha = filter_var(
            $request->getParsedBody()['senha'],
            FILTER_SANITIZE_SPECIAL_CHARS
        );

        $senhaRepitida = filter_var(
            $request->getParsedBody()['senha-repitida'],
            FILTER_SANITIZE_SPECIAL_CHARS
        );

        $funcionario = filter_var(
            $request->getParsedBody()['funcionario'],
            FILTER_SANITIZE_NUMBER_INT
        );

        $permissoes = [];

        $senhaCriptografada = $this->CriptografarSenha($senha);

        $novoUsuario = new Usuario();
        $novoUsuario->setUsuario($usuario)
            ->setSenha($senhaCriptografada)
            ->setPermissoes($permissoes);

        $id = filter_var(
            $request->getQueryParams()['id'] ?? false,
            FILTER_VALIDATE_INT
        );

        $_SESSION['usuario'] = $usuario;
        $_SESSION['senha'] = $senha;
        $_SESSION['senha-repitida'] = $senhaRepitida;
        $_SESSION['funcionario'] = $funcionario;

        $tipo = 'success';

        if ($senha !== $senhaRepitida) {
            $tipo = 'danger';
            $this->defineMensagem($tipo, 'As senhas devem ser iguais');
            header('Location: /novo-usuario');
            exit();
        } elseif (!is_null($id) && $id !== false) {
            $novoUsuario->setId($id);
            $this->entityManager->merge($novoUsuario);
            $this->defineMensagem($tipo, 'Usuario atualizado com sucesso');
        } else {
            $this->entityManager->persist($novoUsuario);
            $this->defineMensagem($tipo, 'Usuario inserido com sucesso');
        }

        $this->entityManager->flush();

        unset($_SESSION['usuario'],
              $_SESSION['senha'],
              $_SESSION['senha-repitida'],
              $_SESSION['funcionario']);

        return new Response(302, ['Location' => '/usuarios']);
    }

    private function CriptografarSenha($senha): string
    {
        return password_hash($senha, PASSWORD_ARGON2I);
    }
}
