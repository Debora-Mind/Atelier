<!-- Begin Page Content -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <div class="card shadow row w-100 mb-2">
                <div class="d-flex card-header">
                    Talão
                </div>
                <form action="<?= base_url('producao/taloes/saida-formulario') ?>" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label for="codigo_barras" class="col-form-label-sm">Cód. Barras</label>
                                    <input type="text"
                                           name="codigo_barras"
                                           id="codigo_barras"
                                           autocomplete="off"
                                           autofocus
                                           class="form-control">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('codigo_barras') ?>
                                </small>
                            </div>
                            <div class="col-2">
                                <label for="producao_sublote" class="col-form-label-sm">Produção/Sublote</label>
                                <input name="producao_sublote"
                                       id="producao_sublote"
                                       class="form-control">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('producao_sublote') ?>
                                </small>
                            </div>
                            <div class="form-group mt-sm-4">
                                <?= csrf_field(); ?>
                                <button class="btn-sm btn-primary text-light mx-sm-3" type="submit">
                                    <i class="bi bi-box-seam"></i> Saída
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card shadow row w-100 mt-2">
                <div class="d-flex card-header">
                    Últimas saídas
                </div>
                <div class="card-body">
                    <table class="table-sm table dataTable mb-3 w-100">
                        <thead>
                            <tr role="row">
                                <th style="width: 3%" class="sorting" tabindex="0">#</th>
                                <th class="sorting" tabindex="0">Referência</th>
                                <th style="width: 8%" class="sorting" tabindex="0">Produção</th>
                                <th style="width: 8%" class="sorting" tabindex="0">Sublote</th>
                                <th style="width: 8%" class="sorting" tabindex="0">Semana</th>
                                <th style="width: 8%" class="sorting" tabindex="0">Quantidade</th>
                                <th style="width: 10%" class="sorting" tabindex="0">Entrada</th>
                                <th style="width: 15%" class="sorting" tabindex="0">Saída</th>
                                <th style="width: 12%" class="sorting text-center" tabindex="0">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="table-sm table-striped">
                            <?php foreach ($taloesLista as $talao): ?>
                            <tr id="linha-<?php echo $talao['id']; ?>" class="table-success">
                                <input type="hidden" name="id" id="id" value="<?= $talao['id'] ?>">
                                <td><?= $talao['id']; ?></td>
                                <td><?= $talao['descricao_produto']; ?></td>
                                <td><?= $talao['num_producao']; ?></td>
                                <td><?= $talao['sublote']?></td>
                                <td><?= $talao['semana']?></td>
                                <td><?= $talao['quantidade']?></td>
                                <td><?= (new DateTime($talao['data_entrada']))->format('d/m/Y') ?></td>
                                <td><?= $talao['data_saida'] != '0000-00-00 00:00:00'
                                        ? (new DateTime($talao['data_saida']))->format('d/m/Y - H:i') : ''?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('producao/taloes/saida?id=' . $talao['id']) ?>">
                                        <i class="fa fa-check-circle text-secondary disabled mx-1"></i>
                                    </a>
                                    <?php if($talao['img']): ?>
                                        <a href="<?= base_url('producao/visualizar-imagem?id=' . $talao['id_produto']) ?>"
                                           target="_blank">
                                            <i class="fa fa-eye text-primary mx-1"></i>
                                        </a>
                                    <?php else: ?>
                                        <i class="fa fa-eye text-secondary disabled mx-1"></i>
                                    <?php endif; ?>
                                    <?php if($talao['pdf']): ?>
                                        <a href="<?= base_url('producao/visualizar-pdf?id=' . $talao['id_produto']) ?>"
                                           target="_blank">
                                            <i class="fa fa-file-pdf text-primary mx-1"></i>
                                        </a>
                                    <?php else: ?>
                                        <i class="fa fa-file-pdf text-secondary disabled mx-1"></i>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="row w-100">
                <div class="card shadow bg-gradient-danger text-light mx-3 w-100 mb-1">
                    <div class="card-header bg-danger">
                        Meta dia
                    </div>
                    <div class="card-body mt-1">
                        <li>Total: <?= $metaDia ?? 0 ?></li>
                        <ul>
                            <?php foreach ($produtosMeta as $produto): ?>
                            <li><?= $produto['descricao_produto'] . ': ' . $produto['meta'] ?> </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row w-100">
                <div class="card shadow bg-gradient-primary text-light mx-3 w-100 mt-1">
                    <div class="card-header bg-primary">
                        Resultado dia
                    </div>
                    <div class="card-body mt-1">
                        <li>Total: <?= $resultadoTotal ?? 0 ?></li>
                        <ul>
                            <?php foreach ($produtosResultado as $produto): ?>
                            <li> <?= $produto['descricao_produto'] . ': ' . $produto['quantidade'] ?> </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row w-100 mt-2">
                <?php include __DIR__ . '/../painel/graficos/meta-atingida.php' ?>
                <div class="w-100" id="donutchart"></div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

