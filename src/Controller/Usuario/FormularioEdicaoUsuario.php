<?php

namespace Dam\Atelier\Controller\Usuario;

use Dam\Atelier\Entity\Funcionario\Funcionario;
use Dam\Atelier\Entity\Usuario\Usuario;
use Dam\Atelier\Helper\FlashMessageTrait;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioEdicaoUsuario implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait, FlashMessageTrait;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repositorioUsuarios;
    private $funcionarios;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioUsuarios = $entityManager
            ->getRepository(Usuario::class);
        $this->funcionarios = $entityManager
            ->getRepository(Funcionario::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );

        $resposta = new Response(302, ['Location' => '/usuarios']);
        if (is_null($id) || $id === false) {
            $this->defineMensagem('danger', 'ID do usuário inválido');
            return $resposta;
        }

        $usuario = $this->repositorioUsuarios->find($id);
        $funcionarios = $this->funcionarios->findAll();

        $html = $this->renderizaHtml('Usuarios/formulario.php', [
            'usuario' => $usuario,
            'titulo' => 'Alterar usuario ' . $usuario->getUsuario(),
            'funcionarios' => $funcionarios,
        ]);

        return new Response(200, [], $html);
    }
}
