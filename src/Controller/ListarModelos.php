<?php

namespace Dam\Atelier\Controller;

use Dam\Atelier\Entity\Modelo;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListarModelos implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    private $repositorioDeModelos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioDeModelos = $entityManager
            ->getRepository(Modelo::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderizaHtml('Modelos/listar-modelos.php', [
            'modelos' => $this->repositorioDeModelos->findAll(),
        ]);

        return new Response(200, [], $html);
    }
}
