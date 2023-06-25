<?php

namespace App\Controllers\Usuarios;

use App\Controllers\BaseController;
use App\Database\Migrations\Funcionarios;
use App\Models\FuncionariosModel;
use App\Models\UsuariosModel;
use Config\Services;

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
        echo view('backend/usuarios/' . $pagina, $data);
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
            'senha-repetida' => [
                'label' => 'Senha repetida',
                'rules' => 'required|matches[senha]'
            ]
        ])) {
            $usuario = $this->request->getVar('usuario');
            $senha = $this->request->getVar('senha');
            $senhaRepetida = $this->request->getVar('senha-repetida');
            $empresa = session()->get('empresa')['id'];

            if ($senha !== $senhaRepetida) {
                $this->validator->setError('senha-repetida', 'As senhas devem ser iguais');
            }

            $senhaCripto = password_hash($senha, PASSWORD_ARGON2I);

            if ($senha == '') {

                $data = [
                    'title' => 'Usuários',
                    'funcionarios' => $funcionarios,
                    'msg' =>
                        [
                            'mensagem' => 'Usuário salvo com sucesso!',
                            'tipo'=> 'success',
                        ]];
                    $model->save([
                        'usuario' => $usuario,
                        'senha' => $senhaCripto,
                        'empresa_id' => $empresa,
                    ]);
                    $this->exibir($data, 'listar-usuarios');
            }

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
        return redirect('usuarios');
    }

    public function excluir()
    {
        $id = $this->request->getVar('id');
        $model = new UsuariosModel();
        $model->delete($id);

        return redirect('usuarios');
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
        $model = new FuncionariosModel();
        $funcionarios = $model->getFuncionario();
        $model = new UsuariosModel();

        $id = $this->request->getVar('id');
        $data = [
            'usuario' => $this->request->getVar('usuario')
        ];

        $senha = $this->request->getVar('senha');
        $senhaRepetida = $this->request->getVar('senha-repetida');

        $rules['usuario'] = [
            'label' => 'Usuários',
            'rules' => 'required|min_length[3]'
        ];
        if (!empty($senha)):
            $rules['senha'] = [
                    'label' => 'Senha',
                    'rules' => 'required|min_length[3]'];
            $rules['senha-repetida'] = [
                    'label' => 'Senha repetida',
                    'rules' => 'required|matches[senha]'];

            $data['senha'] = password_hash($this->request->getVar('senha'), PASSWORD_ARGON2I);
        endif;

        if($this->validate($rules)) {

            if ($senhaRepetida == null) {
                $this->validator->setError('senha-repetida', 'A senha não pode estar vazia');
            }

            if ($senha != $senhaRepetida) {
                $this->validator->setError('senha-repetida', 'teste');
            }

            $model->update($id, $data);

            return redirect()->to(base_url('usuarios'));
        } else {
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
    }
}
