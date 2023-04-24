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
        // Recupera o ID da imagem a ser exibida
        $id = $request->getQueryParams()['id'];
        $imagem = stream_get_contents($this->entityManager->getRepository(Modelo::class)->find($id)->getImagemModelo());

        $response = $this->responseFactory->createResponse();

        // Define o conteúdo da página HTML
        $html = '<!DOCTYPE html>';
        $html .= '<html lang="pt-br">';
        $html .= '<head>';
        $html .= '<meta charset="UTF-8">';
        $html .= '<title>Visualizar Imagem</title>';
        $html .= '</head>';
        $html .= '<body>';
        $html .= '<img src="data:image/png;base64,' . base64_encode($imagem) . '">';
        $html .= '</body>';
        $html .= '</html>';

        $response->getBody()->write($html);

        return $response;
    }
}
