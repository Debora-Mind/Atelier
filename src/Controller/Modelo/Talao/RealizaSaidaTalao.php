<?php

namespace Dam\Atelier\Controller\Modelo\Talao;

use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Entity\Modelo\Talao\Talao;
use Dam\Atelier\Helper\FlashMessageTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizaSaidaTalao implements RequestHandlerInterface
{
    use FlashMessageTrait;
    use VerificarPermissoesTrait;

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $repositorioTaloes;
    private $repositorioModelos;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioTaloes = $entityManager
            ->getRepository(Talao::class);
        $this->repositorioModelos = $entityManager
            ->getRepository(Modelo::class);
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->verificarPermissoes([10]);
        $modalSaida = $cod_barras = filter_var(
            $request->getParsedBody()['codigo-barras-saida'],
            FILTER_SANITIZE_NUMBER_INT
        ) ?? null;
        $this->verificaSaida($cod_barras);

        if ($modalSaida) {
            $talao = $this->verificaExistencia($modalSaida);
            $_SESSION['modelo'] = $talao->getModelo()->getModelo();
            $_SESSION['quantidade'] = $talao->getQuantidade();
            $_SESSION['semana'] = $talao->getSemana();
            $_SESSION['entrada'] = $talao->getDataEntrada()->format('d/m/Y');
            $talao->setDataSaida();
            $_SESSION['saida'] = $talao->getDataSaida();
            $redireciona = '/formulario-saida';
        } else {
            $id = filter_var(
                $request->getQueryParams()['id'] ?? false,
                FILTER_VALIDATE_INT
            );
            $talao = $this->repositorioTaloes->findOneBy(['id' => $id]);
            $talao->setDataSaida();
            $redireciona = '/taloes';
        }

        $tipo = 'success';

        $this->entityManager->merge($talao);
        $this->defineMensagem($tipo, 'Saída realizada com sucesso');
        $this->entityManager->flush();

        return new Response(302, ['Location' => $redireciona]);
    }

    private function verificaExistencia($modalSaida)
    {
        if ($this->repositorioTaloes->findOneBy(['cod_barras' => $modalSaida]) !== null) {
            return $this->repositorioTaloes->findOneBy(['cod_barras' => $modalSaida]);
        }
        $tipo = 'danger';
        $this->defineMensagem($tipo, 'Código de barras não localizado');
        header('Location: /formulario-saida');
        exit();
    }

    private function verificaSaida($codBarras)
    {
        $taloes = $this->repositorioTaloes
            ->findBy([ 'modelo' => $this->repositorioModelos
            ->findBy(['empresa' => $_SESSION['empresa']])]);
        $codBarrasArray = array_filter(array_map(function($talao) {
            return $talao->getDataSaida() !== null ? $talao->getCodBarras() : null;
        }, $taloes));

        if(in_array($codBarras, $codBarrasArray)) {
            $tipo = 'danger';
            $this->defineMensagem($tipo, 'Saída já realizada neste código de barras');
            header('Location: /formulario-saida');
            exit();
        }
    }
}
