<?php

namespace App\Controllers\Notas;

use App\Controllers\BaseController;
use App\Models\ClientesModel;
use App\Models\ItensNFeModel;
use App\Models\NFeModel;
use App\Models\ProdutosModel;
use App\Models\StatusModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class NFe extends BaseController
{
    public function listar()
    {
        $model = new NFeModel();

        $data = [
            'title' => 'Notas Fiscais',
            'nfes' => $model->paginate(10),
            'pager' => $model->pager,
            'cliente' => new ClientesModel(),
            'status' => new StatusModel(),
            'msg' => ''
        ];

        $this->exibir($data, 'listar-notas');
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
        echo view('backend/notas/' . $pagina, $data);
        echo view('backend/templates/footer');
        echo view('backend/templates/html-footer');
    }

    public function formulario()
    {
        $model = new ItensNFeModel();
        $nfes = $model->getItensNFe();

        $data = [
            'title' => 'Cadastrar Nota Fiscal',
            'itensNfe' => $nfes,
            'msg' => []
        ];

        $this->exibir($data, 'formulario');
    }

    public function gravar()
    {
        $model = new NFeModel();
        $itemModel = new ItensNFeModel();
        helper('form');

        if ($this->validate([
            'cliente_id' => [
                'label' => 'Cliente',
                'rules' => 'required'],
        ])) {
            $empresa = $this->request->getVar('empresa_id');
            $serie = $this->request->getVar('serie');
            $numeroNfe = $this->request->getVar('numero_nfe');
            $cliente = $this->request->getVar('cliente_id');

            $produtos = $this->request->getVar('produto_id');
            $quantidades = $this->request->getVar('prod_qCom');
            $valores = $this->request->getVar('prod_vProd	');

            $model->save([
                'empresa_id' => $empresa,
                'serie'      => $serie,
                'numero_nfe' => $numeroNfe,
                'cliente_id' => $cliente,
                'tot_vBC' => 1,
                'tot_vICMS' => 1,
                'tot_vICMSDeson' => 1,
                'tot_vFCP' => 1,
                'tot_vBCST' => 1,
                'tot_vST' => 1,
                'tot_vFCPST' => 1,
                'tot_vFCPSTRet' => 1,
                'tot_vProd' => 1,
                'tot_vFrete' => 1,
                'tot_vSeg' => 1,
                'tot_vDesc' => 1,
                'tot_vII' => 1,
                'tot_vIPI' => 1,
                'tot_vIPIDevol' => 1,
                'tot_vPIS' => 1,
                'tot_vCOFINS' => 1,
                'tot_vOutro' => 1,
                'tot_vNF' => 1,
                'tot_vTotTrib' => 1,
                'fat_vDesc' => 1,
                'fat_vLiq' => 1,
                'dup_vDup' => 1,
                'detPag_vPag' => 1,
                'detPag_vTroco' => 1,
            ]);

            // Salvar cada item no banco de dados
            for ($i = 0; $i < count($produtos); $i++) {
                $this->validator->reset();
                if($this->validate([
                    'produto_id' => [
                        'label' => 'Produto',
                        'rules' => 'required',
                    ],
                    'prod_qCom' => [
                        'label' => 'Quantidade do produto',
                        'rules' => 'required',
                    ],
                    'prod_vProd' => [
                        'label' => 'Valor do produto',
                        'rules' => 'required',
                    ]
                ])) {
                    $modelProduto = new ProdutosModel();
                    $produto = $modelProduto->getProdutos($produtos[$i]);
                    $item = [
                        'produto_id' => $produto['id'],
                        'prod_qCom' => $quantidades[$i],
                        'prod_vProd	' => $valores[$i],
                        'nfe_temp_id' => $model->selectMax('id'),
                        'prod_pedido_id' => 1,
                        'prod_qTrib' => $quantidades[$i],
                        'icms_vBC' => $produto['tICMS_cst'],
                        'icms_pICMS' => $produto['tICMS_tpcalc'],
                        'icms_vICMS' => $produto['tICMS_aliq'],
                        'pis_vBC' => $produto['tPIS_cst'],
                        'pis_pPIS' => $produto['tPIS_tpcalc'],
                        'pis_vPIS' => $produto['tPIS_aliq'],
                        'cofins_vBC' => $produto['tCOFINS_cst'],
                        'cofins_pCOFINS' => $produto['tCOFINS_tpcalc'],
                        'cofins_vCOFINS' => $produto['tCOFINS_aliq'],
                        'empresa_id' => session()->get('empresa')['id'],
                    ];

                    // Salvar o item no banco de dados (exemplo)
                    $itemModel->save($item);
                } else {

                    $data = [
                        'title' => 'Notas',
                        'nfes' => $model->paginate(10),
                        'pager' => $model->pager,
                        'msg' => [
                            'mensagem' => 'Erro ao cadastrar a nota!',
                            'tipo'     => 'danger',
                        ]];
                }
            }

            $data = [
                'title' => 'Notas',
                'nfes' => $model->paginate(10),
                'pager' => $model->pager,
                'msg' => [
                    'mensagem' => 'Nota cadastrada!',
                    'tipo'     => 'sucess',
                    ]];
        }
        else {
            $data = [
                'title' => 'Notas',
                'nfes' => $model->paginate(10),
                'pager' => $model->pager,
                'msg' => [
                    'mensagem' => 'Erro ao cadastrar a nota!',
                    'tipo'     => 'danger',
            ]];
        }

        $this->exibir($data);
    }

    public function cancelar($id = null)
    {
        $model = new CategoriasModel();
        $model->delete($id);

        return redirect()->to(base_url('admin/categorias'));
    }

    public function editar($id = null)
    {
        $model = new CategoriasModel();
        $data = [
            'title' => 'Editar Notas',
            'categorias' => $model->getCategoria($id),
            'msg' => ''
        ];

        if (empty($data['categorias'])) {
            throw new PageNotFoundException('Não é possível encontrar a categoria com id: ' . $id);
        }

        $this->exibir($data, 'categorias-editar');
    }
}
