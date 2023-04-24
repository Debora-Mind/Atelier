<?php

namespace Dam\Atelier\Controller\Empresa;

use Dam\Atelier\Entity\Configuracao\ConfiguracaoGeral;
use Dam\Atelier\Entity\Empresa\Empresa;
use Dam\Atelier\Entity\Usuario\Permissoes;
use Dam\Atelier\Entity\Usuario\Usuario;
use Dam\Atelier\Helper\RenderizadorDeHtmlTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PersistirEmpresa implements RequestHandlerInterface
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
        $empresa = $this->entityManager->getRepository(Empresa::class);
        $empresa = $empresa->find($_SESSION['empresa']);

        $nome = filter_var(
            $request->getParsedBody()['descricao'],
            FILTER_SANITIZE_SPECIAL_CHARS
        );
        $tema = filter_var(
            $request->getParsedBody()['tema'] ?? 'Claro',
            FILTER_SANITIZE_SPECIAL_CHARS
        );

        if (($_FILES['logo']['error'] === UPLOAD_ERR_OK) && ($_FILES['foto']['name'] != "")) {
            $logo = file_get_contents($_FILES['logo']['tmp_name']);
        } else {
            $logo = $empresa->getLogo();
        }

        if ($nome == '') {
            $nome = $empresa->getDescricao();
        }

        $empresa->setDescricao($nome)
            ->setTema($tema)
            ->setLogo($logo);
        $this->entityManager->merge($empresa);

        $tipo = 'success';
        $this->defineMensagem($tipo, 'Empresa atualizada com sucesso');

        $this->entityManager->flush();

        return new Response(302, ['Location' => '/']);
    }
}
