<?php

namespace Dam\Atelier\Controller;

use Dam\Atelier\Entity\Curso;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizaLogin implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioDeUsuarios = $entityManager
            ->getRepository(Usuario::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderizaHtml('RealizaLogin/listar-modelos.php', []);

        return new Response(200, [], $html);
    }
}