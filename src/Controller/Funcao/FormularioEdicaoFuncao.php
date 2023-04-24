<?php

namespace Dam\Atelier\Controller\Funcao;

use Dam\Atelier\Entity\Funcionario\Funcao;
use Dam\Atelier\Entity\Funcionario\Funcionario;
use Dam\Atelier\Entity\Usuario\Usuario;
use Dam\Atelier\Helper\FlashMessageTrait;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioEdicaoFuncao implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait, FlashMessageTrait;
    use VerificarPermissoesTrait;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repositorioFuncoes;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioFuncoes = $entityManager
            ->getRepository(Funcao::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->verificarPermissoes([13, 15]);
        $id = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );

        $resposta = new Response(302, ['Location' => '/funcoes']);
        if (is_null($id) || $id === false) {
            $this->defineMensagem('danger', 'ID da função inválido');
            return $resposta;
        }

        $funcao = $this->repositorioFuncoes->find($id);

        $html = $this->renderizaHtml('FuncaoTrait/formulario.php', [
            'funcao' => $funcao,
            'titulo' => 'Alterar função ' . $funcao->getDescricao(),
        ]);

        return new Response(200, [], $html);
    }
}