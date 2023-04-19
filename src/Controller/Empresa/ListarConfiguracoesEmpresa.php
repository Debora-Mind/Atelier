<?php

namespace Dam\Atelier\Controller\Empresa;

use Dam\Atelier\Entity\Configuracao\ConfiguracaoGeral;
use Dam\Atelier\Entity\Empresa\Empresa;
use Dam\Atelier\Entity\Usuario\Permissoes;
use Dam\Atelier\Entity\Usuario\Usuario;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListarConfiguracoesEmpresa implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    use VerificarPermissoesTrait;

    private $empresa;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->empresa = $entityManager
            ->getRepository(Empresa::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->verificarPermissoes([17]);
        $empresa = $this->empresa->find($_SESSION['empresa']);

        $html = $this->renderizaHtml('Empresa/empresa.php', [
            'empresa' => $empresa,
        ]);
        return new Response(200, [], $html);
    }
}
