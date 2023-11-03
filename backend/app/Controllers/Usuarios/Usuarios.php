<?php

namespace App\Controllers\Usuarios;

use App\Controllers\BaseController;
use App\Database\Migrations\Funcionarios;
use App\Models\FuncionariosModel;
use App\Models\UsuariosModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use http\Env\Response;
use function Amp\Iterator\toArray;
use CodeIgniter\HTTP\IncomingRequest;


class Usuarios extends ResourceController
{

    public function listar(): ResponseInterface
    {

        $model = new UsuariosModel();

        return $this->respond([
            'usuarios' => $model->getUsuarios(),
        ]);
    }

    public function novo(): ResponseInterface
    {
        $model = new UsuariosModel();

        helper('form');

        if ($this->validate([
            'usuario' => [
                'label' => 'Usuários',
                'rules' => 'required|min_length[3]|is_unique[usuarios.usuario]'],
            'senha' => [
                'label' => 'Senha',
                'rules' => 'required|min_length[3]'],
            'senhaRepetida' => [
                'label' => 'Senha repetida',
                'rules' => 'required'
            ]
        ])) {
            $vars = json_decode($this->request->getBody(), true);

            if ($vars['senha'] !== $vars['senhaRepetida']) {
                $this->validator->setError('senhaRepetida', 'As senhas devem ser iguais');
                return $this->respond([
                    'tipo' => 'danger',
                    'titulo' => 'Falta algo...',
                    'mensagem' => 'Preencha todas as informações corretamente.',
                    'erroValidacao' => $this->validator->getErrors()
                ]);
            }
            $vars['senha'] = password_hash($vars['senha'], PASSWORD_ARGON2I);

            if ($vars['senha'] == '') {

                $model->add($vars);
                return $this->respond([
                    'tipo'=> 'success',
                    'titulo' => 'Tudo certo!',
                    'mensagem' => 'Usuário salvo com sucesso!',
                ]);
            }
            if (!$vars['funcionario']) {
                unset($vars['funcionario']);
            }

			// Verifique a unicidade do usuário
			if (!$model->verificarUnicidade('usuario', $vars['usuario'])) {
				$this->validator->setError('usuario', 'Este usuário já existe.');
				return $this->respond([
					'tipo' => 'danger',
					'titulo' => 'Usuário já existe',
					'mensagem' => 'O usuário já existe na base de dados.',
					'erroValidacao' => $this->validator->getErrors(),
				]);
			}

            $model->add($vars);

            return $this->respond([
                'tipo'=> 'success',
                'titulo' => 'Tudo certo!',
                'mensagem' => 'Usuário cadastrado com sucesso!',
            ]);
        }

        else {
            return $this->respond([
                'tipo' => 'danger',
                'titulo' => 'Falta algo...',
                'mensagem' => 'Preencha todas as informações corretamente.',
                'erroValidacao' => $this->validator->getErrors()
            ]);
        }
    }

	public function excluir(): ResponseInterface
    {
		$id = $this->request->getGet('id');

        $model = new UsuariosModel();
		try {
			$model->delete($id);
			return $this->respond([
				'tipo' => 'success',
				'titulo' => 'Tudo certo!',
				'mensagem' => 'Usuário excluído com sucesso!',
			]);
		} catch (\Error $e) {
			return $this->respond([
				'tipo' => 'danger',
				'titulo' => 'Algo deu errado...',
				'mensagem' => $e->getMessage()
			]);
		}

    }

    public function formulario(): ResponseInterface
    {
        $model = new UsuariosModel();
		$id = $this->request->getGet('id');
        $usuario = $model->getId($id);

        return $this->respond([
            'usuario' => $usuario
        ]);
    }

	public function buscarId(): ResponseInterface
    {
        $model = new UsuariosModel();
		$id = $this->request->getGet('id');
        $usuario = $model->getId($id);

        return $this->respond([
            'usuario' => $usuario
        ]);
    }

    public function buscar():ResponseInterface
    {
        $model = new UsuariosModel();
        $busca = json_decode($this->request->getBody(), true);

        return $this->respond([
            'usuarios' => $model->select('id, usuario')->like('usuario', $busca)->findAll(),
        ]);
    }
}
