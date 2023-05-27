<?php

namespace App\Controllers\NFe;

use App\Controllers\BaseController;
use App\Models\EmpresaModel;
use App\Models\NFeTempModel;
use InvalidArgumentException;
use NFePHP\DA\NFe\Danfe;

class ImprimirPost extends BaseController
{
    public function store()
    {
        $model = new NFeTempModel();
        $nota = $model->getNFeTemp($this->request->getVar('id'));

        $modal = new EmpresaModel();
        $empresa = $modal->getEmpresa($nota['empresa_id']); //ALTERAR

        //LOGO DA EMPRESA
        $logo = 'data://text/plain;base64,'. base64_encode(file_get_contents(realpath($empresa['logomarca'])));
        $logo = realpath(realpath($empresa['logomarca']));

        //VERIFICAR SE A NOTA PRECISA ESTAR AUTORIZADA
        $xml = file_get_contents($nota['parh_file']);

        if (!$nota):
            echo 'Notas não existe';
            exit();
        endif;

        try {

            $danfe = new Danfe($xml);
            $danfe->exibirTextoFatura = false;
            $danfe->exibirPIS = false;
            $danfe->exibirIcmsInterestadual = false;
            $danfe->exibirValorTributos = false;
            $danfe->descProdInfoComplemento = false;
            $danfe->exibirNumeroItemPedido = false;
            $danfe->setOcultarUnidadeTributavel(true);
            $danfe->obsContShow(false);
            $danfe->printParameters(
                $orientacao = 'P',
                $papel = 'A4',
                $margSup = 2,
                $margEsq = 2
            );
            $danfe->logoParameters($logo, $logoAlign = 'C', $mode_bw = false);
            $danfe->setDefaultFont($font = 'times');
            $danfe->setDefaultDecimalPlaces(4);
            $danfe->debugMode(false);
            $danfe->creditsIntegratorFooter('WEBNFe Sistemas - http://www.webenf.com.br');
            //$danfe->epec('891180004131899', '14/08/2018 11:24:45'); //marca como autorizada por EPEC

            // Caso queira mudar a configuracao padrao de impressao
            /*  $this->printParameters( $orientacao = '', $papel = 'A4', $margSup = 2, $margEsq = 2 ); */
            // Caso queira sempre ocultar a unidade tributável
            /*  $this->setOcultarUnidadeTributavel(true); */
            //Informe o numero DPEC
            /*  $danfe->depecNumber('123456789'); */
            //Configura a posicao da logo
            /*  $danfe->logoParameters($logo, 'C', false);  */
            //Gera o PDF
            $pdf = $danfe->render($logo);
            header('Content-Type: application/pdf');
            echo $pdf;
        } catch (InvalidArgumentException $e) {
            echo "Ocorreu um erro durante o processamento :" . $e->getMessage();
        }
    }
}
