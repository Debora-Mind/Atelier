<?php

namespace Dam\Atelier\Controller\Funcao;

use Dam\Atelier\Entity\Funcionario\Funcao;
use Dam\Atelier\Entity\Funcionario\Funcionario;
use Dam\Atelier\Entity\Usuario\Usuario;
use Dam\Atelier\Helper\FlashMessageTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PersistirFuncao implements RequestHandlerInterface
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
        $funcao = filter_var(
            $request->getParsedBody()['funcao'],
            FILTER_SANITIZE_SPECIAL_CHARS
        );

        $novaFuncao = new Funcao();
        $novaFuncao->setDescricao($funcao);

        $id = filter_var(
            $request->getQueryParams()['id'] ?? false,
            FILTER_VALIDATE_INT
        );

        $_SESSION['funcao'] = $funcao;

        $tipo = 'success';

        if ($funcao === "") {
            $tipo = 'danger';
            $this->defineMensagem($tipo, "O campo 'Função' é obrigatório");
            header('Location: /nova-funcao');
            exit();
        } elseif (!is_null($id) && $id !== false) {
            $novaFuncao->setId($id);
            $this->entityManager->merge($novaFuncao);
            $this->defineMensagem($tipo, 'Função atualizada com sucesso');
        } else {
            $this->entityManager->persist($novaFuncao);
            $this->defineMensagem($tipo, 'Função inserida com sucesso');
        }

        $this->entityManager->flush();

        unset($_SESSION['funcao']);

        return new Response(302, ['Location' => '/funcoes']);
    }
}
