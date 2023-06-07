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
        <form action="<?= base_url('notas/salvar-nfe') ?>" method="post">
            <div class="card-body">
                <div class="tab-content">
                    <div hidden>
                        <input id="empresa_id" name="empresa_id" value="<?= session()->get('empresa')['id'] ?>">
                    </div>
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
                                    <?= \Config\Services::validation()->getError('busca') ?>
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
                                    <?= \Config\Services::validation()->getError('nfe') ?>
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
                                    <?= \Config\Services::validation()->getError('serie') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="cliente_id" class="col-form-label-sm">Cliente</label>
                                <div class="input-group">
                                    <input type="text"
                                           name="cliente_id"
                                           id="cliente_id"
                                           autofocus
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('cliente_id') ?>
                                </small>
                            </div>
                        </div>
                        <div class="mt-3">
                            Itens da NF-e
                        </div>
                        <hr class="mt-1 mb-3">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="produto_id" class="col-form-label-sm">Produto</label>
                                <div class="input-group">
                                    <input type="text"
                                           name="produto_id"
                                           id="produto_id"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('produto_id') ?>
                                </small>
                            </div>
                            <div class="col-2">
                                <label for="prod_qCom" class="">Quantidade</label>
                                <div class="input-group">
                                    <input type="number"
                                           id="prod_qCom"
                                           name="prod_qCom"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('prod_qCom') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="prod_vProd" class="">Valor</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="prod_vProd"
                                           name="prod_vProd"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('prod_vProd') ?>
                                </small>
                            </div>
                            <div class="col-sm-2 form-group mt-sm-4">
                                <button class="btn-sm btn-outline-success mx-sm-3 border-success" type="button"
                                        onclick="adicionarItem()">
                                    <i class="fa fa-plus"></i> Adicionar
                                </button>
                            </div>
                        </div>
                        <table id="itensNfeTable" class="table-sm table dataTable table-striped mb-3 w-100">
                            <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0">Produto</th>
                                <th style="width: 20%" class="sorting" tabindex="0">Quantidade</th>
                                <th style="width: 20%" class="sorting" tabindex="0">Valor</th>
                                <th style="width: 6%" class="sorting" tabindex="0">Ações</th>
                            </tr>
                            </thead>
                            <tbody class="table-sm table-striped">

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
                    <button type="button" onclick="cancelar('notas')"
                            class="btn btn-light border-secondary mt-2 fixed" style="margin-right: 1rem;">
                        <i class="fa fa-arrow-left"></i> Voltar</button>
                    <button class="btn btn-primary mt-2 fixed"><i class="fa fa-save"></i> Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    function adicionarItem() {
    // Captura os valores dos campos de entrada
    var produto = $('#produto_id').val();
    var quantidade = $('#prod_qCom').val();
    var valor = $('#prod_vProd').val();

    // Cria uma nova linha para a tabela
    var newRow = $('<tr>');
        newRow.append('<td><input type="hidden" name="produto_id[]" value="' + produto + '">' + produto + '</td>');
        newRow.append('<td><input type="hidden" name="prod_qCom[]" value="' + quantidade + '">' + quantidade + '</td>');
        newRow.append('<td><input type="hidden" name="prod_vProd[]" value="' + valor + '">' + valor + '</td>');
        newRow.append('<td><i class="fas fa-edit text-primary"></i> <i class="fas fa-trash text-danger"></i></td>');

    // Adiciona a nova linha à tabela
    $('#itensNfeTable tbody').append(newRow);

    // Limpa os campos de entrada após adicionar o item à tabela
    $('#produto_id').val('');
    $('#prod_qCom').val('');
    $('#prod_vProd').val('');
}
</script>
