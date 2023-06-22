<div class="col-sm-12">
    <div class="card shadow">
        <div class="d-flex justify-content-sm-between align-items-sm-stretch card-header">
                Buscar Talão
        </div>
        <form action="<?= base_url('producao/listar-taloes') ?>" method="post">
            <div class="card-body">
                <div class="row w-100">
                    <div class="d-inline-flex col-12">
                        <div class="col-12 form-group">
                            <label for="busca" class="col-form-label">Talão</label>
                            <input type="text"
                                   name="busca"
                                   id="busca"
                                   autofocus
                                   class="input-group-sm shadow-sm col-12">
                        </div>
                    </div>
                    <div class="d-inline-flex col-12">
                        <div class="col-6 form-group">
                            <label for="modelo" class="">Código de Barras</label>
                            <input type="text"
                                   id="modelo"
                                   name="modelo"
                                   class="input-group-sm shadow-sm w-100">
                        </div>
                        <div class="col-6 form-group">
                            <label for="serie" class="">Nota Fiscal</label>
                            <input type="text"
                                   id="serie"
                                   name="serie"
                                   class="input-group-sm shadow-sm w-100">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer pt-2 pb-0">
                <div class="row w-100">
                    <div class="form-group">
                        <?= csrf_field(); ?>
                        <button class="btn-sm btn-primary text-light mx-sm-3" type="submit">
                            <i class="bi bi-search"></i> Buscar
                        </button>
                    </div>
                    <div class="form-group">
                        <a href="<?= base_url('producao/talao/formulario') ?>">
                            <button class="btn-sm btn-light mx-sm-3 border-primary" type="button">
                                <i class="bi bi-plus-circle-fill bi-align-middle"></i> Cadastrar
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card shadow mt-1">
        <div class="card-body mt-2">
            <table class="table-sm table dataTable table-striped mb-3 w-100">
                <thead>
                    <tr role="row">
                        <th style="width: 3%" class="sorting" tabindex="0">#</th>
                        <th class="sorting" tabindex="0">Referência</th>
                        <th style="width: 10%" class="sorting" tabindex="0">Produção</th>
                        <th style="width: 20%" class="sorting" tabindex="0">Sublote</th>
                        <th style="width: 10%" class="sorting text-center" tabindex="0">Semana</th>
                        <th style="width: 10%" class="sorting text-center" tabindex="0">Quantidade</th>
                        <th style="width: 10%" class="sorting text-center" tabindex="0">Entrada</th>
                        <th style="width: 10%" class="sorting text-center" tabindex="0">Saída</th>
                        <th style="width: 10%" class="sorting text-center" tabindex="0">Ações</th>
                    </tr>
                </thead>
                <tbody class="table-sm table-striped">
                <?php foreach ($taloes as $talao): ?>
                    <tr>
                        <input type="hidden" name="id" id="id" value="<?= $talao['id'] ?>">
                        <td><?= $talao['modelo_id']; ?></td>
                        <td><?= $talao['num_producao']; ?></td>
                        <td><?= $talao['sublote']?></td>
                        <td><?= $talao['semana']?></td>
                        <td><?= $talao['quantidade']?></td>
                        <td><?= $talao['data_entrada']?></td>
                        <td><?= $talao['data_saida']?></td>
<!--                        <td>-->
<!--                            --><?php //if($talao['img']): ?>
<!--                            <a href="--><?//= base_url('producao/visualizar-imagem?id=' . $talao['id']) ?><!--"-->
<!--                                target="_blank">-->
<!--                                <i class="fa fa-eye text-primary mx-1"></i>-->
<!--                            </a>-->
<!--                            --><?php //else: ?>
<!--                                <i class="fa fa-eye text-secondary disabled mx-1"></i>-->
<!--                            --><?php //endif; ?>
<!--                            --><?php //if($talao['pdf']): ?>
<!--                            <a href="--><?//= base_url('producao/visualizar-pdf?id=' . $talao['id']) ?><!--"-->
<!--                                target="_blank">-->
<!--                                <i class="fa fa-file-pdf text-primary mx-1"></i>-->
<!--                            </a>-->
<!--                            --><?php //else: ?>
<!--                                <i class="fa fa-file-pdf text-secondary disabled mx-1"></i>-->
<!--                            --><?php //endif; ?>
<!--                            <a href="--><?//= base_url('producao/editar-produto?id=' . $talao['id']) ?><!--">-->
<!--                                <i class="fa fa-edit text-primary mx-1"></i>-->
<!--                            </a>-->
<!--                            <a href="--><?//= base_url('producao/produtos/remover?id=' . $talao['id']) ?><!-- "-->
<!--                               onclick="return confirm('Deseja mesmo excluir a produto --><?//= $talao['cod_fabrica'] ?>//?')">
//                                <i class="fa fa-trash text-danger mx-1"></i>
//                            </a>
//                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links(); ?>
        </div>
    </div>
</div>
