<?php

namespace Dam\Atelier\Controller\Funcao;

use Dam\Atelier\Entity\Funcionario\Funcao;
use Dam\Atelier\Entity\Usuario\Usuario;
use Dam\Atelier\Helper\FlashMessageTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ExcluirFuncao implements RequestHandlerInterface
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
        $this->verificarPermissoes([13, 16]);
        $id = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );

        $resposta = new Response(302, ['Location' => '/funcoes']);
        if (is_null($id) || $id === false) {
            $this->defineMensagem('danger', 'Função inexistente');
            return $resposta;
        }

        $funcao = $this->entityManager->getReference(
            Funcao::class,
            $id
        );
        $this->entityManager->remove($funcao);
        $this->entityManager->flush();
        $this->defineMensagem('success', 'Função excluída com sucesso');

        return $resposta;
    }
}
