<?php

namespace App\Controllers;

use App\Models\EmpresasModel;
use App\Models\UsuariosModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Login extends ResourceController
{
    public function login(): ResponseInterface
    {
        try {
            $model = new UsuariosModel();

            $rules = [
                'usuario' => [
                    'label' => 'Usuário',
                    'rules' => 'required',
                ],
                'senha' => [
                    'label' => 'Senha',
                    'rules' => 'required',
                ],
            ];

            $vars = json_decode($this->request->getBody(), true);

            if (!$this->validate($rules)) {
                // Se a validação falhar, lançar uma exceção com os erros de validação
                throw new \Exception(json_encode($this->validator->getErrors()));
            }

            $data = $model->getUsuario($vars['usuario']);

            if (!$data || !password_verify($vars['senha'], $data['senha'])) {
                // Se não houver correspondência de usuário ou a senha estiver incorreta, lançar uma exceção com uma mensagem de erro
                throw new \Exception('Usuário ou senha inválido');
            }

            $modelEmpresa = new EmpresasModel();
            $empresa = $modelEmpresa->getEmpresas($data['empresa_id']);

            $sessionData = [
                'logado' => true,
                'usuario' => $data['id'],
                'empresa' => $empresa['id'],
            ];

            return $this->respond([
                'mensagem' => 'Logado com sucesso!',
                'session' => $sessionData,
            ]);
        } catch (\Exception $e) {
            // Capturar a exceção e retornar uma resposta de erro
            return $this->respond([
                'erro' => $e->getMessage(),
            ], ResponseInterface::HTTP_BAD_REQUEST); // Você pode escolher um código de status HTTP apropriado para erros aqui
        }
    }
}
