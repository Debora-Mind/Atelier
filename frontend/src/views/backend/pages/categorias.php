<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Categorias</h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Inserir Categorias</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/categorias/gravar') ?>" method="post">

                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input class="form-control" name="titulo" id="titulo"/>
                        </div>

                        <div class="form-group">
                            <label for="resumo">Resumo</label>
                            <input class="form-control" name="resumo" id="resumo"/>
                        </div>

                        <input type="hidden" value="" name="id">
                        <?= csrf_field(); ?>
                        <input type="submit" name="submit" class="btn btn-primary" value="Inserir" />
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Categorias Cadastrados</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered dataTable table-striped" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                        <thead>
                        <tr role="row">
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Categorias</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Alterar</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Excluir</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($categorias as $categoria): ?>
                        <tr role="row" class="odd">
                            <td class="sorting_1"><?= $categoria['titulo'] ?></td>
                            <td><a href="/admin/categorias/editar/<?= $categoria['id'] ?>" ><i class="fas fa-edit"></i> Alterar</a></td>
                            <td><a href="/admin/categorias/excluir/<?= $categoria['id'] ?>" onclick="return confirm('Deseja mesmo excluir a categoria <?= $categoria['titulo'] ?>?')"><i class="fas fa-trash"></i> Excluir</a></td>
                        </tr>
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