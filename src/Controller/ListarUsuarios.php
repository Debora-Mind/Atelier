<?php

namespace Dam\Atelier\Controller;

use Dam\Atelier\Entity\Usuario\Usuario;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Model\Funcionarios\BuscarFuncionarios;
use Dam\Atelier\Model\Funcoes\BuscarFuncoes;
use Dam\Atelier\Model\Usuario\BuscarUsuarios;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListarUsuarios implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    private $entityManager;
    private $usuarios;
    private $funcoes;
    private $funcionarios;


    public function __construct(EntityManagerInterface $entityManager,
                                BuscarUsuarios $usuarios,
                                BuscarFuncoes $funcoes,
                                BuscarFuncionarios $funcionarios)
    {
        $this->entityManager = $entityManager;
        $this->usuarios = $usuarios;
        $this->funcoes = $funcoes;
        $this->funcionarios = $funcionarios;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $usuarios = $this->obterLista($request);
        $html = $this->renderizarTemplate($usuarios);

        return new Response(200, [], $html);
    }

    private function tratarBusca(ServerRequestInterface $request): string
    {
        $parsedBody = $request->getParsedBody();
        $busca = $parsedBody['busca'] ?? '';
        return filter_var($busca, FILTER_SANITIZE_SPECIAL_CHARS);
    }


    private function obterFiltro(ServerRequestInterface $request): int
    {
        $filtro = $request->getParsedBody()['filtro-funcao'] ?? 0;
        return (int)$filtro;
    }

    private function obterLista($request)
    {
        $filtro = $this->obterFiltro($request);
        $busca = $this->tratarBusca($request);
        $usuarios = $this->entityManager->getRepository(Usuario::class)->findAll();
        $listaUsuarios = new ArrayCollection($usuarios);

        //Ordenação da lista
        $array = $listaUsuarios->toArray();
        usort($array, function ($a, $b) {
            return strcmp($a->getId(), $b->getId());
        });

        if (!empty($busca)) {
            return $this->usuarios->buscarUsuarios($array, $busca);
        }

        return $usuarios;
    }

    private function renderizarTemplate(mixed $usuarios): string
    {
        return $this->renderizaHtml('Usuarios/listar-usuarios.php', [
            'usuarios' => $usuarios,
            'funcoes' => $this->funcoes
        ]);
    }
}
