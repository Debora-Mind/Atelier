<?php

namespace Dam\Atelier\Controller\Usuario;

use Dam\Atelier\Entity\Usuario\Usuario;
use Dam\Atelier\Helper\FlashMessageTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ExcluirUsuario implements RequestHandlerInterface
{
    use FlashMessageTrait;
    use VerificarPermissoesTrait;

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
        $this->verificarPermissoes([1, 4]);
        $id = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );

        $resposta = new Response(302, ['Location' => '/usuarios']);
        if (is_null($id) || $id === false) {
            $this->defineMensagem('danger', 'Usuário inexistente');
            return $resposta;
        }

        $usuario = $this->entityManager->getReference(
            Usuario::class,
            $id
        );
        $this->entityManager->remove($usuario);
        $this->entityManager->flush();
        $this->defineMensagem('success', 'Usuário excluído com sucesso');

        return $resposta;
    }
}
