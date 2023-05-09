<?php

namespace App\Controllers\PainelAdministrador;

use App\Controllers\BaseController;
use App\Models\CategoriasModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Categorias extends BaseController
{
    public function index()
    {
        $model = new CategoriasModel();

        $data = [
            'title' => 'Categorias',
            'categorias' => $model->paginate(10),
            'pager' => $model->pager,
            'msg' => ''
        ];

        $this->exibir($data, 'categorias');
    }

    public function exibir($data, $pagina)
    {
        echo view('backend/templates/html-header', $data);
        echo view('backend/templates/header');
        echo view('backend/pages/' . $pagina, $data);
        echo view('backend/templates/footer');
        echo view('backend/templates/html-footer');
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
                'title' => 'Categorias',
                'categorias' => $model->paginate(10),
                'pager' => $model->pager,
                'msg' => 'Categoria cadastrada!'
            ];
        }
        else {

            $data = [
                'title' => 'Categorias',
                'categorias' => $model->paginate(10),
                'pager' => $model->pager,
                'msg' => 'Erro ao cadastrar categoria!'
            ];
        }

        $this->exibir($data, 'categorias');
    }

    public function excluir($id = null)
    {
        $model = new CategoriasModel();
        $model->delete($id);

        return redirect()->to(base_url('admin/categorias'));
    }

    public function editar($id = null)
    {
        $model = new CategoriasModel();
        $data = [
            'title' => 'Editar Categorias',
            'categorias' => $model->getCategoria($id),
            'msg' => ''
        ];

        if (empty($data['categorias'])) {
            throw new PageNotFoundException('Não é possível encontrar a categoria com id: ' . $id);
        }

        $this->exibir($data, 'categorias-editar');
    }
}
