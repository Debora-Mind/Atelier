<?php

namespace Dam\Atelier\Controller\Configuracao;

use Dam\Atelier\Entity\Configuracao\ConfiguracaoGeral;
use Dam\Atelier\Entity\Usuario\Permissoes;
use Dam\Atelier\Entity\Usuario\Usuario;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SalvarConfiguracoes implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    use VerificarPermissoesTrait;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $configuracoes = $this->entityManager->getRepository(ConfiguracaoGeral::class);
        $repositorios = $configuracoes->findAll();

        foreach ($repositorios as $repositorio) {
            $id = $repositorio->getId();
            $switch = filter_var(
                $request->getParsedBody()['switch' . $id] ?? false,
                FILTER_VALIDATE_BOOL
            );

            $numero = (int) filter_var(
                $request->getParsedBody()['numero' . $id],
                FILTER_SANITIZE_NUMBER_INT
            );

            $config = $configuracoes->find($id);
            $config->setAtivo($switch);
            $config->setNumero($numero);

            $this->entityManager->merge($config);
        }

        $tipo = 'success';
        $this->defineMensagem($tipo, 'Configurações atualizadas com sucesso');

        $this->entityManager->flush();

        return new Response(302, ['Location' => '/']);
    }
}