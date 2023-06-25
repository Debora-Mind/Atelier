<?php

namespace App\Controllers\Producao;

use App\Controllers\BaseController;
use App\Models\ProdutosModel;
use App\Models\TaloesModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\Response;
use CodeIgniter\I18n\Time;
use Kint\Zval\EnumValue;
use CodeIgniter\Files\File;


class Taloes extends BaseController
{
    public function listar()
    {
        $model = new TaloesModel();

        $data = [
            'title' => 'Talões',
            'taloes' => $model->paginate(7),
            'pager' => $model->pager,
            'msg' => ''
        ];

        $this->exibir($data, 'listar-taloes');
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

        $model = new TaloesModel();
        $talao = $model->getTaloes($id);

        $data = [
            'title' => 'Cadastrar Talão',
            'talao' => $talao,
            'msg' => []
        ];

        $this->exibir($data, 'formulario-taloes');
    }

    public function gravar()
    {
        $model = new TaloesModel();
        $vars = $this->request->getVar(null, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        helper('form');
        if ($this->validate([
            'id_produto' => [
                'label' => 'Referência da Fabrica',
                'rules' => 'required'],
            'quantidade' => [
                'label' => 'Código de Barras',
                'rules' => 'required'],
            'data_entrada' => [
                'label' => 'Data de Entrada',
                'rules' => 'required'],
        ])) {
            $model->save($vars);
            $data = [
                'title' => 'Talões',
                'taloes' => $model->paginate(10),
                'pager' => $model->pager,
                'msg' => [
                    'mensagem'   => 'Talão salvo com sucesso!',
                    'tipo'      => 'success'
                ],
            ];
        }
        else {
            $data = [
                'title' => 'Talões',
                'talao' => $vars,
                'msg' => [
                    'mensagem'   => 'Erro ao salvar o talão!',
                    'tipo'      => 'danger'
                ],
            ];
            $this->exibir($data, 'formulario-taloes');
            exit();

        }

        $this->exibir($data, 'listar-taloes');
    }

    public function remover()
    {
        $model = new TaloesModel();
        $id = $this->request->getVar('id');
        $model->delete($id);

        return redirect()->to(base_url('producao/listar-taloes'));
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
