<?php

namespace App\Controllers;

use App\Models\EmpresasModel;
use App\Models\UsuariosModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use http\Env\Response;

class Login extends ResourceController
{
    public function login(): ResponseInterface
    {
        $usuarios = new UsuariosModel();

        $rules['usuario'] = [
                'label' => 'Usuário',
                'rules' => 'required'];
        $rules['senha'] = [
                'label' => 'Senha',
                'rules' =>'required'];

        $vars = json_decode($this->request->getBody(), true);

		$data = $usuarios->getBy('usuario' ,$vars['usuario']);

        if ($this->validate($rules) && $data) {
            $empresas = new EmpresasModel();
            $empresa = $empresas->get(1);

            if (password_verify($vars['senha'], $data['senha'])) {

                $sessionData = [
                    'logado' => true,
                    'usuario' => $data['id'],
                    'empresa' => $empresa,
					'dados' => $data
                ];

                return $this->respond([
                    'mensagem' => 'Logado com sucesso!',
                    'session'    => $sessionData,
                ]);
            }
        }

        $this->validator->setError('usuario', 'Usuário ou senha inválido...');
        return $this->respond([
            'erroValidacao' => $this->validator->getErrors(),
			'dados' => $data

		]);
    }
}
