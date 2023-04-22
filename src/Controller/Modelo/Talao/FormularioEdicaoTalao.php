<?php

namespace Dam\Atelier\Controller\Modelo\Talao;

use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Entity\Modelo\Talao\Talao;
use Dam\Atelier\Helper\FlashMessageTrait;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioEdicaoTalao implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait, FlashMessageTrait;
    use VerificarPermissoesTrait;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repositorioTaloes;
    private $repositorioModelos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioTaloes = $entityManager
            ->getRepository(Talao::class);
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

        $resposta = new Response(302, ['Location' => '/taloes']);
        if (is_null($id) || $id === false) {
            $this->defineMensagem('danger', 'ID do talão inválido');
            return $resposta;
        }

        $talao = $this->repositorioTaloes->find($id);

        $taloes = $this->repositorioTaloes
            ->findBy([ 'modelo' => $this->repositorioModelos
            ->findBy(['empresa' => $_SESSION['empresa']])]);
        $codBarrasArray = array_map(function($talao) {
            return $talao->getCodBarras();
        }, $taloes);

        $html = $this->renderizaHtml('Modelos/Taloes/formulario.php', [
            'talao' => $talao,
            'modelos' => $this->repositorioModelos->findBy(['empresa' => $_SESSION['empresa']]),
            'titulo' => 'Alterar modelo ' . $talao->getModelo()->getModelo(),
            'listaCodigoBarras' => $codBarrasArray
        ]);

        return new Response(200, [], $html);
    }
}
