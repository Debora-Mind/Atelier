<?php

namespace App\Controllers\NFe;

use App\Controllers\BaseController;
use App\Models\EmpresaModel;
use App\Models\NFeTempModel;
use NFePHP\Common\Certificate;
use NFePHP\NFe\Common\Standardize;
use NFePHP\NFe\Tools;

class ConsultaPost extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Usuários',
            'msg' => ''
        ];

        try {

            $model = new NFeTempModel();
            $nota = $model->getNFeTemp($this->request->getVar('id'));

            $modal = new EmpresaModel();
            $empresa = $modal->getEmpresa($nota['empresa_id']); //ALTERAR

            $config = [
                'atualizacao' => date('Y-m-d H:i:s'),
                'tpAmb' => $empresa['ambiente'],
                'razaosocial' => $empresa['razao_social'],
                'cnpj' => $this->validarCnpj($empresa['cnpj']), // PRECISA SER VÁLIDO
                'ie' => $empresa['ie'], // PRECISA SER VÁLIDO
                'siglaUF' => $empresa['UF'],
                'schemes' => 'PL_009_V4',
                'versao' => '4.00',
            ];

////// DECIDIR ONDE O CERTIFICADO VAI SER ARMARZENADO
//    AGUARDA CERTIFICADO DIGITAL
            $certificadoDigital = file_get_contents(
                $empresa['path_certificados']
            );

            $tools = new Tools(
                json_encode($config),
                Certificate::readPfx($certificadoDigital, $empresa['senha_centificado'])
            );
            $tools->model('55');

            $chave = $nota['ide_id'];
            $response = $tools->sefazConsultaChave($chave);

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

            echo $arr['retEvento']['infEvento']['xMotivo']; // Mostra o motivo // Última mensagem
            //OBS, CRIAR ARRAY COM DATA E MOTIVO DOS EVENTOS

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function exibir($data)
    {
        echo view('backend/templates/html-header', $data);
        echo view('backend/templates/header');
        echo view('backend/pages/usuarios', $data);
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
