<?php

namespace Dam\Atelier\Controller\Usuario;

use Dam\Atelier\Entity\Empresa\Empresa;
use Dam\Atelier\Entity\Usuario\Usuario;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Dam\Atelier\Model\Funcionarios\BuscarFuncionarios;
use Dam\Atelier\Model\Funcoes\BuscarFuncoes;
use Dam\Atelier\Model\Usuario\BuscarUsuarios;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListarUsuarios implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    use VerificarPermissoesTrait;

    private $entityManager;
    private $usuarios;
    private $funcoes;
    private $funcionarios;
    private $empresa;


    public function __construct(EntityManagerInterface $entityManager,
                                BuscarUsuarios $usuarios,
                                BuscarFuncoes $funcoes,
                                BuscarFuncionarios $funcionarios)
    {
        $this->entityManager = $entityManager;
        $this->usuarios = $usuarios;
        $this->funcoes = $funcoes;
        $this->funcionarios = $funcionarios;
        $this->empresa = $entityManager->getRepository(Empresa::class)->find($_SESSION['empresa']);

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->verificarPermissoes([1]);
        $usuarios = $this->obterLista($request);
        $html = $this->renderizarTemplate($usuarios);

        return new Response(200, [], $html);
    }

    private function tratarBusca(ServerRequestInterface $request): string
    {
        $parsedBody = $request->getParsedBody();
        $busca = $parsedBody['busca'] ?? '';
        return filter_var($busca, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    private function obterLista($request)
    {
        if (isset($_GET['pagina'])) {
            return $_SESSION['itens'];
        }
        $busca = $this->tratarBusca($request);
        $usuarios = $this->entityManager->getRepository(Usuario::class)
            ->findBy(['empresa' => $_SESSION['empresa']], ['usuario' => 'ASC']);

        if (!empty($busca)) {
            $usuarios = $this->usuarios->buscar($usuarios, $busca, 'usuario');
        }

        $_SESSION['itens'] = $usuarios;
        
        return $usuarios;
    }

    private function renderizarTemplate(mixed $usuarios): string
    {
        return $this->renderizaHtml('Usuarios/listar-usuarios.php', [
            'usuarios' => $usuarios,
            'funcoes' => $this->funcoes
        ]);
    }
}
