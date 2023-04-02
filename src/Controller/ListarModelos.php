<?php
namespace Dam\Atelier\Controller;

use Dam\Atelier\Entity\Modelo;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Model\Modelos\BuscarModelos;
use DateTime;
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
        $busca = $this->tratarBusca($request);

        $modelos = $this->obterListaDeModelos($busca);

        $html = $this->renderizaHtml('Modelos/listar-modelos.php', [
            'modelos' => $modelos,
        ]);

        return new Response(200, [], $html);
    }

    private function tratarBusca(ServerRequestInterface $request): string
    {
        $busca = '';

        if (isset($request->getParsedBody()['busca'])) {
            $busca = filter_var($request->getParsedBody()['busca'], FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $busca;
    }

    private function obterListaDeModelos(string $busca): array
    {
        if (!empty($busca)) {
            return $this->modelos->buscarModelos($this->entityManager->getRepository(Modelo::class), $busca);
        }

        $modelos = $this->entityManager->getRepository(Modelo::class)->findAll();

        usort($modelos, function($a, $b) {
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

        return $modelos;
    }
}
