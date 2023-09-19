<?php

namespace App\Controllers;
use App\Models\EmpresasModel;
use NFePHP\Common\Certificate;
use NFePHP\NFe\Tools;
class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home',
            'msg' => []
        ];

        $this->exibir($data, '');


    }

    public function exibir($data, $page)
    {
        $tipo = session('usuario')['tipo'];

        echo view('backend/templates/html-header', $data);
        if ($tipo):
            echo view('backend/templates/header-' . $tipo, $data);
        else:
            echo view('backend/templates/header', $data);
        endif;
        echo view('backend/templates/footer');
        echo view('backend/templates/html-footer');
    }

    public function teste()
    {
// Informe as informações da chave de acesso da nota fiscal
        $ufEmitente = 'XX'; // Unidade Federativa do emitente (exemplo: SP)
        $dataEmissao = '2023-07-04'; // Data de emissão da nota fiscal
        $cnpjEmitente = '12345678901234'; // CNPJ do emitente
        $modelo = '55'; // Modelo da nota fiscal (exemplo: 55)
        $serie = '001'; // Série da nota fiscal
        $numero = '123'; // Número da nota fiscal
        $codigoNumerico = '98765432'; // Código numérico da nota fiscal
        $digitoVerificador = '1'; // Dígito verificador da nota fiscal

// Instancie a classe Tools do NFePHP
//        $tools = new Tools('path/to/config/config.json');

        $empresa = session()->get('empresa'); //ALTERAR

        $config = [
            'atualizacao' => date('Y-m-d H:i:s'),
            'tpAmb' => 2,//$empresa['ambiente'],
            'razaosocial' => $empresa['razao_social'],
            'cnpj' => $empresa['cnpj'],
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
// Realize a consulta da nota fiscal e obtenha o XML
// Informe a chave de acesso da nota fiscal
        $chaveAcesso = '43230629117964000104550300000000011818040500';

// Informe o tipo de ambiente: '1' para produção ou '2' para homologação
        $tipoAmbiente = '2';

// Instancie a classe Tools do NFePHP

// Realize a consulta da nota fiscal e obtenha o XML
        $xml = $tools->sefazConsultaChave($chaveAcesso, $tipoAmbiente);
        $xml = file_get_contents('XML/NF-e/29117964000104/homologacao/temporaria/2023/06/30/43230629117964000104550300000000011818040500-notas.xml');
        $xml = $tools->sefazValidate($xml);
// Exiba o XML da nota fiscal
        echo $xml;
        exit();
    }
}
