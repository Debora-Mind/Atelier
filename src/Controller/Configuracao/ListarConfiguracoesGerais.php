<?php

namespace Dam\Atelier\Controller\Configuracao;

use Dam\Atelier\Entity\Configuracao\ConfiguracaoGeral;
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

    public function __construct(EntityManagerInterface $entityManager)
{
    $this->configuracoes = $entityManager
        ->getRepository(ConfiguracaoGeral::class);
}

    public function handle(ServerRequestInterface $request): ResponseInterface
{
    $this->verificarPermissoes([12]);
    $id = filter_var(
        $request->getQueryParams()['id'],
        FILTER_VALIDATE_INT
    );

    $configuracoes = $this->configuracoes->findAll();

    $html = $this->renderizaHtml('Configuracao/geral.php', [
        'configuracoes' => $configuracoes,
    ]);
    return new Response(200, [], $html);
}
}
