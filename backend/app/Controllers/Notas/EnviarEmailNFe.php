<?php

namespace App\Controllers\Notas;

use App\Controllers\BaseController;
use App\Controllers\NFe;
use App\Models\EmpresasModel;
use App\Models\NFeModel;
use App\Models\ClientesModel;
use Exception;
use InvalidArgumentException;
use NFePHP\DA\NFe\Danfe;
use RuntimeException;
use stdClass;
use NFePHP\Mail\Mail;

class EnviarEmailNFe extends BaseController
{
    public function enviarEmail()
    {
        $model = new NFeModel();
        $nota = $model->getNFe($this->request->getVar('id'));

        $modal = new EmpresasModel();
        $config_notas = $modal->getEmpresas($nota['empresa_id']);

        $modal = new ClientesModel();
        $destinatario = $modal->getClientes($nota['cliente_id']);

        $config = new stdClass();
        $config->host = $config_notas['host'];
        $config->user = $config_notas['user'];
        $config->password = $config_notas['password'];
        $config->secure = $config_notas['secure']; //TSL
        $config->port = $config_notas['port'];
        $config->from = $destinatario['email']; //destino
        $config->fantasy = $config_notas['nome_fantasia'];
        $config->replyTo = $config_notas['replyTo'];
        $config->replyName = $config_notas['replyName'];
        $config->smtpdebug = 0; //0-no 1-client 2-server 3-connection 4-lowlevel
        $config->smtpauth = true;
        $config->authtype = ''; //CRAM-MD5, PLAIN, LOGIN, XOAUTH2
        $config->smtpoptions = null;
        $config->timeout = 130; //Quanto tempo aguardar a conexão para abrir, em segundos. O padrão de 5 minutos (300s)

        try {
            $mail = new Mail($config);
            $htmlTemplate = '';
            $mail->loadTemplate($htmlTemplate);
            $xml = $nota['ide_nome_xml'];
            $logo = 'data://text/plain;base64,' . base64_encode(file_get_contents(realpath($config_notas['logomarca']))) ?? null;
            $xmls = file_get_contents($xml);

            $danfe = new Danfe($xmls);
            $danfe->debugMode(false);
            $danfe->creditsIntegratorFooter('ARON Sistemas - http://www.aronsistemas.com.br'); //MINHA LOGO
            $danfe->obsContShow(false);

            $pdf = $danfe->render($logo);
            $mail->loadDocuments($xml, $pdf);
            $addresses = [$destinatario['email']];
            $mail->send($addresses, true);

            return redirect()->to('/notas');

        } catch (InvalidArgumentException|RuntimeException|Exception $e) {
            session()->setFlashdata("erro", explode(PHP_EOL, $e->getMessage()));
            return redirect()->to('/notas');
        }
    }
}
