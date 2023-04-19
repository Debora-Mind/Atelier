<?php
namespace Dam\Atelier\Controller\Modelo;

use Dam\Atelier\Entity\Empresa\Empresa;
use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Dam\Atelier\Model\Modelos\BuscarModelos;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use function DI\string;

class ListarModelos implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    use VerificarPermissoesTrait;

    private $entityManager;
    private $modelos;
    private $empresa;

    public function __construct(EntityManagerInterface $entityManager, BuscarModelos $modelos)
    {
        $this->entityManager = $entityManager;
        $this->modelos = $modelos;
        $this->empresa = $entityManager->getRepository(Empresa::class)->find($_SESSION['empresa']);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->verificarPermissoes([6]);
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

    private function obterSemana(ServerRequestInterface $request): int|null
    {
        $semana = $request->getParsedBody()['semana'] ?? 0;
        $semana = (int) filter_var($semana, FILTER_SANITIZE_NUMBER_INT);
        if ($semana == 0) {
            return null;
        }
        return $semana;
    }

    private function filtrarModelos($repositorio, $filtro, $semana)
    {
        $semanaValida = array_filter($repositorio, function ($item) use ($semana) {
            return $item->getSemana() == $semana;
        });
        $resultados = new ArrayCollection();
        $filtroValido = in_array($filtro, [1, 2, 3]);
        // 1 = Todos, 2 = Com saída, 3 = Sem saída
        foreach ($semana ? $semanaValida : $repositorio as $modelo) {
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
        $semana = $this->obterSemana($request);
        $modelos = $this->entityManager->getRepository(Modelo::class)->findBy(['empresa' => $_SESSION['empresa']]);
        $modelosFiltrados = $this->filtrarModelos($modelos, $filtro, $semana)->toArray();

        if (!empty($busca)) {
            $modelosFiltrados = $this->modelos->buscarModelos($modelosFiltrados, $busca);
        }

        $modelosOrdenados = $this->ordenarLista($modelosFiltrados);

        return $modelosOrdenados;
    }

    private function ordenarLista($array): array
    {

        usort($array, function ($a, $b) {
            $aDate = $a->getDataEntrada();
            $bDate = $b->getDataEntrada();

            if (!isset($aDate)) {
                return -1;
            }
            if (!isset($bDate)) {
                return 1;
            }
            if ($aDate == $bDate) {
                return 0;
            }

            return ($aDate > $bDate) ? 1 : -1;
        });

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

        return $array;
    }

    private function renderizarTemplate(mixed $modelos): string
    {
        return $this->renderizaHtml('Modelos/listar-modelos.php', [
            'modelos' => $modelos,
            'entityManager' => $this->entityManager,
            'empresa' => $this->empresa,
        ]);
    }
}
