<?php

namespace Dam\Atelier\Model\Funcoes;

use Dam\Atelier\Entity\Configuracao\ConfiguracaoGeral;
use Dam\Atelier\Entity\Empresa\Empresa;
use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Model\Funcoes;
use Doctrine\ORM\EntityManagerInterface;

class Calcular
{
    use Funcoes;

    public function corDaLinha($objeto, Empresa $empresa, EntityManagerInterface $entityManager): string
    {
        $configuracoes = $entityManager->getRepository(ConfiguracaoGeral::class);
        $dataModelo = $objeto->getDataEntrada();
        $dataAtual = new \DateTime();
        $intervalo = $dataAtual->diff($dataModelo)->days;

        $diasAtencao = $empresa->getConfiguracoes()['1'][0] ? $empresa->getConfiguracoes()['1'][1] : null;
        $diasCautela = $empresa->getConfiguracoes()['2'][0] ? $empresa->getConfiguracoes()['2'][1] : null;

        if ($objeto->getDataSaida()) {
            return "class='table-success'";
        } elseif ($diasAtencao && $intervalo >= $diasAtencao) {
            return "class='table-danger'";
        } elseif ($diasCautela && $intervalo >= $diasCautela) {
            return "class='table-warning'";
        } else {
            return "class='table-light'";
        }
    }

}