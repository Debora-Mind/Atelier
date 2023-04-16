<?php

namespace Dam\Atelier\Controller\Modelo;

use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Helper\FlashMessageTrait;
use Dam\Atelier\Helper\VerificarPermissoesTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizaSaidaModelo implements RequestHandlerInterface
{
    use FlashMessageTrait;
    use VerificarPermissoesTrait;

    private $repositorioDeModelos;

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repositorioDeModelos = $entityManager
            ->getRepository(Modelo::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->verificarPermissoes([10]);
        $modalSaida = $cod_barras = filter_var(
            $request->getParsedBody()['codigo-barras-saida'],
            FILTER_SANITIZE_NUMBER_INT
        ) ?? null;

        if ($modalSaida) {
            $modelo = $this->verificaExistencia($modalSaida);
            $_SESSION['modelo'] = $modelo->getModelo();
            $_SESSION['quantidade'] = $modelo->getQuantidade();
            $_SESSION['semana'] = $modelo->getSemana();
            $_SESSION['entrada'] = $modelo->getDataEntrada()->format('d/m/Y');
            $modelo->setDataSaida();
            $_SESSION['saida'] = $modelo->getDataSaida();
            $redireciona = '/formulario-saida';
        } else {
            $id = filter_var(
                $request->getQueryParams()['id'] ?? false,
                FILTER_VALIDATE_INT
            );
            $modelo = $this->repositorioDeModelos->findOneBy(['id' => $id]);
            $modelo->setDataSaida();
            $redireciona = '/modelos';
        }

        $tipo = 'success';

        $this->entityManager->merge($modelo);
        $this->defineMensagem($tipo, 'Saída realizada com sucesso');
        $this->entityManager->flush();

        return new Response(302, ['Location' => $redireciona]);
    }

    private function verificaExistencia($modalSaida)
    {
        if ($this->repositorioDeModelos->findOneBy(['cod_barras' => $modalSaida]) !== null) {
            return $this->repositorioDeModelos->findOneBy(['cod_barras' => $modalSaida]);
        }
        $tipo = 'danger';
        $this->defineMensagem($tipo, 'Código de barras não localizado');
        header('Location: /formulario-saida');
        exit();
    }
}
