<div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="d-flex justify-content-between align-items-stretch card-header">
            <form action="/admin/usuarios" method="post" class="d-flex">
                <input type="text"
                       name="busca"
                       id="busca"
                       placeholder="Usuário"
                       autofocus
                       style="height: 82%"
                       class="form-control-sm">
                <?= csrf_field(); ?>
                <button class="btn btn-primary text-light mb-2 ms-2" type="submit">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </form>
            <div>
                <a type="button" href="/admin/novo-usuario" class="btn btn-primary text-light mb-2">
                    <i class="bi bi-plus-circle-fill primary bi-align-middle"> Novo</i>
                </a>
            </div>
        </div>
    <div class="card-body">
        <table class="table table-bordered dataTable table-striped">
            <thead>
                <tr role="row">
                    <th style="width: 2%" class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                    <th style="width: 20%" class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Usuário</th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Funcionário</th>
                    <th style="width: 10%" class="sorting text-center" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="3" aria-sort="ascending" aria-label="Name: activate to sort column descending">Ações</th>
                </tr>
            </thead>
            <tbody class="table table-striped">
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <th><?= $usuario['id']; ?></th>
                    <td><?= $usuario['usuario']; ?></td>
                    <td><?= $usuario['funcionario']['nome'] ?? '' ?></td>
                    <td class="text-right px-0">
                        <a href="/admin/alterar-permissoes?id=<?= $usuario['id'] ?>" ><i class="fas fa-list"></i></a>
                        <a href="/admin/alterar-usuario?id=<?= $usuario['id'] ?>" ><i class="fas fa-edit"></i></a>
                        <a href="/admin/excluir-usuario?id=<?= $usuario['id'] ?>" onclick="return confirm('Deseja mesmo excluir a usuário <?= $usuario['usuario'] ?>?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links(); ?>
        </div>
    </div>
</div>