<?php
namespace Dam\Atelier\Controller;

use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Model\Modelos\BuscarModelos;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListarModelos implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    private $entityManager;
    private $modelos;

    public function __construct(EntityManagerInterface $entityManager, BuscarModelos $modelos)
    {
        $this->entityManager = $entityManager;
        $this->modelos = $modelos;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $modelos = $this->obterListaDeModelos($request);
        $html = $this->renderizarTemplate($modelos);

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
        $filtro = $request->getParsedBody()['filtro-saida'] ?? 1;
        return (int) $filtro;
    }

    private function filtrarModelos($repositorio, $filtro)
    {
        $resultados = new ArrayCollection();
        $filtroValido = in_array($filtro, [1, 2, 3]);
        // 1 = Todos, 2 = Com saída, 3 = Sem saída
        foreach ($repositorio as $modelo) {
            if ($filtroValido) {
                $condicao = ($filtro == 2 && $modelo->getDataSaida() !== null) ||
                    ($filtro == 3 && $modelo->getDataSaida() === null) ||
                    ($filtro == 1);

                if ($condicao) {
                    $resultados->add($modelo);
                }
            } else {
                $resultados->add($modelo);
            }
        }

        return $resultados;
    }

    private function obterListaDeModelos($request)
    {
        $filtro = $this->obterFiltro($request);
        $busca = $this->tratarBusca($request);
        $modelos = $this->entityManager->getRepository(Modelo::class)->findAll();
        $modelos = $this->filtrarModelos($modelos, $filtro);

        //Ordenação da lista
        $array = $modelos->toArray();
        usort($array, function ($a, $b) {
            $aDate = $a->getDataSaida();
            $bDate = $b->getDataSaida();

            if (!isset($aDate)) {
                return -1;
            }
            if (!isset($bDate)) {
                return 1;
            }
            if ($aDate == $bDate) {
                return 0;
            }

            return ($aDate > $bDate) ? -1 : 1;
        });

        if (!empty($busca)) {
            return $this->modelos->buscarModelos($array, $busca);
        }

        return $array;
    }

    private function renderizarTemplate(mixed $modelos): string
    {
        return $this->renderizaHtml('Modelos/listar-modelos.php', [
            'modelos' => $modelos,
        ]);
    }
}
