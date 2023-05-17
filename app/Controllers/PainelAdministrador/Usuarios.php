<?php

namespace App\Controllers\PainelAdministrador;

use App\Controllers\BaseController;
use App\Database\Migrations\Funcionarios;
use App\Models\FuncionariosModel;
use App\Models\UsuariosModel;

class Usuarios extends BaseController
{
    public function listar()
    {
        $model = new UsuariosModel();

        $data = [
            'title' => 'Usuários',
            'usuarios' => $model->paginate(10),
            'pager' => $model->pager,
            'msg' => ''
        ];

        $this->exibir($data, 'listar-usuarios');
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
        echo view('backend/admin/usuarios/' . $pagina, $data);
        echo view('backend/templates/footer');
        echo view('backend/templates/html-footer');
    }

    public function novo()
    {
        $model = new FuncionariosModel();
        $funcionarios = $model->getFuncionario();
        $model = new UsuariosModel();

        helper('form');

        if ($this->validate([
            'usuario' => [
                'label' => 'Usuários',
                'rules' => 'required|min_length[3]|is_unique[usuarios.usuario]'],
            'senha' => [
                'label' => 'Senha',
                'rules' => 'required|min_length[3]'],
        ])) {
            $usuario = $this->request->getVar('usuario');
            $senha = $this->request->getVar('senha');
            $empresa = session()->get('empresa')['id'];

            $senhaCripto = password_hash($senha, PASSWORD_ARGON2I);

            $model->save([
                'usuario' => $usuario,
                'senha' => $senhaCripto,
                'empresa_id' => $empresa,
            ]);

            $data ['msg'] = [
                    'mensagem' => 'Usuário cadastrado!',
                    'tipo'=> 'success',
            ];
        }
        else {
            $data = [
                'title' => 'Usuários',
                'funcionarios' => $funcionarios,
                'msg' =>
                [
                    'mensagem' => 'Erro ao cadastrar o usuário!',
                    'tipo'=> 'danger',
                    ]
            ];

            $this->exibir($data,'formulario');
            exit();
        }
        $data += [
            'title' => 'Usuários',
            'usuarios' => $model->paginate(10),
            'pager' => $model->pager,
            ];

        $this->exibir($data, 'listar-usuarios');
    }

    public function excluir($id = null)
    {
        $model = new UsuariosModel();
        $model->delete($id);

        return redirect()->to(base_url('admin/usuarios'));
    }

    public function formulario()
    {
        $model = new UsuariosModel();
        $id = $this->request->getGetPost('id');
        $usuario = $model->getUsuarios($id);

        $model = new FuncionariosModel();
        $funcionarios = $model->getFuncionario();

        $title = $usuario ? 'Editar' : 'Novo';

        $data = [
            'title' => $title . ' usuário',
            'usuario' => $usuario,
            'funcionarios' => $funcionarios,
            'msg' => []
        ];

        $this->exibir($data, 'formulario');
    }

    public function editar()
    {
        $model = new UsuariosModel();

        $id = $this->request->getVar('id');

        $data = [
            'senha' => password_hash($this->request->getVar('senha'), PASSWORD_ARGON2I),
        ];

        $model->update($id, $data);

        return redirect()->to(base_url('admin/usuarios'));
    }
}
