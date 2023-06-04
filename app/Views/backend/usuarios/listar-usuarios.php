<div class="col-sm-12">
    <div class="card shadow">
        <div class="d-flex justify-content-sm-between align-items-sm-stretch card-header">
            <form action="/usuarios" method="post" class="d-flex">
                <input type="text"
                       name="busca"
                       id="busca"
                       placeholder="Usuário"
                       autofocus
                       style="height: 82%"
                       class="input-group-sm shadow-sm">
                <?= csrf_field(); ?>
                <button class="btn-sm btn-primary text-light mb-sm-2 mx-sm-3" type="submit">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </form>
            <div>
                <a href="<?= base_url('usuarios/formulario') ?>">
                    <button class="btn-sm btn-primary text-light mb-sm-2">
                        <i class="bi bi-plus-circle-fill primary bi-align-middle"> Novo</i>
                    </button>
                </a>
            </div>
        </div>
    <div class="card-body">
        <table class="table-sm table-bordered dataTable table-striped mb-3 w-100">
            <thead>
                <tr role="row">
                    <th style="width: 4%" class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                    <th style="width: 20%" class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Usuário</th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Funcionário</th>
                    <th style="width: 10%" class="sorting text-center" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="3" aria-sort="ascending" aria-label="Name: activate to sort column descending">Ações</th>
                </tr>
            </thead>
            <tbody class="table-sm table-striped">
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <th><?= $usuario['id']; ?></th>
                    <td><?= $usuario['usuario']; ?></td>
                    <td><?= $usuario['funcionario']['nome'] ?? '' ?></td>
                    <td class="text-center">
                        <a href="<?= base_url('usuarios/alterar-permissoes?id=' . $usuario['id']) ?>" ><i class="fas fa-list"></i></a>
                        <a href="<?= base_url('usuarios/formulario?id=' . $usuario['id']) ?>" ><i class="fas fa-edit"></i></a>
                        <a href="<?= base_url('usuarios/excluir-usuario?id=' . $usuario['id']) ?>"
                           onclick="return confirm('Deseja mesmo excluir a usuário <?= $usuario['usuario'] ?>?')">
                            <i class="fas fa-trash"></i>
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