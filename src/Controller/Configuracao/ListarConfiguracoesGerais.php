<?php

namespace Dam\Atelier\Controller\Configuracao;

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

class ListarConfiguracoesGerais implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    use VerificarPermissoesTrait;

    private $configuracoes;
    private $empresa;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->configuracoes = $entityManager
            ->getRepository(ConfiguracaoGeral::class);
        $this->empresa = $entityManager
            ->getRepository(Empresa::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->verificarPermissoes([12]);

        $configuracoes = $this->configuracoes->findAll();
        $empresa = $this->empresa->find($_SESSION['empresa']);

        $html = $this->renderizaHtml('Configuracao/geral.php', [
            'configuracoes' => $configuracoes,
            'empresa' => $empresa,
        ]);
        return new Response(200, [], $html);
    }
}
