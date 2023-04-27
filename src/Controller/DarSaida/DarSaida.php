<?php

namespace Dam\Atelier\Controller\DarSaida;

use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DarSaida implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    use VerificarPermissoesTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->verificarPermissoes([16]);

        $html = $this->renderizaHtml('DarSaida/dar-saida.php', [
        ]);
        return new Response(200, [], $html);
    }
}
