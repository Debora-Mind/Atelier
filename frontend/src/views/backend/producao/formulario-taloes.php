<div class="col-sm-12">
    <div class="card shadow">
        <div class="card-header pt-2">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" data-bs-toggle="tab" href="#aba1">Principal</a>
                </li>
            </ul>
        </div>
        <form action="<?= base_url('producao/salvar-talao') ?>" method="post">
            <div class="card-body">
                <div class="tab-content">
                    <!--  Principal  -->
                    <div hidden>
                        <input type="text" id="id" name="id" value="<?= $talao['id'] ?? '' ?>">
                    </div>
                    <div id="aba1" class="tab-pane fade m-3 show active">
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label for="id_produto" class="col-form-label-sm">Referência</label>
                                <div class="input-group">
                                    <input type="hidden" name="id_produto" id="id_produto">
                                    <input type="text"
                                           name="xProd"
                                           id="xProd"
                                           autocomplete="off"
                                           value="<?= isset($talao['id_produto']) ? $produtos[$talao['id_produto']]['xProd'] : ''?>"
                                           class="form-control autocomplete-input">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('id_produto') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="num_producao" class="">Número da Produção</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="num_producao"
                                           name="num_producao"
                                           value="<?= $talao['num_producao'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('num_producao') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="sublote" class="">Sublote</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="sublote"
                                           name="sublote"
                                           value="<?= $talao['sublote'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('sublote') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="quantidade" class="">Quantidade</label>
                                <div class="input-group">
                                    <input type="number"
                                           id="quantidade"
                                           name="quantidade"
                                           value="<?= $talao['quantidade'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('quantidade') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label for="semana" class="col-form-label-sm">Semana</label>
                                <div class="input-group">
                                    <input type="number"
                                           name="semana"
                                           id="semana"
                                           max="53"
                                           value="<?= $talao['semana'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('semana') ?>
                                </small>
                            </div>
                            <div class="col-auto">
                                <label for="codigo_barras" class="">Código Barras</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="codigo_barras"
                                           name="codigo_barras"
                                           maxlength="20"
                                           minlength="20"
                                           value="<?= $talao['codigo_barras'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('codigo_barras') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="data_entrada" class="">Data Entrada</label>
                                <div class="input-group">
                                    <input type="date"
                                           id="data_entrada"
                                           name="data_entrada"
                                           value="<?= $talao['data_entrada'] ?? date('Y-m-d')?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('data_entrada') ?>
                                </small>
                            </div>
                            <div class="col-auto form-group">
                                <label for="data_saida" class="">Data Saída</label>
                                <div class="input-group">
                                    <input type="datetime-local"
                                           id="data_saida"
                                           name="data_saida"
                                           value="<?= $talao['data_saida'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('data_saida') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label for="nota_fiscal" class="col-form-label-sm">Nota Fiscal</label>
                                <div class="input-group">
                                    <input type="number"
                                           name="nota_fiscal"
                                           id="nota_fiscal"
                                           value="<?= $talao['nota_fiscal'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('nota_fiscal') ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= csrf_field(); ?>
            <div class="card-footer py-2">
                <div class="d-flex justify-content-end">
                    <button type="button" onclick="cancelar('producao/taloes')"
                            class="btn btn-light border-secondary fixed" style="margin-right: 1rem;">
                        <i class="fa fa-arrow-left"></i> Voltar</button>
                    <button class="btn btn-primary fixed"><i class="fa fa-save"></i> Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    var produtos = <?= json_encode($produtos) ?>;
    var inputField = $('.autocomplete-input');
    var productIdField = $('#id_produto');

    inputField.autocomplete({
        source: produtos.map(function(product) {
            return product.xProd;
        }),
        select: function(event, ui) {
            var selectedProduct = produtos.find(function(product) {
                return product.xProd === ui.item.value;
            });

            if (selectedProduct) {
                inputField.val(selectedProduct.xProd);
                productIdField.val(selectedProduct.id);
                inputField.trigger('change');
            }
        }
    });
</script>
