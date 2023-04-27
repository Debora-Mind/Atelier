<?php

use Dam\Atelier\Entity\Empresa\Empresa;
use Dam\Atelier\Entity\Modelo\Talao\Talao;
use Dam\Atelier\Model\Funcoes\Calcular;
use Dam\Atelier\Model\Funcoes\Paginacao;

include __DIR__ . '/../Componentes/inicio-html.php';

$paginacao = new Paginacao($_SESSION['itens']);
?>
    <div class="container">
    <div class="text-start my-3 mx-3">
        <img class='float-end mb-2'
             style="max-height: 10rem; max-width: 15rem"
             src='/visualizar-logo?id=<?=$_SESSION["empresa"]?>}'>
        Relatório de talões
        <br>
        <b><?=$empresa->getDescricao()?></b>
        - <?= $dataAtual->format('d/m/Y H:i') ?>
    </div>
    <table class="table table-sm table-bordered border-dark">
        <thead class="table relatorio">
            <tr>
                <th scope="col" style="width: 10%">Modelo</th>
                <th scope="col">Talão</th>
            </tr>
        </thead>
    <tbody class="relatorio-body">
<?php foreach ($modelos as $modelo) :?>
<?php if(in_array($modelo->getId(), $modelosId)) :?>
    <tr>
        <td class="text-center align-middle">
            <div><?php if ($modelo->getImagemModelo() !== null) :?></div>
            <img style="max-height: 10rem; max-width: 15rem" src='/visualizar-img?id=<?=$modelo->getId()?>}' class="mt-1">
            <b class="mb-1"><?= $modelo->getModelo() ?></b>
            <?php endif ?>
        </td>
        <td>
            <table class="table table-striped table-sm my-1 table-bordered">
                <thead class="table relatorio">
                <tr>
                    <th scope="col" style="width: 5%">#</th>
                    <th scope="col" style="width: 5%">Rel.Prod.</th>
                    <th scope="col" style="width: 5%">Sub.Lote</th>
                    <th scope="col" style="width: 10%">Semana</th>
                    <th scope="col">Nota</th>
                    <th style="width: 3%" scope="col" class="text-center">Saída?</th>
                    <th scope="col" style="width: 5%" class="text-end">Qtd</th>
                </tr>
                </thead>
                <tbody class="relatorio-body">
                    <?php $qtd = 0; foreach ($_SESSION['itens'] as $talao): ?>
                    <?php if($modelo->getId() == $talao->getModelo()->getId()) : ?>
                    <tr>
                        <td scope="row"><?= $talao->getId(); ?></td>
                        <td><?= $talao->getProducao(); ?></td>
                        <td><?= $talao->getSubLote(); ?></td>
                        <td><?= $talao->getSemana(); ?></td>
                        <td><?= $talao->getNotaFiscal() ?></td>
                        <td class="text-center">
                            <?php $qtd += $talao->getQuantidade();
                            if ($talao->getDataSaida() != null): ?>
                                Sim
                            <?php else: ?>
                                Não
                            <?php endif; ?>
                        </td>
                        <td class="text-end"><?= $talao->getQuantidade(); ?></td>
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
    <?php endif; ?>
    <?php endforeach; ?>
        </tbody>
            <tfoot class="text-start table relatorio">
                <td colspan="8" class="justify-content-between">
                    <span class="float-end mx-2">
                        <strong>Quantidade Total: </strong>
                        <?= number_format($paginacao->getQuantidadeTotal(),
                            0, ',', '.'); ?>
                    </span>
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