<?php

namespace Dam\Atelier\Controller\Usuario;

use Dam\Atelier\Entity\Funcionario\Funcionario;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioUsuario implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    use VerificarPermissoesTrait;

    private $funcionarios;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->funcionarios = $entityManager
            ->getRepository(Funcionario::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->verificarPermissoes([1, 2]);
        $funcionarios = $this->funcionarios->findAll();

        $html = $this->renderizaHtml('Usuarios/formulario.php', [
            'funcionarios' => $funcionarios,
        ]);
        return new Response(200, [], $html);
    }
}
