<?php

namespace Dam\Atelier\Model\Funcoes;

use Dam\Atelier\Entity\Configuracao\ConfiguracaoGeral;
use Dam\Atelier\Entity\Modelo\Modelo;
use Dam\Atelier\Model\Funcoes;
use Doctrine\ORM\EntityManagerInterface;

class Calcular
{
    use Funcoes;

    public function corDaLinha(Modelo $modelo, EntityManagerInterface $entityManager): string
    {
        $configuracoes = $entityManager->getRepository(ConfiguracaoGeral::class);
        $dataModelo = $modelo->getDataEntrada();
        $dataAtual = new \DateTime();
        $intervalo = $dataAtual->diff($dataModelo)->days - 1;

        $diasAtencao = $configuracoes->find(1);
        $diasAtencao = $diasAtencao->getAtivo() ? $diasAtencao->getNumero() : null;
        $diasCautela = $configuracoes->find(2);
        $diasCautela = $diasCautela->getAtivo() ? $diasCautela->getNumero() : null;

        if ($modelo->getDataSaida()) {
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