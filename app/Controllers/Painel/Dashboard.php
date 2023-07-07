<?php

namespace App\Controllers\Painel;

use App\Controllers\BaseController;
use App\Models\ClientesModel;
use App\Models\ConfiguracoesModel;
use App\Models\EmpresasModel;
use App\Models\MunicipiosModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Dashboard extends BaseController
{
    public function index()
    {
        $empresa = new EmpresasModel();
        $empresa = $empresa->getEmpresas(session()->get('empresa')['id']);
        $modelMunicipios = new MunicipiosModel();
        $configuracoes = new ConfiguracoesModel();
        $empresa['configuracoes'] = json_decode($empresa['configuracoes'], true);

        helper('session');
        $data = [
            'title' => 'Empresa',
            'empresas' => $empresa,
            'municipios' => $modelMunicipios->getMunicipios(),
            'configuracoes' => $configuracoes->getConfiguracoes(),
            'msg' => []
        ];

        $this->exibir($data, 'graficos');
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
        echo view('backend/painel/' . $pagina, $data);
        echo view('backend/templates/footer');
        echo view('backend/templates/html-footer');
    }

    public function gravar()
    {
        $model = new EmpresasModel();
        $modelMunicipios = new MunicipiosModel();
        $modelConfiguracoes = new ConfiguracoesModel();
        $configuracoes = $modelConfiguracoes->getConfiguracoes();

        helper('form');

        if ($this->validate([
            'nome_fantasia' => [
                'label' => 'Nome Fantasia',
                'rules' => 'required|min_length[3]'
            ]
        ])) {
            $vars = $this->request->getVar(null, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $vars['codMun'] = $modelMunicipios->getMunicipiosDescricao($vars['municipio'])['ibge'];

            $configuracoesData = [];

            foreach ($configuracoes as $configuracao) {
                $configuracoesData[$configuracao['id']] = [
                    $vars['switch'][$configuracao['id']],
                    $vars['numero'][$configuracao['id']]
                ];
            }

            $configuracoesJson = json_encode($configuracoesData);
            $vars['configuracoes'] = $configuracoesJson;

            unset($vars['switch']);
            unset($vars['numero']);

            $model->save($vars);


            $img = $this->request->getFile('logomarca');
            $certificado = $this->request->getFile('certificado_a3');

            $vars = $this->validarObjeto($vars, $img, $certificado);

            // Salvar os outros dados da empresa
            $model->save($vars);

            $data = [
                'title' => 'Empresa',
                'empresas' => session()->get('empresa'),
                'msg' => [
                    'mensagem' => 'Empresa atualizada!',
                    'tipo' => 'success'
                ],
            ];
        } else {
            $data = [
                'title' => 'Empresa',
                'empresas' => session()->get('empresa'),
                'msg' => [
                    'mensagem' => 'Erro ao atualizar empresa!',
                    'tipo' => 'danger'
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

        return redirect('sistema');
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

        $this->exibir($data, 'editar-empresa');
    }

    public function listarClientes()
    {
        $model = new ClientesModel();

        helper('session');

        $data = [
            'title' => 'Clientes',
            'clientes' => $model->paginate(10),
            'pager' => $model->pager,
            'msg' => []
        ];

        $this->exibir($data, 'listar-clientes');
    }

    public function formularioCliente()
    {
        $id = $this->request->getVar('id');

        $model = new ClientesModel();
        $cliente = $model->getClientes($id);
        $modelMunicipios = new MunicipiosModel();

        $data = [
            'title' => 'Cadastrar Cliente',
            'cliente' => $cliente,
            'municipios' => $modelMunicipios->getMunicipios(),
            'msg' => []
        ];

        $this->exibir($data, 'formulario-cliente');
    }

    public function gravarCliente()
    {
        $model = new ClientesModel();
        $modelMunicipios = new MunicipiosModel();

        $vars = $this->request->getVar(null, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vars['cMun'] = $modelMunicipios->getMunicipiosDescricao($vars['cidade'])['ibge'];

        helper('form');
        if ($this->validate([
            'nome_razao_social' => [
                'label' => 'Nome/Razão Social',
                'rules' => 'required'],
            'cpf_cnpj' => [
                'label' => 'CPF/CNPJ',
                'rules' => 'required'],
        ])) {
            $model->save($vars);

            $data = [
                'title' => 'Clientes',
                'clientes' => $model->paginate(10),
                'pager' => $model->pager,
                'msg' => [
                    'mensagem'   => 'Cliente salvo com sucesso!',
                    'tipo'      => 'success'
                ],
            ];
        }
        else {

            $data = [
                'title' => 'Clientes',
                'cliente' => $vars,
                'msg' => [
                    'mensagem'   => 'Erro ao salvar o cliente!',
                    'tipo'      => 'danger'
                ],
            ];
            $this->exibir($data, 'formulario-cliente');
            exit();

        }
        return redirect('empresa/clientes');
    }

    public function editarCliente()
    {
        $model = new ClientesModel();
        $id = $this->request->getVar('id');
        $modelMunicipios = new MunicipiosModel();

        $data = [
            'title' => 'Editar Cliente',
            'cliente' => $model->getClientes($id),
            'municipios' => $modelMunicipios->getMunicipios(),
            'msg' => []
        ];

        if (empty($data['cliente'])) {
            throw new PageNotFoundException('Não é possível encontrar o cliente com id: ' . $id);
        }

        $this->exibir($data, 'formulario-cliente');
    }

    public function removerCliente()
    {
        $model = new ClientesModel();
        $id = $this->request->getVar('id');
        $model->delete($id);

        return redirect('empresa/clientes');
    }

    private function validarObjeto ($dados, $img, $certificado)
    {
        $this->validator->reset();
        $validar = $this->validate([
            'logomarca' => [
                'uploaded[logomarca]',
                'mime_in[logomarca,image/png,image/jpeg,image/gif,image/webp]',
                'max_size[logomarca,4096]',
                'is_image[logomarca]'
            ]
        ]);

        if ($validar) {
            $novoNome =  'logo_' . $img->getRandomName();
            $caminho = 'img/' . session()->get('empresa')['nome_fantasia'] . '/logo/';
            $img->move($caminho, $novoNome);

            $dados['logomarca'] = $caminho . $novoNome;
        }

        $this->validator->reset();
        $validarCertificado = $this->validate([
            'pdf' => [
                'uploaded[certificado_a3]',
                'max_size[certificado_a3,4096]',
            ]
        ]);

        if ($validarCertificado) {
            $novoNome = $certificado->getRandomName();
            $caminho = 'img/' . session()->get('empresa')['nome_fantasia'] . '/certificados/';
            $certificado->move($caminho, $novoNome);

            $dados['certificado_a3'] = $caminho .  $novoNome;
        }

        return $dados;
    }
}
