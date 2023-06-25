<?php

namespace App\Controllers\Producao;

use App\Controllers\BaseController;
use App\Models\ProdutosModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\Response;
use Kint\Zval\EnumValue;
use CodeIgniter\Files\File;


class Produtos extends BaseController
{
    public function listar()
    {
        $model = new ProdutosModel();

        $data = [
            'title' => 'Notas Fiscais',
            'produtos' => $model->paginate(10),
            'pager' => $model->pager,
            'msg' => ''
        ];

        $this->exibir($data, 'listar-produtos');
    }

    public function exibir($data, $pagina = '')
    {
        $tipo = session('usuario')['tipo'];

        echo view('backend/templates/html-header', $data);
        if ($tipo):
            echo view('backend/templates/header-' . $tipo, $data);
        else:
            echo view('backend/templates/header', $data);
        endif;
        echo view('backend/producao/' . $pagina, $data);
        echo view('backend/templates/footer');
        echo view('backend/templates/html-footer');
    }

    public function formulario()
    {
        $id = $this->request->getVar('id');

        $model = new ProdutosModel();
        $produto = $model->getProdutos($id);

        $data = [
            'title' => 'Cadastrar Produto',
            'produto' => $produto,
            'msg' => []
        ];

        $this->exibir($data, 'formulario-produtos');
    }

    public function gravar()
    {
        $model = new ProdutosModel();
        $vars = $this->request->getVar(null, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        helper('form');
        if ($this->validate([
            'cod_fabrica' => [
                'label' => 'Referência da Fabrica',
                'rules' => 'required'],
            'cEAN' => [
                'label' => 'Código de Barras',
                'rules' => 'required'],
        ])) {
            $img = $this->request->getFile('img');
            $pdf = $this->request->getFile('pdf');

            $vars = $this->validarObjeto($vars, $img, $pdf);
            $model->save($vars);

            $data = [
                'title' => 'Produtos',
                'produtos' => $model->paginate(10),
                'pager' => $model->pager,
                'msg' => [
                    'mensagem'   => 'Produto salvo com sucesso!',
                    'tipo'      => 'success'
                ],
            ];
        }
        else {

            $data = [
                'title' => 'Produtos',
                'produto' => $vars,
                'msg' => [
                    'mensagem'   => 'Erro ao salvar o produto!',
                    'tipo'      => 'danger'
                ],
            ];
            $this->exibir($data, 'formulario-produtos');
            exit();

        }
        return redirect('producao/produtos');
    }

    public function remover()
    {
        $model = new ProdutosModel();
        $id = $this->request->getVar('id');
        $model->delete($id);

        return redirect('producao/produtos');
    }

    private function validarObjeto ($dados, $img, $pdf)
    {
        $validar = $this->validate([
            'img' => [
                'uploaded[img]',
                'mime_in[img,image/png,image/jpeg,image/gif,image/webp]',
                'max_size[img,4096]',
                'is_image[img]'
            ]
        ]);

        if ($validar) {
            $novoNome =  $img->getRandomName();
            $caminho = 'img/' . session()->get('empresa')['nome_fantasia'] . '/produtos/img/' . date('Y/m/d');
            $img->move($caminho, $novoNome);
            $dados['img'] = $caminho . '/' . $novoNome;
        }

        $this->validator->reset();

        $validarPdf = $this->validate([
            'pdf' => [
                'uploaded[pdf]',
                'max_size[pdf,4096]',
            ]
        ]);

        if ($validarPdf) {
            $novoNome = $pdf->getRandomName();
            $caminho = 'img/' . session()->get('empresa')['nome_fantasia'] . '/produtos/pdf/' . date('Y/m/d');
            $pdf->move($caminho, $novoNome);
            $dados['pdf'] = $caminho . '/' .  $novoNome;
        }

        return $dados;
    }

    public function visualizarImagem()
    {
        $model = new ProdutosModel();
        $id = $this->request->getVar('id');
        $imagePath = FCPATH . $model->getProdutos($id)['img'];

        if (file_exists($imagePath)) {
            $fileInfo = new \finfo(FILEINFO_MIME_TYPE);
            $contentType = $fileInfo->file($imagePath);

            $this->response->setContentType($contentType);
            $this->response->setBody(file_get_contents($imagePath));

            return $this->response;
        } else {
            echo 'Algo deu errado com a imagem...';
            exit();
        }
    }

    public function visualizarPDF()
    {
        $model = new ProdutosModel();
        $id = $this->request->getVar('id');
        $pdfPath = FCPATH . $model->getProdutos($id)['pdf'];

        if (file_exists($pdfPath)) {
            $fileInfo = new \finfo(FILEINFO_MIME_TYPE);
            $contentType = $fileInfo->file($pdfPath);

            if ($contentType == 'application/pdf') {
                $this->response->setContentType($contentType);
                $this->response->setBody(file_get_contents($pdfPath));

                return $this->response;
            } else {
                echo 'O arquivo não é um PDF válido.';
                exit();
            }
        } else {
            echo 'Algo deu errado com o arquivo PDF...';
            exit();
        }
    }
}
