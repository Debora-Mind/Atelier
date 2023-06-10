<?php

namespace App\Controllers\Notas;

use App\Controllers\BaseController;
use App\Models\ClientesModel;
use App\Models\EmpresasModel;
use App\Models\NaturezaOperacaoModel;
use App\Models\NFeModel;
use Exception;
use NFePHP\Common\Certificate;
use NFePHP\NFe\Common\Standardize;
use NFePHP\NFe\Complements;
use NFePHP\NFe\Make;
use NFePHP\NFe\Tools;
use stdClass;

class GeraXMLPOST extends BaseController
{

    private $nota;
    private $empresa;
    private $cliente;
    private $nfe;
    private $stdICMSTot;
    private $stdProd;
    private $stdIde;
    private $tools;

    public function store()
    {
        $model = new NFeModel();
        $this->nota = $model->getNFe($this->request->getVar('id'));

        $modelEmpresa = new EmpresasModel();
        $this->empresa = $modelEmpresa->getEmpresas($this->nota['empresa_id']); //ALTERAR

        $modelCliente = new ClientesModel();
        $this->cliente = $modelCliente->getClientes($this->nota['cliente_id']);

        if ($this->nota['status_id'] != 1) {
            echo 'Tentativa de duplicidade';
            exit();
        }

        $config = [
            'atualizacao' => date('Y-m-d H:i:s'),
            'tpAmb' => 2,//$empresa['ambiente'],
            'razaosocial' => $this->empresa['razao_social'],
            'cnpj' => $this->validarCnpj($this->empresa['cnpj']),
            'ie' => $this->empresa['ie'], // PRECISA SER VÁLIDO
            'siglaUF' => $this->empresa['uf'],
            'schemes' => 'PL_009_V4',
            'versao' => '4.00',
        ];

        $certificadoDigital = file_get_contents(
            $this->empresa['certificado_a3']
        );

        $this->tools = new Tools(
            json_encode($config),
            Certificate::readPfx($certificadoDigital, $this->empresa['senha_centificado'])
        );

        $this->nfe = new Make();
        $std = new stdClass();
        $std->versao = '4.00';
        $std->Id = null;
        $std->pk_nItem = '';
        $this->nfe->taginfNFe($std);

        $this->configuracoes($std);
        $this->emitente();
        $this->dadosSefaz();
        $this->destinatario();
        $this->itens();
        $this->transporte();
        $this->fatura();
        $this->gerarXML();
        $chave = $this->nfe->getChave();
        $erros = $this->nfe->getErrors();
        $modelo = $this->nfe->getModelo();
        $XML = $this->gerarXML();
        $this->gerarPasta($chave, $XML, $model);
        $response_assinado = $this->assinar($chave);
        $recibo = $this->protocolar($response_assinado);
        $response = $this->verificarRecibo($recibo);
        $this->transmitir($model, $response_assinado, $response, $chave);

    }

    public function configuracoes($std)
    {
        $modelNaturezaOperacao = new NaturezaOperacaoModel();
        $naturezaOperacao = $modelNaturezaOperacao->getNaturezaOperacao($this->nota['ide_natOp']);

        $this->stdIde = new stdClass();
        $this->stdIde->cUF = $this->empresa['cUF'];
        $this->stdIde->cNF = rand(11111111, 99999999);

        $this->stdIde->natOp = $naturezaOperacao['descricao'];  //TRANSFORMAR EM FK
        $this->stdIde->mod = 55; //Modelo do Documento Fiscal
        $this->stdIde->serie = $this->nota['ide_serie']; //verificar como trazer esses n[umero da sefaz
        $this->stdIde->nNF = $this->nota['numero_nfe']; //Código Numérico que compõe a Chave de Acesso
        $this->stdIde->dhEmi = date('Y-m-d') . 'T' . date('H:i:s') . '-03:00';
        $std->dhSaiEnt = date('Y-m-d') . 'T' . date('H:i:s') . '-03:00';
        $this->stdIde->tpNF = 1;
        $this->stdIde->idDest = 1;
        $this->stdIde->cMunFG = $this->empresa['codMun']; //Código do Município dO ibge
        $this->stdIde->tpImp = 1;
        $this->stdIde->tpEmis = 1; //Número do Documento Fiscal
        $this->stdIde->cDV = 2; //Dígito Verificador da Chave de Acesso
        $this->stdIde->tpAmb = 2; //$empresa['ambiente']; // 1 - Produção, 2 - Homologação
        $this->stdIde->finNFe = 1; //Se NF-e complementar (finNFe=2):– Não informado NF referenciada (NF modelo 1 ou NF-e)
        $this->stdIde->indFinal = 1;
        $this->stdIde->indPres = 0;
        $this->stdIde->indIntermed = null;
        $this->stdIde->procEmi = 0;
        $this->stdIde->verProc = 0; //Identificador da versão do processo de emissão (informar a versão do aplicativo emissor de NF-e).
        $tagide = $this->nfe->tagide($this->stdIde);
    }

    public function emitente()
    {
        $stdEmit = new stdClass();
        $stdEmit->xNome = $this->empresa['razao_social'];
        $stdEmit->xFant = $this->empresa['nome_fantasia'];
        $stdEmit->IE = $this->empresa['ie'];
        $stdEmit->IEST = null;
        $stdEmit->IM = $this->empresa['im'];
        $stdEmit->CNAE = $this->empresa['CNAE'];
        $stdEmit->CRT = $this->empresa['CRT_ID'];
        $stdEmit->CNPJ = $this->validarCnpj($this->empresa['cnpj']); //indicar apenas um CNPJ ou CPF
        $tagemit = $this->nfe->tagemit($stdEmit);

        $stdEnderEmit = new stdClass();
        $stdEnderEmit->xLgr = $this->empresa['logradouro'];
        $stdEnderEmit->nro = $this->empresa['numero'];
        $stdEnderEmit->xCpl = $this->empresa['emitentexCpl'];
        $stdEnderEmit->xBairro = $this->empresa['bairro'];
        $stdEnderEmit->cMun = $this->empresa['codMun'];
        $stdEnderEmit->xMun = $this->empresa['municipio'];
        $stdEnderEmit->UF = $this->empresa['uf'];
        $stdEnderEmit->CEP = $this->empresa['cep'];
        $stdEnderEmit->cPais = $this->empresa['codPais']; //BRASIL 1058
        $stdEnderEmit->xPais = $this->empresa['pais'];
        $stdEnderEmit->fone = $this->validarTelefone($this->empresa['fone']);
        $tagenderEmit = $this->nfe->tagenderEmit($stdEnderEmit);
    }

    public function dadosSefaz()
    {
        //cnpj sefaz rs 87.958.674/0001-81
        $std = new stdClass();
        $std->CNPJ = $this->validarCnpj('87.958.674/0001-81');  //INDICAR OU UM CNPJ OU UM CPF DO CONTADOR
        $std->CPF = null;
        $tagautXML = $this->nfe->tagautXML($std);
    }

    public function destinatario()
    {
        $stdDest = new stdClass();
        $stdDest->xNome = $this->cliente['nome_razao_social'];
        $stdDest->indIEDest = 9;
        $stdDest->IE = $this->cliente['rg_ie'];
        $stdDest->ISUF = '';
        $stdDest->IM = $this->cliente['inscr_munic'];
        $stdDest->email = $this->cliente['email'];
        $stdDest->CNPJ = $this->cliente['cpf_cnpj'];
        $stdDest->CPF = null;
        $tagdest = $this->nfe->tagdest($stdDest);

        $stdEndereDest = new stdClass();
        $stdEndereDest->xLgr = $this->cliente['logradouro'];
        $stdEndereDest->nro = $this->cliente['nr'];
        $stdEndereDest->xCpl = $this->cliente['complemento'];
        $stdEndereDest->xBairro = $this->cliente['bairro'];
        $stdEndereDest->cMun = $this->cliente['cMun']; //IBGE
        $stdEndereDest->xMun = $this->cliente['cidade'];
        $stdEndereDest->UF = $this->cliente['uf'];
        $stdEndereDest->CEP = $this->cliente['cep'];
        $stdEndereDest->cPais = '1058'; //Brasil
        $stdEndereDest->xPais = 'Brasil';
        $stdEndereDest->fone = $this->validarTelefone($this->cliente['telefone01']);
        $this->nfe->tagenderDest($stdEndereDest);
    }

    public function itens()
    {
        //foreach
        $valor = 306.8;
        $this->stdProd = new stdClass();
        $this->stdProd->item = 1;
        $this->stdProd->cEAN = '7896745800660';
        $this->stdProd->cEANTrib = '7896745800660';
        $this->stdProd->cProd = '1057';
        $this->stdProd->xProd = 'GENFLOC CLARIFICANTE 01LT';
        $this->stdProd->NCM = '38089419';
        $this->stdProd->CFOP = '5102';
        $this->stdProd->uCom = 'UN';
        $this->stdProd->uTrib = 'UN';
        $this->stdProd->qCom = 1.0;
        $std = new stdClass();
        $std->CNPJ = $this->cliente['cpf_cnpj']; //indicar um CNPJ ou CPF
        $std->CPF = null;
        $this->stdProd->vUnCom = number_format($valor, 2, '.', '');
        $this->stdProd->qTrib = 1;
        $this->stdProd->vUnTrib = number_format($this->stdProd->vUnCom, 2, '.', '');
        $this->stdProd->vProd = $this->stdProd->qTrib * $this->stdProd->vUnTrib;
        $this->stdProd->indTot = 1;
        $tagprod = $this->nfe->tagprod($this->stdProd);

        /** TRIBUTOS */
        $stdimposto = new stdClass();
        $stdimposto->item = 1;
        $stdimposto->vTotTrib = 20.93;
        $tagimposto = $this->nfe->tagimposto($stdimposto);

        $stdICMS = new stdClass();
        $stdICMS->item = 1; //item da Notas
        $stdICMS->orig = 0;
        $stdICMS->CST = '00';
        $stdICMS->modBC = 1;
        $stdICMS->vBC = 0.0;
        $stdICMS->pICMS = 0.0;
        $stdICMS->vICMS = 0.0;
        $ICMS = $this->nfe->tagICMS($stdICMS);

        $stdPIS = new stdClass();
        $stdPIS->item = 1; //item da Notas
        $stdPIS->CST = '99';
        $stdPIS->vBC = 0.0;
        $stdPIS->pPIS = 0.0;
        $stdPIS->vPIS = 0.0;
        $pis = $this->nfe->tagPIS($stdPIS);

        $stdCOFINS = new stdClass();
        $stdCOFINS->item = 1; //item da Notas
        $stdCOFINS->CST = '99';
        $stdCOFINS->vBC = 0.0;
        $stdCOFINS->pCOFINS = 0.0;
        $stdCOFINS->vCOFINS = 0.0;
        $COFINS = $this->nfe->tagCOFINS($stdCOFINS);

        $this->stdICMSTot = new stdClass();
        $this->stdICMSTot->vBC = 0.0;
        $this->stdICMSTot->vICMS = 0.0;
        $this->stdICMSTot->vProd = $this->stdProd->vProd;
        $this->stdICMSTot->vPIS = 0.0;
        $this->stdICMSTot->vCOFINS = 0.0;
        $this->stdICMSTot->vNF = number_format($this->stdProd->vProd, 2, '.', '');
        $this->stdICMSTot->vTotTrib = 0.0;
        $ICMSTot = $this->nfe->tagICMSTot($this->stdICMSTot);

        /** TRIBUTOS */
    }

    public function transporte()
    {
        $stdtransp = new stdClass();
        $stdtransp->modFrete = 9;
        $trasnp = $this->nfe->tagtransp($stdtransp);
    }

    public function fatura()
    {
        $stdfat = new stdClass();
        $stdfat->nFat = '1736';
        $stdfat->vOrig = $this->stdICMSTot->vNF;
        $stdfat->vDesc = 0.0;
        $stdfat->vLiq = $this->stdICMSTot->vNF;
        $fat = $this->nfe->tagfat($stdfat);

        $stddup = new stdClass();
        $stddup->nDup = '001';
        $stddup->dVenc = '2023-09-29';
        $stddup->vDup = $this->stdICMSTot->vNF;
        $this->nfe->tagdup($stddup);

        $stdtroco = new stdClass();
        $stdtroco->vTroco = 0.0;
        $troco = $this->nfe->tagpag($stdtroco);

        $stdPag = new stdClass();
        $stdPag->tPag = '05';
        $stdPag->vPag = number_format($this->stdProd->vProd, 2, '.', '');
        //$std->indPag = 0;
        $pags = $this->nfe->tagdetPag($stdPag);

        $stdinfAdic = new stdClass();
        $stdinfAdic->infAdFisco = 'informacoes para o fisco';
        $stdinfAdic->infCpl = 'gerando xml teste';
        $taginfAdic = $this->nfe->taginfAdic($stdinfAdic);
    }

    public function gerarXML()
    {
        try {
            $XML = $this->nfe->getXML();
            return $XML;
        } catch (Exception $e) {
            echo "Ocorreu um erro: " . $e->getMessage();
            var_dump($this->nfe->getErrors());
            exit();
        }
    }

    public function gerarPasta($chave, $XML, NFeModel $model)
    {
        $ano = date('Y');
        $mes = date('m');
        $dia = date('d');

        if ($this->stdIde->tpAmb == 1):
            $PastaAmbiente = 'producao';
        else:
            $PastaAmbiente = 'homologacao';
        endif;

        ########## GERANDO XML E SALVANDO NA PASTA #########
        $path = "XML/NF-e/{$this->empresa['cnpj']}/{$PastaAmbiente}/temporaria/{$ano}/{$mes}/{$dia}";

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $filename = $path . '/' . $chave . '-notas.xml';

        $model->save([
            'id' => $this->nota['id'],
            'path_xml' => $path,
            'ide_nome_xml' => $filename
        ]);

        $this->nota = $model->getNFe($this->nota['id']);

        $response = file_put_contents($filename, $XML);
    }

    public function assinar($chave)
    {
        $response_assinado = $this->tools->signNFe(file_get_contents($this->nota['ide_nome_xml']));

        $ano = date('Y');
        $mes = date('m');
        $dia = date('d');

        if ($this->stdIde->tpAmb == 1):
            $PastaAmbiente = 'producao';
        else:
            $PastaAmbiente = 'homologacao';
        endif;

        $path_assinadas =  "XML/NF-e/{$this->empresa['cnpj']}/{$PastaAmbiente}/assinadas/{$ano}/{$mes}/{$dia}";
        $caminho = $path_assinadas . '/' . $chave . '-notas.xml';
        if (is_dir($path_assinadas)) {
        } else {
            mkdir($path_assinadas, 0777, true);
        }
        file_put_contents($caminho,  $response_assinado);

        return $response_assinado;
    }

    public function protocolar($response_assinado)
    {
        try {
            $idLote = str_pad(100, 15, '0', STR_PAD_LEFT); // Identificador do lote
            $resp = $this->tools->sefazEnviaLote([$response_assinado], $idLote);

            $st = new  Standardize();
            $std = $st->toStd($resp);
            if ($std->cStat != 103) {
                //erro registrar e voltar
                exit("[$std->cStat] $std->xMotivo");
            }
            $recibo = $std->infRec->nRec; // Vamos usar a variável $recibo para consultar o status da nota

            return $recibo;
        } catch (Exception $e) {
            //aqui você trata possiveis exceptions do envio
            exit($e->getMessage());
        }
    }

    public function verificarRecibo($recibo)
    {
        try {
            $protocolo = $this->tools->sefazConsultaRecibo($recibo);
        } catch (Exception $e) {
            //aqui você trata possíveis exceptions da consulta
            exit($e->getMessage());
        }

        return $protocolo;
    }

    public function transmitir($model, $response_assinado, $response, $chave)
    {
        $request = $response_assinado;

        try {
            $xml_autorizado = Complements::toAuthorize($request, $response);
            //  header('Content-type: text/xml; charset=UTF-8');

            $ano = date('Y');
            $mes = date('m');
            $dia = date('d');

            if ($this->stdIde->tpAmb == 1):
                $PastaAmbiente = 'producao';
            else:
                $PastaAmbiente = 'homologacao';
            endif;

            $path_autorizadas =  "XML/NF-e/{$this->empresa['cnpj']}/{$PastaAmbiente}/autorizadas/{$ano}/{$mes}/{$dia}";
            $caminho_aut = $path_autorizadas . '/' . $chave . '-notas.xml';
            if (is_dir($path_autorizadas)) {
            } else {
                mkdir($path_autorizadas, 0777, true);
            }
            file_put_contents($caminho_aut,  $xml_autorizado);

            $resposta = $stdCl = new Standardize($xml_autorizado);
            //nesse caso $std irá conter uma representação em stdClass do XML
            $std = $stdCl->toStd();
            //nesse caso o $arr irá conter uma representação em array do XML
            $arr = $stdCl->toArray();

            $retornoXML = $arr['protNFe']['infProt'];

            $model->update($this->nota['id'], [
                'ide_id' => $chave,
                'path_xml' => $path_autorizadas,
                'path_file' => $caminho_aut,
                'status_id' => 5,
                'xMotivo' => $retornoXML['xMotivo'],
                'digVal' => $retornoXML['digVal'],
                'dhRecbto' => $retornoXML['dhRecbto'],
                'nProt' => $retornoXML['nProt'],
                'cStat' => $retornoXML['cStat'],
            ]);
            //MENSAGEM DE SUCESSO
            echo 'Inserido com sucesso';

        } catch (Exception $e) {
            //reporta erro na autorização
            echo "Erro: " . $e->getMessage();
        }
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

    function validarTelefone($tel) {
        // seria melhor cirar uma white list.
        // tratando manualmente
        $tel = str_replace("-", "", $tel);
        $tel = str_replace("(", "", $tel);
        $tel = str_replace(")", "", $tel);
        $tel = str_replace("_", "", $tel);
        $tel = str_replace(" ", "", $tel);
        $tel = str_replace("+", "", $tel);
        //---------------------

        // Se nao tiver DDD e 9 digito
        if (strlen($tel) == 8) {

            $tel = '9'.$tel;

        };

        // Se nao tiver DDD
        if (strlen($tel) == 9) {

            $tel = '11'.$tel;

        };

        // Se tiver DDD mas nao tiver o 9 digito
        if (strlen($tel) == 10) {

            $inicio = substr($tel, 0, 2);
            $fim =  substr($tel, 2, 10);
            $tel = $inicio.'9'.$fim;

        };

        //verificando se é celular
        $celReal = array ("9","8","7","6","5","4");

        // retirando espaços
        $tel = trim($tel);

        // Verifica se e celular mesmo
        if (strlen($tel) == 11) {

            $validaCel = substr($tel,5,1);
            if (in_array($validaCel, $celReal)){

                return $tel;

            } else {

                return false;

            }
        }
    }
}
