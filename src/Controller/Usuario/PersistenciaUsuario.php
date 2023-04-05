<?php

namespace Dam\Atelier\Controller\Usuario;

use Dam\Atelier\Entity\Funcionario\Funcionario;
use Dam\Atelier\Entity\Usuario\Usuario;
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
            $_POST['funcionario'] ?? null,
            FILTER_SANITIZE_SPECIAL_CHARS
        );

        $repositoioFuncionarios = $this->entityManager->getRepository(Funcionario::class);
        $funcionario = $repositoioFuncionarios->find($funcionario);

        $permissoes = [];

        $senhaCriptografada = $this->CriptografarSenha($senha);

        $novoUsuario = new Usuario($this->entityManager);
        $novoUsuario->setUsuario($usuario)
            ->setSenha($senhaCriptografada)
            ->setPermissoes($permissoes)
            ->setFuncionario($funcionario);

        $id = filter_var(
            $request->getQueryParams()['id'] ?? false,
            FILTER_VALIDATE_INT
        );

        $_SESSION['usuario'] = $usuario;
        $_SESSION['funcionario'] = $funcionario;

        $tipo = 'success';

        if ($usuario === "") {
            $tipo = 'danger';
            $this->defineMensagem($tipo, "O campo 'Usuário' é obrigatório");
            header('Location: /novo-usuario');
            exit();
        } elseif ($senha === "") {
            $tipo = 'danger';
            $this->defineMensagem($tipo, "O campo 'Senha' é obrigatório");
            header('Location: /novo-usuario');
            exit();
        }
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
              $_SESSION['funcionario']);

        return new Response(302, ['Location' => '/usuarios']);
    }

    private function CriptografarSenha($senha): string
    {
        return password_hash($senha, PASSWORD_ARGON2I);
    }
}
