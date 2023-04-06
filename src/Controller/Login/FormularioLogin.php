<?php

namespace Dam\Atelier\Controller\Login;

use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioLogin implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        unset($_SESSION['logado'], $_SESSION['permissoes']);
        $html = $this->renderizaHtml('Login/login.php', []);

        return new Response(200, [], $html);
    }
}
