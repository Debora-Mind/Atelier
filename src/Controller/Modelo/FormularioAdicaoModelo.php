<?php

namespace Dam\Atelier\Controller\Modelo;

use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioAdicaoModelo implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    use VerificarPermissoesTrait;

    private $repositorioModelos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioModelos = $entityManager
            ->getRepository(Modelo::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->verificarPermissoes([6, 7]);

        $modelos = $this->repositorioModelos->findBy(['empresa' => $_SESSION['empresa']]);
        $codBarrasArray = array_map(function($modelo) {
            return $modelo->getCodBarras();
        }, $modelos);

        $html = $this->renderizaHtml('Modelos/formulario.php', [
            'listaCodigoBarras' => $codBarrasArray
        ]);
        return new Response(200, [], $html);
    }
}
