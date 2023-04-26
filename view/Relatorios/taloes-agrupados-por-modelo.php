<?php

use Dam\Atelier\Entity\Empresa\Empresa;
use Dam\Atelier\Entity\Modelo\Talao\Talao;
use Dam\Atelier\Model\Funcoes\Calcular;
use Dam\Atelier\Model\Funcoes\Paginacao;

include __DIR__ . '/../Componentes/inicio-html.php';

$paginacao = new Paginacao($taloes);
?>
    <div class="container">
    <div class="text-start my-3 mx-3">
        <img class='float-end'
             style="max-height: 10rem; max-width: 15rem"
             src='/visualizar-logo?id=<?=$_SESSION["empresa"]?>}'>
        Relatório de talões
        <br>
        <b><?=$empresa->getDescricao()?></b>
        - <?= $dataAtual->format('d/m/Y H:i') ?>
    </div>
    <hr>
    <table class="table table-sm table-bordered">
        <thead class="table relatorio">
            <tr>
                <th scope="col" style="width: 10%">Modelo</th>
                <th scope="col">Talão</th>
            </tr>
        </thead>
    <tbody>
<?php foreach ($modelos as $modelo) :?>
    <tr>
        <td class="text-center">
            <b><?= $modelo->getModelo() ?></b>
            <?php if ($modelo->getImagemModelo() !== null) :?>
            <br>
            <img style="max-height: 10rem; max-width: 15rem" src='/visualizar-img?id=<?=$modelo->getId()?>}'>
            <?php endif ?>
        </td>
        <td>
            <table class="table table-striped table-sm m-0 table-bordered">
                <thead class="table relatorio">
                <tr>
                    <th scope="col" style="width: 5%">#</th>
                    <th scope="col" style="width: 10%">Quantidade</th>
                    <th scope="col" style="width: 10%">Semana</th>
                    <th scope="col" style="width: 10%">Entrada</th>
                    <th scope="col" style="width: 20%">Saída</th>
                    <th scope="col">Nota</th>
                    <th style="width: 3%" scope="col" class="text-center">Saída?</th>
                </tr>
                </thead>
                <tbody>
                    <?php $qtd = 0; foreach ($taloes as $talao): ?>
                    <?php if($modelo->getId() == $talao->getModelo()->getId()) : ?>
                    <tr>
                        <td scope="row"><?= $talao->getId(); ?></td>
                        <td><?= $talao->getQuantidade(); ?></td>
                        <td><?= $talao->getSemana(); ?></td>
                        <td><?= $talao->getDataEntrada()->format('d/m/Y'); ?></td>
                        <td><?= $talao->getDataSaida(); ?></td>
                        <td><?= $talao->getNotaFiscal() ?></td>
                        <td class="text-center">
                            <?php $qtd += $talao->getQuantidade();
                            if ($talao->getDataSaida()): ?>
                                Sim
                            <?php else: ?>
                                Não
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endif;?>
                    <?php endforeach; ?>
                </tbody>
            <tfoot class="table relatorio">
            <td colspan="7" class="text-end">
                Total: <?= $qtd ?>
            </td>
            </tfoot>
            </table>
        </td>
            <?php endforeach; ?>
            </tbody>
                <tfoot class="text-start table relatorio">
                    <td colspan="8" class="justify-content-between">
                        <span class="float-end mx-2">
                            <strong>Total: </strong>
                            <?= number_format($paginacao->getTotalItens(),
                                0, ',', '.'); ?>
                                registros
                        </span>
                    </td>
                </tfoot>
            </table>
            </div>
            <?php include __DIR__ . '/../Componentes/fim-html.php'; ?>