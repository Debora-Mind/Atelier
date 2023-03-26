<?php

namespace Dam\Atelier\Controller;

use Dam\Atelier\Entity\Curso;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class IndexController implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    public function __construct(EntityManagerInterface $entityManager)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderizaHtml('/', []);

        return new Response(200, [], $html);
    }
}
