<?php
namespace Dam\Atelier\Controller\Relatorios;

use Dam\Atelier\Entity\Empresa\Empresa;
use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Entity\Modelo\Talao\Talao;
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

class TaloesPorModelo implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    use VerificarPermissoesTrait;

    private $entityManager;
    private $taloes;
    private $empresa;
    private $modelos;

    public function __construct(EntityManagerInterface $entityManager, BuscarModelos $taloes)
    {
        $this->entityManager = $entityManager;
        $this->taloes = $taloes;
        $this->empresa = $entityManager->getRepository(Empresa::class)->find($_SESSION['empresa']);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->verificarPermissoes([18]);
        $taloes = $this->obterListaDeTaloes($request);
        $modelos = $this->obterModelos($taloes);
        $modelosId = $this->listaIdModelos();
        $html = $this->renderizarTemplate($taloes, $modelos, $modelosId);

        return new Response(200, [], $html);
    }

    private function obterListaDeTaloes($request)
    {
        if (isset($_GET['pagina'])) {
            return $_SESSION['itens'];
        }
        $taloes = $this->entityManager->getRepository(Talao::class)
            ->findBy([ 'modelo' => $this->entityManager->getRepository(Modelo::class)
            ->findBy(['empresa' => $_SESSION['empresa']])]);

        return $this->ordenarLista($taloes);
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

    private function renderizarTemplate(mixed $taloes, $modelos, $modelosId): string
    {
        return $this->renderizaHtml('Relatorios/taloes-agrupados-por-modelo.php', [
            'taloes' => $taloes,
            'modelos' => $modelos,
            'modelosId' => $modelosId,
            'entityManager' => $this->entityManager,
            'empresa' => $this->empresa,
        ]);
    }

    private function obterModelos(array $taloes): array
    {
        $modelos = $this->entityManager->getRepository(Modelo::class)->findAll();
        $listaModelos = [];

        foreach ($modelos as $modelo) {
            foreach ($taloes as $talao) {
                if ($modelo->getId() === $talao->getModelo()->getId() && !in_array($modelo, $listaModelos, true)) {
                    $listaModelos[] = $modelo;
                }
            }
        }
        return $listaModelos;
    }

    private function listaIdModelos()
    {
        $lista = [];
        if (isset($_SESSION['itens'])){
            foreach ($_SESSION['itens'] as $talao) {
                $lista [] = $talao->getModelo()->getId();
            }
        }
        return $lista;
    }

}
