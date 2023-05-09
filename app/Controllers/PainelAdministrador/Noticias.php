<?php

namespace App\Controllers\PainelAdministrador;

use App\Controllers\BaseController;
use App\Models\CategoriasModel;
use App\Models\NoticiasModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Noticias extends BaseController
{
    public function index()
    {
        $model = new NoticiasModel();
        $model2 = new CategoriasModel();

        $data = [
            'title' => 'Notícias',
            'categorias' => $model2->getCategoria(),
            'noticias' => $model->paginate(10),
            'pager' => $model->pager,
            'msg' => [
                'mensagem' => '',
                'tipoMsg' => '',
            ],
        ];

        $this->exibir($data, 'noticias');
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
        $model = new NoticiasModel();
        $model2 = new CategoriasModel();

        helper('form');

        if ($this->validate([
            'titulo' => [
                'label' => 'Título',
                'rules' => 'required|min_length[3]'],
            'resumo' => [
                'label' => 'Resumo',
                'rules' => 'required|min_length[3]'],
            'conteudo' => [
                'label' => 'Conteúdo',
                'rules' => 'required|min_length[3]'],
            'categoria' => [
                'label' => 'Categoria',
                'rules' => 'required'],
        ])) {
            $id = $this->request->getVar('id');
            $categoria = $this->request->getVar('categoria');
            $destaque = $this->request->getVar('destaque');
            $titulo = $this->request->getVar('titulo');
            $resumo = $this->request->getVar('resumo');
            $conteudo = $this->request->getVar('conteudo');
            $img = $this->request->getFile('img');

            if (!$img->isValid()) {
                $model->save([
                    'id'        => $id,
                    'destaque'  => $destaque,
                    'titulo'    => $titulo,
                    'cat'       => $categoria,
                    'resumo'    => $resumo,
                    'conteudo'  => $conteudo,
                ]);

                $data = [
                    'title' => 'Notícias',
                    'categorias' => $model2->getCategoria(),
                    'noticias' => $model->paginate(10),
                    'pager' => $model->pager,
                    'msg' => 'Noticia cadastrada!'
                ];
            }
            else {
                $validacaoImg = $this->validate([
                    'img' => [
                        'uploaded[img]',
                        'mime_in[img,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                        'max_size[img, 4096]',
                    ]
                ]);

                if ($validacaoImg) {
                    $novoNome = $img->getRandomName();
                    $img->move('img/noticias', $novoNome);

                    $model->save([
                        'id'        => $id,
                        'destaque'  => $destaque,
                        'titulo'    => $titulo,
                        'cat'       => $categoria,
                        'resumo'    => $resumo,
                        'conteudo'  => $conteudo,
                        'img'       => $novoNome,
                    ]);

                    $data = [
                        'title' => 'Notícias',
                        'categorias' => $model2->getCategoria(),
                        'noticias' => $model->paginate(10),
                        'pager' => $model->pager,
                        'msg' => 'Noticia cadastrada!'
                    ];
                }
                else {

                    $data = [
                        'title' => 'Notícias',
                        'categorias' => $model2->getCategoria(),
                        'noticias' => $model->paginate(10),
                        'pager' => $model->pager,
                        'msg' => 'Noticia cadastrada!'
                    ];
                }
            }
        }

        $this->exibir($data, 'noticias');
    }

    public function excluir($id = null)
    {
        $model = new NoticiasModel();
        $model->delete($id);

        return redirect()->to(base_url('admin/noticias'));
    }

    public function editar($id = null)
    {
        $model = new NoticiasModel();
        $model2 = new CategoriasModel();

        $data = [
            'title' => 'Notícias',
            'categorias' => $model2->getCategoria(),
            'noticias' => $model->getNoticias($id),
            'msg' => ''
        ];

        if (empty($data['noticias'])) {
            throw new PageNotFoundException('Não é possível encontrar a noticia com id: ' . $id);
        }

        $this->exibir($data, 'noticias-editar');
    }
}
