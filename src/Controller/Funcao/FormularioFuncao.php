<?php

namespace Dam\Atelier\Controller\Funcao;

use Dam\Atelier\Entity\Funcionario\Funcao;
use Dam\Atelier\Entity\Funcionario\Funcionario;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioFuncao implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    use VerificarPermissoesTrait;

    private $funcoes;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->funcoes = $entityManager
            ->getRepository(Funcao::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->verificarPermissoes([13, 14]);
        $funcoes = $this->funcoes->findAll();

        $html = $this->renderizaHtml('FuncaoTrait/formulario.php', [
            'funcoes' => $funcoes,
        ]);
        return new Response(200, [], $html);
    }
}
