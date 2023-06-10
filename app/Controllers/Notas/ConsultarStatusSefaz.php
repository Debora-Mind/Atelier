<?php

namespace App\Controllers\Notas;

use App\Controllers\BaseController;

use App\Models\ClientesModel;
use App\Models\EmpresasModel;
use App\Models\NFeModel;
use App\Models\StatusModel;
use NFePHP\NFe\Tools;
use NFePHP\Common\Certificate;
use NFePHP\NFe\Common\Standardize;

class ConsultarStatusSefaz extends BaseController
{
    public function index()
    {
        $modelNotas = new NFeModel();

        try {

            $modal = new EmpresasModel();
            $empresa = $modal->getEmpresas(session()->get('empresa')['id']); //ALTERAR

            $config = [
                'atualizacao' => date('Y-m-d H:i:s'),
                'tpAmb' => 2, //$empresa['ambiente'],
                'razaosocial' => $empresa['razao_social'],
                'cnpj' => $this->validarCnpj($empresa['cnpj']), // PRECISA SER VÁLIDO
                'ie' => $empresa['ie'], // PRECISA SER VÁLIDO
                'siglaUF' => $empresa['uf'],
                'schemes' => 'PL_009_V4',
                'versao' => '4.00',
            ];

            $certificadoDigital = file_get_contents(
                $empresa['certificado_a3']
            );

            $tools = new Tools(
                json_encode($config),
                Certificate::readPfx($certificadoDigital, $empresa['senha_centificado'])
            );

            $tools->model('55');
            $uf = $empresa['uf'];
            $tpAmb = 2; //$empresa['ambiente'];
            $response = $tools->sefazStatus($uf, $tpAmb);
            //este método não requer parametros, são opcionais, se nenhum parametro for
            //passado serão usados os contidos no $configJson
            //$response = $tools->sefazStatus();

            //você pode padronizar os dados de retorno atraves da classe abaixo
            //de forma a facilitar a extração dos dados do XML
            //NOTA: mas lembre-se que esse XML muitas vezes será necessário,
            //      quando houver a necessidade de protocolos
            $stdCl = new Standardize($response);
            //nesse caso $std irá conter uma representação em stdClass do XML
            $std = $stdCl->toStd();
            //nesse caso o $arr irá conter uma representação em array do XML
            $arr = $stdCl->toArray();
            //nesse caso o $json irá conter uma representação em JSON do XML
            $json = $stdCl->toJson();

            $dados = [
                'title' => 'Notas Fiscais',
                'nfes' => $modelNotas->paginate(10),
                'pager' => $modelNotas->pager,
                'cliente' => new ClientesModel(),
                'status' => new StatusModel(),
                'msg' => [
                    'mensagem' => $arr['xMotivo'],
                    'tipo' => 'info']
            ];

        } catch (\Exception $e) {
            $dados = [
                'title' => 'Notas Fiscais',
                'nfes' => $modelNotas->paginate(10),
                'pager' => $modelNotas->pager,
                'cliente' => new ClientesModel(),
                'status' => new StatusModel(),
                'msg' => [
                    'mensagem' => $e->getMessage(),
                    'tipo' => 'danger']
            ];
        }

        $this->exibir($dados, 'listar-notas');
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

    function validarCnpj($cnpj)
    {
        $cnpjOriginal = $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;

        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;

        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($cnpj[13] == ($resto < 2 ? 0 : 11 - $resto)):
            return $cnpjOriginal;
        endif;

        return false;
    }
}
