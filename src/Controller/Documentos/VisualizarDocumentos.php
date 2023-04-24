<?php

namespace Dam\Atelier\Controller\Documentos;

use Dam\Atelier\Entity\Modelo\Modelo;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Nyholm\Psr7\Stream;
use Nyholm\Psr7\UploadedFile;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use setasign\Fpdi\Fpdi;
use Psr\Http\Server\RequestHandlerInterface;

class VisualizarDocumentos implements RequestHandlerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws Exception
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getQueryParams()['id'];

        $modeloRepository = $this->entityManager->getRepository(Modelo::class);
        $modelo = $modeloRepository->find($id);

        $pdfData = $modelo->getRoteiro();
        $temp = tmpfile();

        fwrite($temp, stream_get_contents($pdfData));
        rewind($temp);

        return new Response(200, [
            'Content-Type' => 'application/pdf',
        ], $temp);
    }
}
