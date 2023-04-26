<?php

namespace Dam\Atelier\Controller\Documentos;

use Dam\Atelier\Entity\Modelo\Modelo;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Nyholm\Psr7\Response;

class VisualizarImagens implements RequestHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ResponseFactoryInterface
     */
    private $responseFactory;

    public function __construct(EntityManagerInterface $entityManager, ResponseFactoryInterface $responseFactory)
    {
        $this->entityManager = $entityManager;
        $this->responseFactory = $responseFactory;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getQueryParams()['id'];

        $imagem = stream_get_contents($this->entityManager->getRepository(Modelo::class)->find($id)->getImagemModelo());

        $response = new Response();

        $fileInfo = new \finfo(FILEINFO_MIME_TYPE);
        $contentType = $fileInfo->buffer($imagem);

        $response->getBody()->write($imagem);
        return $response->withHeader('Content-Type', $contentType);
    }
}
