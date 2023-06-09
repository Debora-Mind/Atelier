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
    public function store()
    {
        $model = new NFeModel();
        $nota = $model->getNFe($this->request->getVar('id'));

        $modelEmpresa = new EmpresasModel();
        $empresa = $modelEmpresa->getEmpresas($nota['empresa_id']); //ALTERAR

        $modelCliente = new ClientesModel();
        $cliente = $modelCliente->getClientes($nota['cliente_id']);

        $modelNaturezaOperacao = new NaturezaOperacaoModel();
        $naturezaOperacao = $modelNaturezaOperacao->getNaturezaOperacao($nota['ide_natOp']);

        if($nota['status_id'] != 1) {
            echo 'Tentativa de duplicidade';
            exit();
        }

        $config = [
            'atualizacao' => date('Y-m-d H:i:s'),
            'tpAmb' => 2,//$empresa['ambiente'],
            'razaosocial' => $empresa['razao_social'],
            'cnpj' => $this->validarCnpj($empresa['cnpj']),
            'ie' => $empresa['ie'], // PRECISA SER VÁLIDO
            'siglaUF' => $empresa['uf'],
            'schemes' => 'PL_009_V4',
            'versao' => '4.00',
        ];

////// DECIDIR ONDE O CERTIFICADO VAI SER ARMARZENADO
        $certificadoDigital = file_get_contents(
            $empresa['certificado_a3']
        );

        $tools = new Tools(
            json_encode($config),
            Certificate::readPfx($certificadoDigital, $empresa['senha_centificado'])
        );

        $nfe = new Make();
        $std = new stdClass();
        $std->versao = '4.00';
        $std->Id = null;
        $std->pk_nItem = '';
        $nfe->taginfNFe($std);

        ########################## IDE ##########################
        $stdIde = new stdClass();
        $stdIde->cUF = $empresa['cUF'];
        $stdIde->cNF = rand(11111111, 99999999);

        $stdIde->natOp = $naturezaOperacao['descricao'];  //TRANSFORMAR EM FK
        $stdIde->mod = 55; //Modelo do Documento Fiscal
        $stdIde->serie = $nota['ide_serie']; //verificar como trazer esses n[umero da sefaz
        $stdIde->nNF = $nota['numero_nfe']; //Código Numérico que compõe a Chave de Acesso
        $stdIde->dhEmi = date('Y-m-d') . 'T' . date('H:i:s') . '-03:00';
        $std->dhSaiEnt = date('Y-m-d') . 'T' . date('H:i:s') . '-03:00';
        $stdIde->tpNF = 1;
        $stdIde->idDest = 1;
        $stdIde->cMunFG = 2925303; //Código do Município dO ibge
        $stdIde->tpImp = 1;
        $stdIde->tpEmis = 1; //Número do Documento Fiscal
        $stdIde->cDV = 2; //Dígito Verificador da Chave de Acesso
        $stdIde->tpAmb = 2; //$empresa['ambiente']; // 1 - Produção, 2 - Homologação
        $stdIde->finNFe = 1; //Se NF-e complementar (finNFe=2):– Não informado NF referenciada (NF modelo 1 ou NF-e)
        $stdIde->indFinal = 1;
        $stdIde->indPres = 0;
        $stdIde->indIntermed = null;
        $stdIde->procEmi = 0;
        $stdIde->verProc = 0; //Identificador da versão do processo de emissão (informar a versão do aplicativo emissor de NF-e).
        $tagide = $nfe->tagide($stdIde);
        ########################## IDE ##########################

        ########################## EMITENTE##########################

        $stdEmit = new stdClass();
        $stdEmit->xNome = $empresa['razao_social'];
        $stdEmit->xFant = $empresa['nome_fantasia'];
        $stdEmit->IE = $empresa['ie'];
        $stdEmit->IEST = null;
        $stdEmit->IM = $empresa['im'];
        $stdEmit->CNAE = $empresa['CNAE'];
        $stdEmit->CRT = $empresa['CRT_ID'];
        $stdEmit->CNPJ = $this->validarCnpj($empresa['cnpj']); //indicar apenas um CNPJ ou CPF
        $tagemit = $nfe->tagemit($stdEmit);

        $stdEnderEmit = new stdClass();
        $stdEnderEmit->xLgr = $empresa['logradouro'];
        $stdEnderEmit->nro = $empresa['numero'];
        $stdEnderEmit->xCpl = $empresa['emitentexCpl'];
        $stdEnderEmit->xBairro = $empresa['bairro'];
        $stdEnderEmit->cMun = $empresa['ibge'];
        $stdEnderEmit->xMun = $empresa['municipio'];
        $stdEnderEmit->UF = $empresa['uf'];
        $stdEnderEmit->CEP = $empresa['cep'];
        $stdEnderEmit->cPais = $empresa['codPais']; //BRASIL 1058
        $stdEnderEmit->xPais = $empresa['pais'];
        $stdEnderEmit->fone = $this->validarTelefone($empresa['fone']);
        $tagenderEmit = $nfe->tagenderEmit($stdEnderEmit);
        ########################## EMITENTE##########################

        ########################## CONTADOR ########################
        //cnpj sefaz rs 87.958.674/0001-81
        $std = new stdClass();
        $std->CNPJ = $this->validarCnpj('87.958.674/0001-81');  //INDICAR OU UM CNPJ OU UM CPF
        $std->CPF = null;
        $tagautXML = $nfe->tagautXML($std);
        ########################## CONTADOR ########################

        ########################## DESTINATARIO##########################
        $stdDest = new stdClass();
        $stdDest->xNome = $cliente['nome_razao_social'];
        $stdDest->indIEDest = 9;
        $stdDest->IE = $cliente['rg_ie'];
        $stdDest->ISUF = '';
        $stdDest->IM = $cliente['inscr_munic'];
        $stdDest->email = $cliente['email'];
        $stdDest->CNPJ = $cliente['cpf_cnpj'];
//        $stdDest->CPF = $cliente['cpf_cnpj'];
        $tagdest = $nfe->tagdest($stdDest);

        $stdEndereDest = new stdClass();
        $stdEndereDest->xLgr = $cliente['logradouro'];
        $stdEndereDest->nro = $cliente['nr'];
        $stdEndereDest->xCpl = $cliente['complemento'];
        $stdEndereDest->xBairro = $cliente['bairro'];
        $stdEndereDest->cMun = $cliente['cMun']; //IBGE
        $stdEndereDest->xMun = $cliente['cidade'];
        $stdEndereDest->UF = $cliente['uf'];
        $stdEndereDest->CEP = $cliente['cep'];
        $stdEndereDest->cPais = '1058'; //Brasil
        $stdEndereDest->xPais = 'Brasil';
        $stdEndereDest->fone = $this->validarTelefone($cliente['telefone01']);
        $nfe->tagenderDest($stdEndereDest);
        ########################## DESTINATARIO##########################

        ########################## PRODUTOS ##########################
        //foreache
        $valor = 306.8;
        $stdProd = new stdClass();
        $stdProd->item = 1;
        $stdProd->cEAN = '7896745800660';
        $stdProd->cEANTrib = '7896745800660';
        $stdProd->cProd = '1057';
        $stdProd->xProd = 'GENFLOC CLARIFICANTE 01LT';
        $stdProd->NCM = '38089419';
        $stdProd->CFOP = '5102';
        $stdProd->uCom = 'UN';
        $stdProd->uTrib = 'UN';
        $stdProd->qCom = 1.0;
        $std = new stdClass();
        $std->CNPJ = null; //indicar um CNPJ ou CPF
        $std->CPF = '93102208568';
        $stdProd->vUnCom = number_format($valor, 2, '.', '');
        $stdProd->qTrib = 1;
        $stdProd->vUnTrib = number_format($stdProd->vUnCom, 2, '.', '');
        $stdProd->vProd = $stdProd->qTrib * $stdProd->vUnTrib;
        $stdProd->indTot = 1;
        $tagprod = $nfe->tagprod($stdProd);

        /** TRIBUTOS */
        $stdimposto = new stdClass();
        $stdimposto->item = 1;
        $stdimposto->vTotTrib = 20.93;
        $tagimposto = $nfe->tagimposto($stdimposto);

        $stdICMS = new stdClass();
        $stdICMS->item = 1; //item da Notas
        $stdICMS->orig = 0;
        $stdICMS->CST = '00';
        $stdICMS->modBC = 1;
        $stdICMS->vBC = 0.0;
        $stdICMS->pICMS = 0.0;
        $stdICMS->vICMS = 0.0;
        $ICMS = $nfe->tagICMS($stdICMS);

        $stdPIS = new stdClass();
        $stdPIS->item = 1; //item da Notas
        $stdPIS->CST = '99';
        $stdPIS->vBC = 0.0;
        $stdPIS->pPIS = 0.0;
        $stdPIS->vPIS = 0.0;
        $pis = $nfe->tagPIS($stdPIS);

        $stdCOFINS = new stdClass();
        $stdCOFINS->item = 1; //item da Notas
        $stdCOFINS->CST = '99';
        $stdCOFINS->vBC = 0.0;
        $stdCOFINS->pCOFINS = 0.0;
        $stdCOFINS->vCOFINS = 0.0;
        $COFINS = $nfe->tagCOFINS($stdCOFINS);

        $stdICMSTot = new stdClass();
        $stdICMSTot->vBC = 0.0;
        $stdICMSTot->vICMS = 0.0;
        $stdICMSTot->vProd = $stdProd->vProd;
        $stdICMSTot->vPIS = 0.0;
        $stdICMSTot->vCOFINS = 0.0;
        $stdICMSTot->vNF = number_format($stdProd->vProd, 2, '.', '');
        $stdICMSTot->vTotTrib = 0.0;
        $ICMSTot = $nfe->tagICMSTot($stdICMSTot);

        /** TRIBUTOS */

        ########################## PRODUTOS ##########################

        ########################## TRANSPORTES ##########################
        $stdtransp = new stdClass();
        $stdtransp->modFrete = 9;
        $trasnp = $nfe->tagtransp($stdtransp);
        ########################## TRANSPORTES ##########################

        ########################## DADOS DA FATURA ##########################
        $stdfat = new stdClass();
        $stdfat->nFat = '1736';
        $stdfat->vOrig = $stdICMSTot->vNF;
        $stdfat->vDesc = 0.0;
        $stdfat->vLiq = $stdICMSTot->vNF;
        $fat = $nfe->tagfat($stdfat);

        $stddup = new stdClass();
        $stddup->nDup = '001';
        $stddup->dVenc = '2023-09-29';
        $stddup->vDup = $stdICMSTot->vNF;
        $nfe->tagdup($stddup);

        $stdtroco = new stdClass();
        $stdtroco->vTroco = 0.0;
        $troco = $nfe->tagpag($stdtroco);

        $stdPag = new stdClass();
        $stdPag->tPag = '05';
        $stdPag->vPag = number_format($stdProd->vProd, 2, '.', '');
        //$std->indPag = 0;
        $pags = $nfe->tagdetPag($stdPag);

        ########################## DADOS DA FATURA ##########################
        $stdinfAdic = new stdClass();
        $stdinfAdic->infAdFisco = 'informacoes para o fisco';
        $stdinfAdic->infCpl = 'aula gerando xml 29/06/2022 as 07:38';
        $taginfAdic = $nfe->taginfAdic($stdinfAdic);

        try {
            $XML = $nfe->getXML();
        } catch (Exception $e) {
            echo "Ocorreu um erro: " . $e->getMessage();
            var_dump($nfe->getErrors());
            exit();
    }
        $chave = $nfe->getChave();
        $erros = $nfe->getErrors();
        $modelo = $nfe->getModelo();

        // dd($notas->dom);

        /**
         * usada para criar pastas
         */

        $data_geracao_ano = date('Y');
        $data_geracao_mes = date('m');
        $data_geracao_dia = date('d');

        if ($stdIde->tpAmb == 1):
            $PastaAmbiente = 'producao';
        else:
            $PastaAmbiente = 'homologacao';
        endif;

        ########## GERANDO XML E SALVANDO NA PASTA #########
        $path = "XML/NF-e/{$stdEmit->CNPJ}/{$PastaAmbiente}/temporaria/{$data_geracao_ano}/{$data_geracao_mes}/{$data_geracao_dia}";

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $Filename = $path . '/' . $chave . '-notas.xml';
        $response = file_put_contents($Filename, $XML);

        ########## GERANDO XML E SALVANDO NA PASTA #########

        ########## ASSINANDO XML E SALVANDO NA PASTA #########
        $response_assinado = $tools->signNFe(file_get_contents($Filename ));
        $path_assinadas =  "XML/NF-e/{$stdEmit->CNPJ}/{$PastaAmbiente}/assinadas/{$data_geracao_ano}/{$data_geracao_mes}/{$data_geracao_dia}";
        $caminho = $path_assinadas . '/' . $chave . '-notas.xml';
        if (is_dir($path_assinadas)) {
        } else {
            mkdir($path_assinadas, 0777, true);
        }
        file_put_contents($caminho,  $response_assinado);
        ########## ASSINANDO XML E SALVANDO NA PASTA #########

        ###################### PROTOCOLANDO XML ####################
        try {
            $idLote = str_pad(100, 15, '0', STR_PAD_LEFT); // Identificador do lote
            $resp = $tools->sefazEnviaLote([$response_assinado], $idLote);

            $st = new  Standardize();
            $std = $st->toStd($resp);
            if ($std->cStat != 103) {
                //erro registrar e voltar
                exit("[$std->cStat] $std->xMotivo");
            }
            $recibo = $std->infRec->nRec; // Vamos usar a variável $recibo para consultar o status da nota
        } catch (Exception $e) {
            //aqui você trata possiveis exceptions do envio
            exit($e->getMessage());
        }
        ###################### PROTOCOLANDO XML ####################

        ################ VERIFICA O RECIBO ###########
        try {
            $protocolo = $tools->sefazConsultaRecibo($recibo);
        } catch (Exception $e) {
            //aqui você trata possíveis exceptions da consulta
            exit($e->getMessage());
        }

        $request = $response_assinado;
        $response = $protocolo;
        ################ VERIFICA O RECIBO ###########

        //echo $response_assinado;

        ###################### TRANSMITE PARA SEFAZ ####################
        try {
            $xml_autorizado = Complements::toAuthorize($request, $response);
            //  header('Content-type: text/xml; charset=UTF-8');
            $path_autorizadas =  "XML/NF-e/{$stdEmit->CNPJ}/{$PastaAmbiente}/autorizadas/{$data_geracao_ano}/{$data_geracao_mes}/{$data_geracao_dia}";
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

            $model->update($nota['id'], [
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
        ###################### TRANSMITE PARA SEFAZ ####################
    }

    public function exibir($data, $pagina)
    {
        echo view('backend/templates/html-header', $data);
        echo view('backend/templates/header');
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
