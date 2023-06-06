<div class="col-sm-12">
    <div class="card shadow">
        <div class="d-flex justify-content-sm-between align-items-sm-stretch card-header">
            Buscar Cliente
        </div>
        <form action="<?= base_url('empresa/clientes') ?>" method="post">
            <div class="card-body">
                <div class="row w-100">
                    <div class="d-inline-flex col-12">
                        <div class="col-4">
                            <label for="cliente" class="">Cliente</label>
                            <input type="text"
                                   id="cliente"
                                   name="cliente"
                                   class="input-group-sm shadow-sm w-100">
                        </div>
                        <div class="col-4 form-group">
                            <label for="cpf_cnpj" class="">CPF/CNPJ</label>
                            <input type="text"
                                   id="cpf_cnpj"
                                   name="cpf_cnpj"
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
                        <a href="<?= base_url('empresa/formulario-cliente') ?>">
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
                    <th class="sorting" tabindex="0">Cliente</th>
                    <th style="width: 20%" class="sorting" tabindex="0">CPF/CNPJ</th>
                    <th style="width: 10%" class="sorting text-center" tabindex="0">Ações</th>
                </tr>
                </thead>
                <tbody class="table-sm table-striped">
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <input type="hidden" name="id" id="id" value="<?= $cliente['id'] ?>">
                        <td><?= $cliente['id']; ?></td>
                        <td><?= $cliente['nome_razao_social']; ?></td>
                        <td><?= $cliente['cpf_cnpj']?></td>
                        <td>
                            <a href="<?= base_url('empresa/editar-cliente?id=' . $cliente['id']) ?>">
                                <i class="fa fa-edit text-primary mx-1"></i>
                            </a>
                            <a href="<?= base_url('empresa/remover-cliente?id=' . $cliente['id']) ?> "
                               onclick="return confirm('Deseja mesmo excluir o cliente <?= $cliente['nome_razao_social'] ?>?')">
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
