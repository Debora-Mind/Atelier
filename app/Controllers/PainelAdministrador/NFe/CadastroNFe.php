<?php

namespace App\Controllers\NFe;

use App\Controllers\BaseController;
use App\Models\NFeTempModel;
use CodeIgniter\Model;
use PHPUnit\Exception;

class CadastroNFe extends BaseController
{
    public function create()
    {
        $model = new NFeTempModel();
        helper('form');

        try {
            $model->save([
                "status_id" => $this->request->getVar('status_id'),
                "numero_nfe" => $this->request->getVar('numero_nfe'),
                "ide_serie" => $this->request->getVar('ide_serie'),
                "empresa_id" => $this->request->getVar('empresa_id'),
                "cliente_id" => $this->request->getVar('cliente_id'),
                "pedidos_id" => $this->request->getVar('pedidos_id'),
            ]);

            return 'NFe cadastrada com sucesso';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
