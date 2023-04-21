<?php

namespace Dam\Atelier\Controller\Modelo\Talao;

use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Entity\Modelo\Talao\Talao;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioAdicaoTalao implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    use VerificarPermissoesTrait;

    private $repositorioTaloes;
    private $repositorioModelos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioTaloes = $entityManager
            ->getRepository(Talao::class);
        $this->repositorioModelos = $entityManager
            ->getRepository(Modelo::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->verificarPermissoes([6, 7]);

        $taloes = $this->repositorioTaloes
            ->findBy([ 'modelo' => $this->repositorioModelos
            ->findBy(['empresa' => $_SESSION['empresa']])]);
        $codBarrasArray = array_map(function($modelo) {
            return $modelo->getCodBarras();
        }, $taloes);

        $html = $this->renderizaHtml('Modelos/Taloes/formulario.php', [
            'listaCodigoBarras' => $codBarrasArray,
            'modelos' => $this->repositorioModelos->findBy(['empresa' => $_SESSION['empresa']]),
            'taloes' => $taloes,
        ]);
        return new Response(200, [], $html);
    }
}
