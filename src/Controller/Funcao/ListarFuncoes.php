<?php

namespace Dam\Atelier\Controller\Funcao;

use Dam\Atelier\Entity\Funcionario\Funcao;
use Dam\Atelier\Entity\Usuario\Usuario;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Dam\Atelier\Model\Funcionarios\BuscarFuncionarios;
use Dam\Atelier\Model\Funcoes\BuscarFuncoes;
use Dam\Atelier\Model\Usuario\BuscarUsuarios;
use Doctrine\Common\Collections\ArrayCollection;
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

    public function __construct(EntityManagerInterface $entityManager,
                                BuscarFuncoes $funcoes,
    )
    {
        $this->entityManager = $entityManager;
        $this->funcoes = $funcoes;
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
        $busca = $this->tratarBusca($request);
        $funcoes = $this->entityManager->getRepository(Funcao::class)->findAll();
        $listaFuncoes = new ArrayCollection($funcoes);

        //Ordenação da lista
        $array = $listaFuncoes->toArray();
        usort($array, function ($a, $b) {
            return strcmp($a->getId(), $b->getId());
        });

        if (!empty($busca)) {
            return $this->funcoes->buscarFuncoes($array, $busca);
        }

        return $funcoes;
    }

    private function renderizarTemplate(mixed $funcoes): string
    {
        return $this->renderizaHtml('Funcoes/listar-funcoes.php', [
            'funcoes' => $funcoes,
        ]);
    }
}
