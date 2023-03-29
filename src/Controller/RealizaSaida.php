<?php

namespace Dam\Atelier\Controller;

use Dam\Atelier\Entity\Modelo;
use Dam\Atelier\Helper\FlashMessageTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizaSaida implements RequestHandlerInterface
{
    use FlashMessageTrait;
    private $repositorioDeModelos;

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repositorioDeModelos = $entityManager
            ->getRepository(Modelo::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = filter_var(
            $request->getQueryParams()['id'] ?? false,
            FILTER_VALIDATE_INT
        );

        $modelo = $this->repositorioDeModelos->findOneBy(['id' => $id]);
        $modelo->setDataSaida();

        $tipo = 'success';

        $this->entityManager->merge($modelo);
        $this->defineMensagem($tipo, 'Saída realizada com sucesso');
        $this->entityManager->flush();

        return new Response(302, ['Location' => '/modelos']);
    }
}
