<?php

namespace App\Controllers\PainelAdministrador;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;

class Usuarios extends BaseController
{
    public function list()
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

    public function exibir($data, $pagina)
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

    public function gravar()
    {
        $model = new UsuariosModel();

        helper('form');

        if ($this->validate([
            'usuario' => [
                'label' => 'Usuários',
                'rules' => 'required|min_length[3]|is_unique[usuarios.user]'],
            'senha' => [
                'label' => 'Senha',
                'rules' => 'required|min_length[3]'],
        ])) {
            $usuario = $this->request->getVar('usuario');
            $senha = $this->request->getVar('senha');

            $senhaCripto = password_hash($senha, PASSWORD_ARGON2I);

            $model->save([
                'user' => $usuario,
                'senha' => $senhaCripto,
            ]);
            $data = [
                'title' => 'Usuários',
                'usuarios' => $model->paginate(10),
                'pager' => $model->pager,
                'msg' => 'Usuário cadastrado!'
            ];
        }
        else {

            $data = [
                'title' => 'Usuários',
                'usuarios' => $model->paginate(10),
                'pager' => $model->pager,
                'msg' => 'Erro ao cadastrar o usuário!'
            ];
        }

        $this->exibir($data);
    }

    public function excluir($id = null)
    {
        $model = new UsuariosModel();
        $model->delete($id);

        return redirect()->to(base_url('admin/usuarios'));
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
