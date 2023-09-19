<div class="col-sm-12">
    <div class="card shadow">
        <div class="d-flex justify-content-sm-between align-items-sm-stretch card-header">
                Buscar Produto
        </div>
        <form action="<?= base_url('producao/produtos') ?>" method="post">
            <div class="card-body">
                <div class="row w-100">
                    <div class="d-inline-flex col-12">
                        <div class="col-12 form-group">
                            <label for="busca" class="col-form-label">Produto</label>
                            <input type="text"
                                   name="busca"
                                   id="busca"
                                   autofocus
                                   class="input-group-sm shadow-sm col-12">
                        </div>
                    </div>
                    <div class="d-inline-flex col-12">
                        <div class="col-4">
                            <label for="nfe" class="">Empresa</label>
                            <input type="text"
                                   id="nfe"
                                   name="nfe"
                                   class="input-group-sm shadow-sm w-100">
                        </div>
                        <div class="col-4 form-group">
                            <label for="serie" class="">Referência</label>
                            <input type="text"
                                   id="serie"
                                   name="serie"
                                   class="input-group-sm shadow-sm w-100">
                        </div>
                        <div class="col-4 form-group">
                            <label for="modelo" class="">Código de Barras</label>
                            <input type="text"
                                   id="modelo"
                                   name="modelo"
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
                        <a href="<?= base_url('producao/produtos/formulario') ?>">
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
                        <th style="width: 10%" class="sorting" tabindex="0">#</th>
                        <th class="sorting" tabindex="0">Produto</th>
                        <th style="width: 10%" class="sorting" tabindex="0">Unidade</th>
                        <th style="width: 20%" class="sorting" tabindex="0">Valor</th>
                        <th style="width: 10%" class="sorting text-center" tabindex="0">Ações</th>
                    </tr>
                </thead>
                <tbody class="table-sm table-striped">
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <input type="hidden" name="id" id="id" value="<?= $produto['id'] ?>">
                        <td><?= $produto['id']; ?></td>
                        <td><?= $produto['xProd']; ?></td>
                        <td><?= $produto['uCom_Saida']?></td>
                        <td><?= $produto['valor']?></td>
                        <td>
                            <?php if($produto['img']): ?>
                            <a href="<?= base_url('producao/visualizar-imagem?id=' . $produto['id']) ?>"
                                target="_blank">
                                <i class="fa fa-eye text-primary mx-1"></i>
                            </a>
                            <?php else: ?>
                                <i class="fa fa-eye text-secondary disabled mx-1"></i>
                            <?php endif; ?>
                            <?php if($produto['pdf']): ?>
                            <a href="<?= base_url('producao/visualizar-pdf?id=' . $produto['id']) ?>"
                                target="_blank">
                                <i class="fa fa-file-pdf text-primary mx-1"></i>
                            </a>
                            <?php else: ?>
                                <i class="fa fa-file-pdf text-secondary disabled mx-1"></i>
                            <?php endif; ?>
                            <a href="<?= base_url('producao/editar-produto?id=' . $produto['id']) ?>">
                                <i class="fa fa-edit text-primary mx-1"></i>
                            </a>
                            <a href="<?= base_url('producao/produtos/remover?id=' . $produto['id']) ?> "
                               onclick="return confirm('Deseja mesmo excluir a produto <?= $produto['cod_fabrica'] ?>?')">
                                <i class="fa fa-trash text-danger mx-1"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links(); ?>
        </div>
    </div>
</div>
