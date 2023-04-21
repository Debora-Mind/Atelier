<?php
namespace Dam\Atelier\Controller\Modelo;

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

    private function obterListaDeModelos($request)
    {
        $busca = $this->tratarBusca($request);
        $modelos = $this->entityManager->getRepository(Modelo::class)
                ->findBy(['empresa' => $_SESSION['empresa']]);
        if (!empty($busca)) {
            $modelos = $this->modelos->buscarModelos($modelos, $busca);
        }

        return $modelos;
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
