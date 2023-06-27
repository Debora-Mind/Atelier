<?php

namespace App\Controllers\Producao;

use App\Controllers\BaseController;
use App\Models\EmpresasModel;
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
        $empresaModel = new EmpresasModel;
        $empresa = $empresaModel->getEmpresas(session()->get('empresa')['id']);
        $diasWarning = json_decode($empresa['configuracoes'], true)[1][1];
        $diasDanger = json_decode($empresa['configuracoes'], true)[2][1];

        $data = [
            'title' => 'Talões',
            'taloes' => $model
                ->select('taloes.id as id, p.img as img, p.pdf as pdf, taloes.*, p.xProd as descricao_produto')
                ->join('produtos p', 'taloes.id_produto = p.id')
                ->orderBy('data_saida', 'ASC')
                ->orderBy('data_entrada', 'ASC')
                ->paginate(7),
            'diasWarning' => $diasWarning,
            'diasDanger' => $diasDanger,
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
        $produtos = new ProdutosModel();

        $data = [
            'title' => 'Cadastrar Talão',
            'talao' => $talao,
            'produtos' => $produtos->getProdutos(),
            'msg' => []
        ];

        $this->exibir($data, 'formulario-taloes');
    }

    public function gravar()
    {
        $model = new TaloesModel();
        $produtos = new ProdutosModel();
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
                'produtos' => $produtos->getProdutos(),
                'msg' => [
                    'mensagem'   => 'Erro ao salvar o talão!',
                    'tipo'      => 'danger'
                ],
            ];
            $this->exibir($data, 'formulario-taloes');
            exit();

        }
        return redirect('producao/taloes');
    }

    public function remover()
    {
        $model = new TaloesModel();
        $id = $this->request->getVar('id');
        $model->delete($id);

        return redirect('producao/taloes');
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
