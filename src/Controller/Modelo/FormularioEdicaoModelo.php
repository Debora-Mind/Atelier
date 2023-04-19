<?php

namespace Dam\Atelier\Controller\Modelo;

use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Helper\FlashMessageTrait;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioEdicaoModelo implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait, FlashMessageTrait;
    use VerificarPermissoesTrait;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repositorioModelos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioModelos = $entityManager
            ->getRepository(Modelo::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->verificarPermissoes([6, 8]);
        $id = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );

        $resposta = new Response(302, ['Location' => '/modelos']);
        if (is_null($id) || $id === false) {
            $this->defineMensagem('danger', 'ID do modelo inválido');
            return $resposta;
        }

        $modelo = $this->repositorioModelos->find($id);

        $modelos = $this->repositorioModelos->findBy(['empresa' => $_SESSION['empresa']]);
        $codBarrasArray = array_map(function($modelo) {
            return $modelo->getCodBarras();
        }, $modelos);

        $html = $this->renderizaHtml('Modelos/formulario.php', [
            'modelo' => $modelo,
            'titulo' => 'Alterar modelo ' . $modelo->getModelo(),
            'listaCodigoBarras' => $codBarrasArray
        ]);

        return new Response(200, [], $html);
    }
}
