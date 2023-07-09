<!-- Begin Page Content -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div class="container-fluid">
    <div class="card shadow">
        <div class="d-flex justify-content-sm-between align-items-sm-stretch card-header">
            Buscar
        </div>
        <form action="<?= base_url('producao/metas') ?>" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3 form-group">
                        <label for="id_produto" class="col-form-label-sm">Modelo</label>
                        <div class="input-group">
                            <input type="hidden" name="id_produto" id="id_produto">
                            <input type="text"
                                   name="xProd"
                                   id="xProd"
                                   autocomplete="off"
                                   value="Todos"
                                   class="form-control autocomplete-input">
                        </div>
                        <small class="text-danger position-absolute">
                            <?= \Config\Services::validation()->getError('id_produto') ?>
                        </small>
                    </div>
                    <div class="col-3">
                        <label for="data">Data</label>
                        <input type="date" name="data" id="data" class="form-control">
                        <small class="text-danger position-absolute">
                            <?= \Config\Services::validation()->getError('data') ?>
                        </small>
                    </div>
                    <div class="col-2">
                        <label for="meta">Meta</label>
                        <input type="number" name="meta" id="meta" class="form-control"
                        value="0">
                        <small class="text-danger position-absolute">
                            <?= \Config\Services::validation()->getError('meta') ?>
                        </small>
                    </div>
                    <div class="form-group mt-sm-4">
                        <button class="btn-sm btn-light mx-sm-3 border-primary" type="submit">
                            <i class="bi bi-pencil bi-align-middle"></i> Alterar
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-footer pt-2 pb-0">
                <div class="row w-100">
                    <div class="form-group">
                        <?= csrf_field(); ?>
                        <a href="<?= base_url('producao/metas') ?>">
                            <button class="btn-sm btn-primary text-light mx-sm-3" type="button">
                                <i class="bi bi-search"></i> Buscar
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row mt-5 px-3">
        <?php include __DIR__ . '/../painel/graficos/performace-producao.php' ?>
        <div class="col-12 w-auto" id="chart_div" style="height: 18rem"></div>
    </div>
</div>
<!-- /.container-fluid -->

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
