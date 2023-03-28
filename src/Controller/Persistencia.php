<?php

namespace Dam\Atelier\Controller;

use Dam\Atelier\Entity\Modelo;
use Dam\Atelier\Helper\FlashMessageTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Persistencia implements RequestHandlerInterface
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
        $descricaoModelo = filter_var(
            $request->getParsedBody()['modelo'],
            FILTER_SANITIZE_SPECIAL_CHARS
        );

        $producao = filter_var(
            $request->getParsedBody()['producao'],
            FILTER_SANITIZE_NUMBER_INT
        );

        $sublote = filter_var(
            $request->getParsedBody()['sublote'],
            FILTER_SANITIZE_NUMBER_INT
        );

        $quantidade = filter_var(
            $request->getParsedBody()['quantidade'],
            FILTER_SANITIZE_NUMBER_INT
        );

        $valor = filter_var(
            $request->getParsedBody()['valor'],
            FILTER_SANITIZE_NUMBER_FLOAT
        );

        $cod_barras = filter_var(
            $request->getParsedBody()['cod-barras'],
            FILTER_SANITIZE_NUMBER_INT
        );

        $data_entrada = filter_var(
            $request->getParsedBody()['data-entrada'],
            FILTER_SANITIZE_SPECIAL_CHARS
        );
        $data_entrada = new \DateTimeImmutable($data_entrada);

        $modelo = new Modelo();
        $modelo->setModelo($descricaoModelo)
            ->setProducao($producao)
            ->setSublote($sublote)
            ->setQuantidade($quantidade)
            ->setValor($valor)
            ->setCodBarras($cod_barras)
            ->setDataEntrada($data_entrada);

        $id = filter_var(
            $request->getQueryParams()['id'] ?? false,
            FILTER_VALIDATE_INT
        );

        $tipo = 'success';
        if (!is_null($id) && $id !== false) {
            $modelo->setId($id);
            $this->entityManager->merge($modelo);
            $this->defineMensagem($tipo, 'Modelo atualizado com sucesso');
        } else {
            $this->entityManager->persist($modelo);
            $this->defineMensagem($tipo, 'Modelo inserido com sucesso');
        }

        $this->entityManager->flush();

        return new Response(302, ['Location' => '/modelos']);
    }
}
