<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Login'
        ];
        echo view('backend/templates/html-header', $data);
        echo view('backend/pages/login');
        echo view('backend/templates/html-footer');
    }

    public function entrar()
    {
        $model = new UsuariosModel();

        $usuario = $this->request->getVar('usuario');
        $senha = $this->request->getVar('senha');

        $data = [
            'usuarios' => $model->getUsuario($usuario)
        ];

        if ($data['usuarios'] && password_verify($senha, $data['usuarios']['senha'])) {
            $sessionData = [
                'user' => $data['usuarios']['user'],
                'logged_in' => true,
            ];

            session()->set($sessionData);

            return redirect()->to(base_url('admin'));
        }
        else {
            return redirect()->to(base_url('login'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
