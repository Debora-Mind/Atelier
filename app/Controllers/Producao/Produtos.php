<?php

namespace App\Controllers\Producao;

use App\Controllers\BaseController;
use App\Models\ProdutosModel;
use CodeIgniter\Exceptions\PageNotFoundException;

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
        $this->exibir($data, 'listar-produtos');
    }

    public function cancelar($id = null)
    {
        $model = new ProdutosModel();
        $model->delete($id);

        return redirect()->to(base_url('listar-produtos'));
    }

    public function editar($id = null)
    {
        $model = new ProdutosModel();
        $data = [
            'title' => 'Editar Notas',
            'produtos' => $model->getProdutos($id),
            'msg' => [
                'mensagem'   => 'Empresa atualizada!',
                'tipo'      => 'success'
            ],
        ];

        if (empty($data['produtos'])) {
            throw new PageNotFoundException('Não é possível encontrar a categoria com id: ' . $id);
        }

        $this->exibir($data, 'producao/produtos');
    }
}
