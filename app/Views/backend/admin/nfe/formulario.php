<div class="col-sm-12">
    <div class="card shadow">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" data-bs-toggle="tab" href="#aba1">Principal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#aba2">Outros</a>
                </li>
            </ul>
        </div>
        <form action="<?= base_url('admin/empresa/salvar-empresa') ?>" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="tab-content">
                    <!--  Principal  -->
                    <div id="aba1" class="tab-pane fade m-3 show active">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="busca" class="col-form-label-sm">Empresa</label>
                                <div class="input-group">
                                    <input type="text"
                                           name="busca"
                                           id="busca"
                                           disabled
                                           value="<?= session()->get('empresa')['nome_fantasia'] ?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('logomarca') ?>
                                </small>
                            </div>
                            <div class="col-3">
                                <label for="nfe" class="">Série</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="nfe"
                                           name="nfe"
                                           disabled
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('logomarca') ?>
                                </small>
                            </div>
                            <div class="col-3 form-group">
                                <label for="serie" class="">Número NF-e</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="serie"
                                           name="serie"
                                           disabled
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('logomarca') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="busca" class="col-form-label-sm">Cliente</label>
                                <div class="input-group">
                                    <input type="text"
                                           name="busca"
                                           id="busca"
                                           autofocus
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('logomarca') ?>
                                </small>
                            </div>
                        </div>
                        <div class="mt-3">
                            Itens da NF-e
                        </div>
                        <hr class="mt-1 mb-3">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="busca" class="col-form-label-sm">Produto</label>
                                <div class="input-group">
                                    <input type="text"
                                           name="busca"
                                           id="busca"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('logomarca') ?>
                                </small>
                            </div>
                            <div class="col-2">
                                <label for="nfe" class="">Quantidade</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="nfe"
                                           name="nfe"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('logomarca') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="serie" class="">Valor</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="serie"
                                           name="serie"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('logomarca') ?>
                                </small>
                            </div>
                            <div class="col-sm-2 form-group mt-sm-4">
                                <a href="">
                                    <button class="btn-sm btn-outline-success mx-sm-3 border-success pb-2" type="button" style="height: 80%">
                                        <i class="fa fa-plus"></i> Adicionar
                                    </button>
                                </a>
                            </div>
                        </div>
                        <table class="table-sm table dataTable table-striped mb-3 w-100">
                            <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0">Produto</th>
                                <th style="width: 20%" class="sorting" tabindex="0">Quantidade</th>
                                <th style="width: 20%" class="sorting" tabindex="0">Valor</th>
                                <th style="width: 6%" class="sorting" tabindex="0">Ações</th>
                            </tr>
                            </thead>
                            <tbody class="table-sm table-striped">
                            <?php foreach ($itensNfe as $itemNfe): ?>
                                <tr>
                                    <input type="hidden" name="id" id="id" value="<?= $itemNfe['id'] ?>">
                                    <th>
                                        <select name="acoes">
                                            <option href="/admin/nfe/transmitir">
                                                <i class="fa-server"></i> Transmitir
                                            </option>
                                        </select>
                                    </th>
                                    <td><?= $itemNfe['prod_cProd']; ?></td>
                                    <td><?= $itemNfe['prod_qCom']?></td>
                                    <td><?= $itemNfe['prod_vProd']?></td>
                                    <td>
                                        <i class="fas fa-edit text-primary"></i>
                                        <i class="fas fa-trash text-danger"></i>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!--  Outros  -->
                    <div id="aba2" class="tab-pane fade m-3">
                        <div class="row">
                            <div class="col-sm-3 form-group">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-sm-3 form-group">

                            </div>
                            <div class="col col-sm-1 form-group">

                            </div>
                            <div class="col col-sm-2 form-group">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-sm-2 form-group">

                            </div>
                            <div class="col-sm-2 form-group">

                            </div>
                            <div class="col col-sm-2 form-group">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= csrf_field(); ?>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" onclick="cancelar('admin/nfe')"
                            class="btn btn-light border-secondary mt-2 fixed" style="margin-right: 1rem;">
                        <i class="fa fa-arrow-left"></i></i> Voltar</button>
                    <button class="btn btn-primary mt-2 fixed"><i class="fa fa-save"></i> Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>