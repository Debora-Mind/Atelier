<?php

namespace Dam\Atelier\Controller;

use Dam\Atelier\Entity\Funcionario\Funcionario;
use Dam\Atelier\Entity\Usuario\Permissoes;
use Dam\Atelier\Entity\Usuario\PermissoesUsuario;
use Dam\Atelier\Entity\Usuario\Usuario;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioPermissoes implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    private $permissoes;
    private $usuario;

    public function __construct(EntityManagerInterface $entityManager)
{
    $this->permissoes = $entityManager
        ->getRepository(Permissoes::class);
    $this->usuario = $entityManager
        ->getRepository(Usuario::class);
}

    public function handle(ServerRequestInterface $request): ResponseInterface
{
    $id = filter_var(
        $request->getQueryParams()['id'],
        FILTER_VALIDATE_INT
    );

    $permissoes = $this->permissoes->findAll();
    $usuario = $this->usuario->find($id);

    $html = $this->renderizaHtml('Usuarios/permissoes.php', [
        'permissoes' => $permissoes,
        'usuario' => $usuario,
    ]);
    return new Response(200, [], $html);
}
}
