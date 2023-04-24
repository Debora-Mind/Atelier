<?php

namespace Dam\Atelier\Controller\Modelo;

use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Helper\FlashMessageTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;

class ExcluirModelo implements RequestHandlerInterface
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
        $this->verificarPermissoes([6, 9]);
        $id = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );

        $resposta = new Response(302, ['Location' => '/modelos']);
        if (is_null($id) || $id === false) {
            $this->defineMensagem('danger', 'Modelo inexistente');
            return $resposta;
        }

        $modelo = $this->entityManager->getReference(
            Modelo::class,
            $id
        );

        $this->defineMensagem('success', 'Modelo excluído com sucesso');

        try {
            $this->entityManager->remove($modelo);
            $this->entityManager->flush();
        } catch (ForeignKeyConstraintViolationException $e) {
            if ($e->getCode() == '1451') {
                $this->defineMensagem('danger',
                    'O modelo possuí vinculos e por isso não pode ser excluído');
            } else {
                $this->defineMensagem('danger',
                    'Erro: ' . $e->getCode() . '. Contate o suporte');
            }
        }
        
        return $resposta;
    }
}
