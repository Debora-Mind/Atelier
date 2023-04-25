<?php

namespace Dam\Atelier\Controller\Documentos;

use Dam\Atelier\Entity\Empresa\Empresa;
use Dam\Atelier\Entity\Modelo\Modelo;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class VisualizarLogo implements RequestHandlerInterface
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $_SESSION['empresa'];
        $imagem = stream_get_contents($this->entityManager
            ->getRepository(Empresa::class)
            ->find($id)->getLogo());

        $response = new Response();
        $response->getBody()->write($imagem);
        return $response->withHeader('Content-Type', 'image/png, image/jpeg, image/svg');
    }
}
