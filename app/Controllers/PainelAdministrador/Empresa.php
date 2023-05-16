<?php

namespace App\Controllers\PainelAdministrador;

use App\Controllers\BaseController;
use App\Models\EmpresasModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Empresa extends BaseController
{
    public function date()
    {
        $empresa = new EmpresasModel();
        $empresa = $empresa->getEmpresas(session()->get('empresa')['id']);
        helper('session');
        $data = [
            'title' => 'Empresa',
            'empresas' => $empresa,
            'msg' => []
        ];

        $this->exibir($data, 'empresa/cadastro');
    }

    public function exibir($data, $pagina)
    {
        $tipo = session('usuario')['tipo'];

        echo view('backend/templates/html-header', $data);
        if ($tipo):
            echo view('backend/templates/header-' . $tipo, $data);
        else:
            echo view('backend/templates/header', $data);
        endif;
        echo view('backend/admin/' . $pagina, $data);
        echo view('backend/templates/footer');
        echo view('backend/templates/html-footer');
    }

    public function gravar()
    {
        $model = new EmpresasModel();

        helper('form');

        if ($this->validate([
            'descricao' => [
                'label' => 'Nome',
                'rules' => 'required|min_length[3]'],
        ])) {
            $id = $this->request->getVar('id');
            $descricao = $this->request->getVar('descricao');
            $tema = $this->request->getVar('tema');
            $img = $this->request->getFile('logo');

            if (!$img->isValid()) {
                $model->save([
                    'id'        => $id,
                    'descricao' => $descricao,
                    'tema'      => $tema,
                ]);
            }
            else {
                $validacaoImg = $this->validate([
                    'logo' => [
                        'uploaded[logo]',
                        'mime_in[logo,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                        'max_size[logo, 4096]',
                    ]
                ]);

                if ($validacaoImg) {
                    $novoNome = $descricao . '_' . $img->getRandomName();
                    $img->move('img/empresas', $novoNome);

                    $model->save([
                        'id'        => $id,
                        'descricao' => $descricao,
                        'tema'      => $tema,
                        'logo'       => $novoNome,
                    ]);
                }
                else {

                    $data = [
                        'title' => 'Empresa',
                        'empresas' => session()->get('empresa'),
                        'msg' => [
                            'mensagem'   => 'Erro ao validar logo!',
                            'tipo'       => 'danger',
                        ],
                    ];
                }
            }
            $data = [
                'title' => 'Empresa',
                'empresas' => session()->get('empresa'),
                'msg' => [
                    'mensagem'   => 'Empresa atualizada!',
                    'tipo'      => 'success'
                ],
            ];
        }
        else {
            $data = [
                'title' => 'Empresa',
                'empresas' => session()->get('empresa'),
                'msg' => [
                    'mensagem'   => 'Erro ao atualizar empresa!',
                    'tipo'      => 'danger'
                ],
            ];
        }

        return redirect('sistema');
    }

    public function excluir($id = null)
    {
        helper('filesystem');
        $model = new EmpresasModel();
        $img = $model->getEmpresas($id)['logo'];
        delete_files(__DIR__ . 'img/' . $img);

        $model->delete($id);

        return redirect()->to(base_url('sistema'));
    }

    public function editar($id = null)
    {
        $model = new EmpresasModel();
        $data = [
            'title' => 'Editar Empresa',
            'empresa' => session()->get('empresa'),
            'msg' => []
        ];

        if (empty($data['empresa'])) {
            throw new PageNotFoundException('Não é possível encontrar a empresa com id: ' . $id);
        }

        $this->exibir($data, 'empresa/editar-empresa');
    }
}
