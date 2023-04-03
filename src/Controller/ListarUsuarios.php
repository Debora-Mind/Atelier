<?php

namespace Dam\Atelier\Controller;

use ArrayObject;
use Dam\Atelier\Entity\Modelo;
use Dam\Atelier\Entity\Usuario;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Model\Funcoes\BuscarFuncoes;
use Dam\Atelier\Model\Modelos\BuscarModelos;
use Dam\Atelier\Model\Usuario\BuscarUsuarios;
use DateTime;
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

    public function __construct(EntityManagerInterface $entityManager, BuscarUsuarios $usuarios, BuscarFuncoes $funcoes)
    {
        $this->entityManager = $entityManager;
        $this->usuarios = $usuarios;
        $this->funcoes = $funcoes;
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
        $filtro = $request->getParsedBody()['filtro-funcao'] ?? 1;
        return (int)$filtro;
    }

    private function filtrar($repositorio, $filtro)
    {
        $resultados = new ArrayCollection();
        $filtroValido = in_array($filtro, [1, 2, 3]);
        // 1 = Todos, 2 = Com saída, 3 = Sem saída
        foreach ($repositorio as $usuario) {
            if ($filtroValido) {
                $condicao = ($filtro == 2 && $usuario->getDataSaida() !== null) ||
                    ($filtro == 3 && $usuario->getDataSaida() === null) ||
                    ($filtro == 1);

                if ($condicao) {
                    $resultados->add($usuario);
                }
            } else {
                $resultados->add($usuario);
            }
        }

        return $resultados;
    }

    private function obterLista($request)
    {
        $filtro = $this->obterFiltro($request);
        $busca = $this->tratarBusca($request);
        $usuarios = $this->entityManager->getRepository(Usuario::class)->findAll();
        $usuarios = $this->filtrar($usuarios, $filtro);

        //Ordenação da lista
        $array = $usuarios->toArray();
        usort($array, function ($a, $b) {
            return strcmp($a->getName(), $b->getName());
        });

        if (!empty($busca)) {
            return $this->usuarios->buscarUsuarios($array, $busca);
        }

        return $array;
    }

    private function renderizarTemplate(mixed $usuarios): string
    {
        return $this->renderizaHtml('Usuarios/listar-usuarios.php', [
            'usuarios' => $usuarios,
            'funcoes' => $this->funcoes,
        ]);
    }
}
