<?php

namespace Dam\Atelier\Controller\Funcao;

use Dam\Atelier\Entity\Empresa\Empresa;
use Dam\Atelier\Entity\Funcionario\Funcao;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Dam\Atelier\Model\Modelos\BuscarModelos;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListarFuncoes implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    use VerificarPermissoesTrait;

    private $entityManager;
    private $funcoes;
    private $empresa;

    public function __construct(EntityManagerInterface $entityManager, BuscarModelos $funcoes)
    {
        $this->entityManager = $entityManager;
        $this->funcoes = $funcoes;
        $this->empresa = $entityManager->getRepository(Empresa::class)->find($_SESSION['empresa']);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->verificarPermissoes([13]);
        $funcoes = $this->obterLista($request);
        $html = $this->renderizarTemplate($funcoes);

        return new Response(200, [], $html);
    }

    private function tratarBusca(ServerRequestInterface $request): string
    {
        $parsedBody = $request->getParsedBody();
        $busca = $parsedBody['busca'] ?? '';
        return filter_var($busca, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    private function obterLista($request)
    {
        if (isset($_GET['pagina'])) {
            return $_SESSION['itens'];
        }
        $busca = $this->tratarBusca($request);
        $funcoes = $this->entityManager->getRepository(Funcao::class)
                ->findBy(['empresa' => $_SESSION['empresa']], ['descricao' => 'ASC']);

        if (!empty($busca)) {
            $funcoes = $this->funcoes->buscar($funcoes, $busca, 'funcao');
        }

        $_SESSION['itens'] = $funcoes;

        return $funcoes;
    }

    private function renderizarTemplate(mixed $funcoes): string
    {
        return $this->renderizaHtml('Funcoes/listar-funcoes.php', [
            'funcoes' => $funcoes,
            'entityManager' => $this->entityManager,
            'empresa' => $this->empresa,
        ]);
    }
}
