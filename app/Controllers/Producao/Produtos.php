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
        $model = new ItensNFeModel();
        $nfes = $model->getItensNFe();

        $data = [
            'title' => 'Cadastrar Nota Fiscal',
            'itensNfe' => $nfes,
            'msg' => []
        ];

        $this->exibir($data, 'formulario');
    }

    public function gravar()
    {
        $model = new CategoriasModel();

        helper('form');

        if ($this->validate([
            'titulo' => [
                'label' => 'Título',
                'rules' => 'required|min_length[3]'],
            'resumo' => [
                'label' => 'Resumo',
                'rules' => 'required|min_length[3]'],
        ])) {
            $id = $this->request->getVar('id');
            $titulo = $this->request->getVar('titulo');
            $resumo = $this->request->getVar('resumo');

            $model->save([
                'id'     => $id,
                'titulo' => $titulo,
                'resumo' => $resumo,
            ]);
            $data = [
                'title' => 'Notas',
                'categorias' => $model->paginate(10),
                'pager' => $model->pager,
                'msg' => 'Categoria cadastrada!'
            ];
        }
        else {

            $data = [
                'title' => 'Notas',
                'categorias' => $model->paginate(10),
                'pager' => $model->pager,
                'msg' => 'Erro ao cadastrar categoria!'
            ];
        }

        $this->exibir($data, 'categorias');
    }

    public function cancelar($id = null)
    {
        $model = new CategoriasModel();
        $model->delete($id);

        return redirect()->to(base_url('admin/categorias'));
    }

    public function editar($id = null)
    {
        $model = new CategoriasModel();
        $data = [
            'title' => 'Editar Notas',
            'categorias' => $model->getCategoria($id),
            'msg' => ''
        ];

        if (empty($data['categorias'])) {
            throw new PageNotFoundException('Não é possível encontrar a categoria com id: ' . $id);
        }

        $this->exibir($data, 'categorias-editar');
    }
}
