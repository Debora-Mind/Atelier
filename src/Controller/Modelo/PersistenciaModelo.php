<?php

namespace Dam\Atelier\Controller\Modelo;

use Dam\Atelier\Entity\Empresa\Empresa;
use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Helper\FlashMessageTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Nyholm\Psr7\UploadedFile;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PersistenciaModelo implements RequestHandlerInterface
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
        $modelo = new Modelo();

        $id = filter_var($request->getQueryParams()['id'] ?? null,
            FILTER_VALIDATE_INT);
        $modelo = $id
            ? $this->entityManager->getRepository(Modelo::class)
                    ->find($request->getQueryParams()['id'])
            : new Modelo();

        $descricaoModelo = filter_var(
            $request->getParsedBody()['modelo-filtro'],
            FILTER_SANITIZE_SPECIAL_CHARS
        );

        $valorEntrada = $_POST['valor-entrada'];
        $valorEntrada = preg_replace('/[^0-9.,]/', '', $valorEntrada);
        $valorEntrada = filter_var($valorEntrada, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        $valorSaida = $_POST['valor-saida'];
        $valorSaida = preg_replace('/[^0-9.,]/', '', $valorSaida);
        $valorSaida = filter_var($valorSaida, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        if (($_FILES['foto']['error'] === UPLOAD_ERR_OK) && ($_FILES['foto']['name'] != "")) {
            $allowedExtensions = ['png', 'jpg', 'jpeg', 'svg'];
            $nomeArquivo = $_FILES['foto']['name'];
            $extension = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
            if (!in_array($extension, $allowedExtensions)) {
                $this->defineMensagem('danger', 'Apenas arquivos PNG, JPG, JPEG e SVG são permitidos');
                header('location: ' . $_SESSION['pagina_anterior']);
                exit();
            }
            $foto = file_get_contents($_FILES['foto']['tmp_name']);
        } else {
            $foto = $modelo->getImagemModelo();
        }

        if ($_FILES['roteiro']['error'] === UPLOAD_ERR_OK && (!empty($_FILES['roteiro']))) {
            $allowedExtensions = ['pdf'];
            $nomeArquivo = $_FILES['roteiro']['name'];
            $extension = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
            if (!in_array($extension, $allowedExtensions)) {
                $this->defineMensagem('danger', 'Apenas arquivos PDF são permitidos');
                header('location: ' . $_SESSION['pagina_anterior']);
                exit();
            }
            $roteiro = file_get_contents($_FILES['roteiro']['tmp_name']);
        } else {
            $roteiro = $modelo->getRoteiro();
        }

        $empresa = $this->entityManager->getRepository(Empresa::class)->find($_SESSION['empresa']);

        $modelo->setModelo($descricaoModelo)
            ->setValorEntrada($valorEntrada)
            ->setValorSaida($valorSaida)
            ->setEmpresa($empresa)
            ->setImagemModelo($foto)
            ->setRoteiro($roteiro);

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
