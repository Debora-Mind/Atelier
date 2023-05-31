<?php

namespace App\Controllers\Producao;

use App\Controllers\BaseController;
use App\Models\ProdutosModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Kint\Zval\EnumValue;

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

        $this->exibir($data, 'listar-produtos');
    }

    public function remover()
    {
        $model = new ProdutosModel();
        $id = $this->request->getVar('id');
        $model->delete($id);

        return redirect()->to(base_url('producao/produtos'));
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

    private function validarObjeto ($dados, $img, $pdf)
    {
        if ($img){
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
                $img->move('img/' . session()->get('empresa')['nome_fantasia'] .
                    '/produtos/img/' . date('Y/m/d'), $novoNome);
                $dados['img'] = $novoNome;
            }
        }

        if ($pdf) {
            $validar = $this->validate([
                'img' => [
                    'uploaded[pdf]',
                    'ext_in[pdf,pdf]',
                    'max_size[pdf,4096]',
                ]
            ]);
            if ($validar) {
                $novoNome = $pdf->getRandomName();
                $pdf->move('img/' . session()->get('empresa')['nome_fantasia'] .
                    '/produtos/pdf/' . date('Y/m/d'), $novoNome);
                $dados['pdf'] = $novoNome;
            }
        }

        return $dados;
    }
}
