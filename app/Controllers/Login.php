<?php

namespace App\Controllers;

use App\Models\EmpresasModel;
use App\Models\UsuariosModel;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Do-And-Make - Login',
            'msg' => []
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

        $modelEmpresa = new EmpresasModel();
        $empresa = $modelEmpresa->getEmpresas($data['usuarios']['empresa_id']);

        if ($data['usuarios'] && password_verify($senha, $data['usuarios']['senha'])) {
            $sessionData = [
                'usuario' => $data['usuarios'],
                'logged_in' => true,
                'empresa' => $empresa,
            ];

            session()->set($sessionData);

            return redirect()->to(base_url('/sistema'));
        }
        else {
            return redirect()->to(base_url('login'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
