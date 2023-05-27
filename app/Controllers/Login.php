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

        $rules['usuario'] = [
                'label' => 'Usuário',
                'rules' => 'required'];
        $rules['senha'] = [
                'label' => 'Senha',
                'rules' =>'required'];

        $data['usuarios'] = $model->getUsuario($usuario);

        if ($this->validate($rules) && $data['usuarios']) {
            $modelEmpresa = new EmpresasModel();
            $empresa = $modelEmpresa->getEmpresas($data['usuarios']['empresa_id']);

            if (password_verify($senha, $data['usuarios']['senha'])) {
                $sessionData = [
                    'usuario' => $data['usuarios'],
                    'logged_in' => true,
                    'empresa' => $empresa,
                ];

                session()->set($sessionData);

                return redirect()->to(base_url('/sistema'));
            }
        }

        $this->validator->setError('usuario', 'Usuário ou senha inválido...');
        return redirect()->to(base_url('/'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
