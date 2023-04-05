<?php

namespace Dam\Atelier\Controller;

use Dam\Atelier\Entity\Funcionario;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Model\Funcionarios\BuscarFuncionarios;
use Dam\Atelier\Model\Funcoes\BuscarFuncoes;
use Dam\Atelier\Model\Usuario\BuscarUsuarios;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioUsuario implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    private $funcionarios;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->funcionarios = $entityManager
            ->getRepository(Funcionario::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $funcionarios = $this->funcionarios->findAll();

        $html = $this->renderizaHtml('Usuarios/formulario.php', [
            'funcionarios' => $funcionarios,
        ]);
        return new Response(200, [], $html);
    }
}
