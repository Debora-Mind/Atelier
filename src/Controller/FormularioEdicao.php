<?php

namespace Dam\Atelier\Controller;

use Dam\Atelier\Entity\Modelo;
use Dam\Atelier\Helper\FlashMessageTrait;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioEdicao implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait, FlashMessageTrait;

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

        $html = $this->renderizaHtml('Modelos/formulario.php', [
            'modelo' => $modelo,
            'titulo' => 'Alterar modelo ' . $modelo->getModelo(),
        ]);

        return new Response(200, [], $html);
    }
}
