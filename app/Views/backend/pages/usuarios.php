<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Usuários</h1>

    <?php if ($msg): ?>
        <div class="alert alert-info p-3 my-3">
            <?= $msg ?>
        </div>
    <?php endif; ?>

    <div class="p-3 my-3 text-danger">
        <?= \Config\Services::validation()->listErrors(); ?>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Inserir Usuários</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/usuarios/gravar') ?>" method="post">

                        <div class="form-group">
                            <label for="usuario">Usuário</label>
                            <input class="form-control" type="input" name="usuario"/>
                        </div>

                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input class="form-control" type="password" name="senha"/>
                        </div>
                        <?= csrf_field(); ?>
                        <input type="submit" name="submit" class="btn btn-primary" value="Inserir" />
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Usuários Cadastrados</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered dataTable table-striped" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                        <thead>
                        <tr role="row">
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Usuário</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Alterar Senha</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Excluir</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                        <tr role="row" class="odd">
                            <td class="sorting_1"><?= $usuario['user'] ?></td>
                            <td><a href="#" data-toggle="modal" data-target="#Modal<?= $usuario['id'] ?>"><i class="fas fa-key"></i> Mudar Senha</a></td>
                            <td><a href="/admin/usuarios/excluir/<?= $usuario['id'] ?>" onclick="return confirm('Deseja mesmo excluir o usuário <?= $usuario['user'] ?>?')"><i class="fas fa-trash"></i> Excluir</a></td>
                        </tr>

                        <!-- Alterar Senha Modal-->
                        <div class="modal fade" id="Modal<?= $usuario['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Alterar Senha do Usuário</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= base_url('admin/usuarios/editarSenha') ?>" method="post">
                                            <div class="form-group">
                                                <label for="senha">Nova Senha</label>
                                                <input class="form-control" type="password" name="senha"/>
                                                <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                                            </div>
                                            <?= csrf_field(); ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Alterar" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $pager->links(); ?>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->