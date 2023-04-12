<?php

namespace Dam\Atelier\Model\Funcoes;

use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Model\Funcoes;

class Calcular
{
    use Funcoes;

    public function corDaLinha(Modelo $modelo): string
    {
        $dataModelo = $modelo->getDataEntrada();
        $dataAtual = new \DateTime();
        $intervalo = $dataAtual->diff($dataModelo)->days - 1;

        $diasAtencao = 5;
        $diasCautela = 3;

        if ($modelo->getDataSaida()) {
            return "class='table-success'";
        } elseif ($intervalo >= $diasAtencao) {
            return "class='table-danger'";
        } elseif ($intervalo >= $diasCautela) {
            return "class='table-warning'";
        } else {
            return "class='table-light'";
        }
    }

}