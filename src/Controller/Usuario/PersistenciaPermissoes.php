<?php

namespace Dam\Atelier\Controller\Usuario;

use Dam\Atelier\Entity\Funcionario\Funcionario;
use Dam\Atelier\Entity\Usuario\Permissoes;
use Dam\Atelier\Entity\Usuario\Usuario;
use Dam\Atelier\Helper\FlashMessageTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PersistenciaPermissoes implements RequestHandlerInterface
{
    use FlashMessageTrait;

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = filter_var(
            $request->getQueryParams()['id'] ?? false,
            FILTER_VALIDATE_INT
        );

        $usuario = $this->entityManager->getRepository(Usuario::class)->find($id);
        $permissoes = $this->entityManager->getRepository(Permissoes::class)->findAll();

        $usuario->removePermissoes();

        foreach ($permissoes as $permissao) {
            $name = $permissao->getId();
            if (in_array($permissao->getId(), $_POST['permissao'])) {
                $usuario->addPermissao($name);
            }
        }

        $tipo = 'success';

        if ($usuario === null) {
            $tipo = 'danger';
            $this->defineMensagem($tipo, "Não foi possível localizar o usuário");
            header('Location: /permissoes');
            exit();
        }

        $this->entityManager->merge($usuario);
        $this->defineMensagem($tipo, 'Permissões atualizadas com sucesso');
        $this->entityManager->flush();

        return new Response(302, ['Location' => '/usuarios']);
    }


}
