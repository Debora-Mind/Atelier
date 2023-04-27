<?php

namespace Dam\Atelier\Controller\Modelo\Talao;

use Dam\Atelier\Entity\Empresa\Empresa;
use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Entity\Modelo\Talao\Talao;
use Dam\Atelier\Helper\FlashMessageTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PersistenciaTalao implements RequestHandlerInterface
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
            mb_strtoupper($request->getParsedBody()['modelo-filtro']),
            FILTER_SANITIZE_SPECIAL_CHARS
        );
        $modelo = $this->entityManager->getRepository(Modelo::class)->findBy(['modelo' => $descricaoModelo])[0];

        $producao = filter_var(
            mb_strtoupper($request->getParsedBody()['producao']),
            FILTER_SANITIZE_SPECIAL_CHARS
        );

        $sublote = filter_var(
            $request->getParsedBody()['sublote'],
            FILTER_SANITIZE_NUMBER_INT
        );

        $quantidade = filter_var(
            $request->getParsedBody()['quantidade'],
            FILTER_SANITIZE_NUMBER_INT
        );

        $semana = filter_var(
            $request->getParsedBody()['semana'],
            FILTER_SANITIZE_NUMBER_INT
        );

        $cod_barras = filter_var(
            $request->getParsedBody()['cod-barras'],
            FILTER_SANITIZE_NUMBER_INT
        );

        $nota = filter_var(
            $request->getParsedBody()['nota'],
            FILTER_SANITIZE_NUMBER_INT
        );

        $data_entrada = filter_var(
            $request->getParsedBody()['data-entrada'],
            FILTER_SANITIZE_SPECIAL_CHARS
        );
        $data_entrada = new \DateTime($data_entrada);
        $talao = new Talao();
        $talao->setModelo($modelo)
            ->setProducao($producao)
            ->setSublote($sublote)
            ->setQuantidade($quantidade)
            ->setSemana($semana)
            ->setCodBarras($cod_barras)
            ->setDataEntrada($data_entrada)
            ->setNotaFiscal($nota);

        $id = filter_var(
            $request->getQueryParams()['id'] ?? false,
            FILTER_VALIDATE_INT
        );

        $tipo = 'success';
        if (!is_null($id) && $id !== false) {
            $talao->setId($id);
            $this->entityManager->merge($talao);
            $this->defineMensagem($tipo, 'Talão atualizado com sucesso');
        } else {
            $this->entityManager->persist($talao);
            $this->defineMensagem($tipo, 'Talão inserido com sucesso');
        }

        $this->entityManager->flush();

        return new Response(302, ['Location' => '/novo-talao']);
    }
}
