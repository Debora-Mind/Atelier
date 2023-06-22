<?php

namespace App\Controllers\Notas;

use App\Controllers\BaseController;
use App\Models\ClientesModel;
use App\Models\ItensNFeModel;
use App\Models\MunicipiosModel;
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
            'nfes' => $model->orderBy('created_at', 'DESC')->paginate(5),
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
        $id = $this->request->getGet('id');
        $model = new NFeModel();
        $nfes = $model->getNFe($id);

        $modelProdutos = new ItensNFeModel();
        $produtosNota = $modelProdutos->getItensNFeNota($id) ?? [];

        $data = [
            'title' => 'Cadastrar Nota Fiscal',
            'nfe' => $nfes,
            'produtosNota' => $produtosNota,
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
            $vars = $this->request->getVar();

            $produtos = $this->request->getVar('produto_id');
            $quantidades = $this->request->getVar('prod_qCom');
            $valores = $this->request->getVar('prod_vProd');

            $vars['tot_vBC'] = 1;
            $vars['tot_vICMS'] = 1;
            $vars['tot_vICMSDeson'] = 1;
            $vars['tot_vFCP'] = 1;
            $vars['tot_vBCST'] = 1;
            $vars['tot_vST'] = 1;
            $vars['tot_vFCPST'] = 1;
            $vars['tot_vFCPSTRet'] = 1;
            $vars['tot_vProd'] = 1;
            $vars['tot_vFrete'] = 1;
            $vars['tot_vSeg'] = 1;
            $vars['tot_vDesc'] = 1;
            $vars['tot_vII'] = 1;
            $vars['tot_vIPI'] = 1;
            $vars['tot_vIPIDevol'] = 1;
            $vars['tot_vPIS'] = 1;
            $vars['tot_vCOFINS'] = 1;
            $vars['tot_vOutro'] = 1;
            $vars['tot_vNF'] = 1;
            $vars['tot_vTotTrib'] = 1;
            $vars['fat_vDesc'] = 1;
            $vars['fat_vLiq'] = 1;
            $vars['dup_vDup'] = 1;
            $vars['detPag_vPag'] = 1;
            $vars['detPag_vTroco'] = 1;

            $model->save($vars);
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
                        'prod_vProd' => $valores[$i],
                        'nfe_temp_id' => $model->selectMax('id')->first(),
                        'prod_item' => $i + 1,
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
                        'nfe_temp_serie' => $vars['ide_serie'],
                        'prod_cProd' => $produto['cProd'],
                        'prod_nNF' => $vars['numero_nfe'],
                        'prod_indTot' => '',
                        'prod_cEAN' => $produto['cEAN'],
                        'prod_xProd' => $produto['xProd'],
                        'prod_NCM' => $produto['NCM'],
                        'prod_CFOP' => $produto['CFOP_Entrada'], //identificar se é o cfop de entrada ou saída
                        'prod_uCom' => $produto['uCom_Entrada'], //identificar se é de entrada ou saída
                        'prod_vUnCom' => $produto['vUnCom'],
                        'prod_cEANTrib' => $produto['cEANTrib'],
                        'prod_uTrib' => $produto['uTrib'],
                        'prod_vUnTrib' => $produto['vUnTrib'],
                        'icms_orig' => $produto['tICMS_origem'],
                        'icms_CST' => $produto['tICMS_cst'],
                        'icms_modBC' => '',
                        'pis_CST' => '',
                        'cofins_CST' => '',
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
                    'tipo'     => 'success',
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

        return redirect('notas');

//                return redirect()->to('notas/gerarxml?id=' . $model->selectMax('id')->first()['id']);
    }
    public function editar()
    {
        $model = new NFeModel();
        $itemModel = new ItensNFeModel();
        helper('form');

        if ($this->validate([
            'cliente_id' => [
                'label' => 'Cliente',
                'rules' => 'required'],
        ])) {
            $vars = $this->request->getVar();

            $produtos = $this->request->getVar('produto_id');
            $quantidades = $this->request->getVar('prod_qCom');
            $valores = $this->request->getVar('prod_vProd');
            $itens = $this->request->getVar('prod_item');

            $vars['tot_vBC'] = 1;
            $vars['tot_vICMS'] = 1;
            $vars['tot_vICMSDeson'] = 1;
            $vars['tot_vFCP'] = 1;
            $vars['tot_vBCST'] = 1;
            $vars['tot_vST'] = 1;
            $vars['tot_vFCPST'] = 1;
            $vars['tot_vFCPSTRet'] = 1;
            $vars['tot_vProd'] = 1;
            $vars['tot_vFrete'] = 1;
            $vars['tot_vSeg'] = 1;
            $vars['tot_vDesc'] = 1;
            $vars['tot_vII'] = 1;
            $vars['tot_vIPI'] = 1;
            $vars['tot_vIPIDevol'] = 1;
            $vars['tot_vPIS'] = 1;
            $vars['tot_vCOFINS'] = 1;
            $vars['tot_vOutro'] = 1;
            $vars['tot_vNF'] = 1;
            $vars['tot_vTotTrib'] = 1;
            $vars['fat_vDesc'] = 1;
            $vars['fat_vLiq'] = 1;
            $vars['dup_vDup'] = 1;
            $vars['detPag_vPag'] = 1;
            $vars['detPag_vTroco'] = 1;

            $model->save($vars);
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
                        'produto_id' => $produtos[$i],
                        'prod_qCom' => $quantidades[$itens[$i + 1]],
                        'prod_vProd' => $valores[$itens[$i + 1]],
                        'prod_cProd' => $produto['cProd'],
                        'nfe_temp_id' => $model->selectMax('id')->first(),
                        'prod_item' => $i + 1,
                        'prod_qTrib' => $quantidades[$itens[$i + 1]],
                        'icms_vBC' => $produto['tICMS_cst'] ?? '',
                        'icms_pICMS' => $produto['tICMS_tpcalc'] ?? '',
                        'icms_vICMS' => $produto['tICMS_aliq'] ?? '',
                        'pis_vBC' => $produto['tPIS_cst'] ?? '',
                        'pis_pPIS' => $produto['tPIS_tpcalc'] ?? '',
                        'pis_vPIS' => $produto['tPIS_aliq'] ?? '',
                        'cofins_vBC' => $produto['tCOFINS_cst'] ?? '',
                        'cofins_pCOFINS' => $produto['tCOFINS_tpcalc'] ?? '',
                        'cofins_vCOFINS' => $produto['tCOFINS_aliq'] ?? '',
                        'empresa_id' => session()->get('empresa')['id'] ?? '',
                        'nfe_temp_serie' => $vars['ide_serie'],
                        'prod_nNF' => $vars['numero_nfe'],
                        'prod_indTot' => '',
                        'prod_cEAN' => $produto['cEAN'] ?? '',
                        'prod_xProd' => $produto['xProd'] ?? '',
                        'prod_NCM' => $produto['NCM'] ?? '',
                        'prod_CFOP' => $produto['CFOP_Entrada'] ?? '', //identificar se é o cfop de entrada ou saída
                        'prod_uCom' => $produto['uCom_Entrada'] ?? '', //identificar se é de entrada ou saída
                        'prod_vUnCom' => $produto['vUnCom'] ?? '',
                        'prod_cEANTrib' => $produto['cEANTrib'] ?? '',
                        'prod_uTrib' => $produto['uTrib'] ?? '',
                        'prod_vUnTrib' => $produto['vUnTrib'] ?? '',
                        'icms_orig' => $produto['tICMS_origem'] ?? '',
                        'icms_CST' => $produto['tICMS_cst'] ?? '',
                        'icms_modBC' => '',
                        'pis_CST' => '',
                        'cofins_CST' => '',
                    ];

                    // Salvar o item no banco de dados (exemplo)
                    $itemModel->save($item);
                } else {
                    $data = [
                        'title' => 'Notas',
                        'nfes' => $model->paginate(10),
                        'pager' => $model->pager,
                        'msg' => [
                            'mensagem' => 'Erro ao editar a nota!',
                            'tipo'     => 'danger',
                        ]];
                }
            }

            $data = [
                'title' => 'Notas',
                'nfes' => $model->paginate(10),
                'pager' => $model->pager,
                'msg' => [
                    'mensagem' => 'Nota editada!',
                    'tipo'     => 'success',
                    ]];
        }
        else {
            $data = [
                'title' => 'Notas',
                'nfes' => $model->paginate(10),
                'pager' => $model->pager,
                'msg' => [
                    'mensagem' => 'Erro ao editar a nota!',
                    'tipo'     => 'danger',
            ]];
        }

        return redirect('notas');

//                return redirect()->to('notas/gerarxml?id=' . $model->selectMax('id')->first()['id']);
    }

    public function cancelar($id = null)
    {
        $model = new CategoriasModel();
        $model->delete($id);

        return redirect()->to(base_url('admin/categorias'));
    }
}
