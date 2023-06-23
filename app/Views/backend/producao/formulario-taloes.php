<div class="col-sm-12">
    <div class="card shadow">
        <div class="card-header pt-2">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" data-bs-toggle="tab" href="#aba1">Principal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#aba2">Outros</a>
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
                                    <input type="number"
                                           name="id_produto"
                                           id="id_produto"
                                           value="<?= $talao['id_produto'] ?? ''?>"
                                           class="form-control">
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
                                    <?= \Config\Services::validation()->getError('id_produto') ?>
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
                                    <input type="text"
                                           name="semana"
                                           id="semana"
                                           value="<?= $talao['semana'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('semana') ?>
                                </small>
                            </div>
                            <div class="col-2">
                                <label for="codigo_barras" class="">Código Barras</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="codigo_barras"
                                           name="codigo_barras"
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
                                    <input type="text"
                                           id="data_entrada"
                                           name="data_entrada"
                                           value="<?= $talao['data_entrada'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('data_entrada') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="data_saida" class="">Data Saída</label>
                                <div class="input-group">
                                    <input type="text"
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
                    <!--  Outros  -->
                    <div id="aba2" class="tab-pane fade m-3">
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="valor" class="">Valor</label>
                                <div class="input-group">
                                    <input type="number"
                                           step="0.01"
                                           id="valor"
                                           name="valor"
                                           value=""
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('valor') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="valor_entrada" class="">Valor de Entrada</label>
                                <div class="input-group">
                                    <input type="number"
                                           step="0.01"
                                           id="valor_entrada"
                                           name="valor_entrada"
                                           value=""
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('valor_entrada') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="valor_saida" class="">Valor de Saída</label>
                                <div class="input-group">
                                    <input type="number"
                                           step="0.01"
                                           id="valor_saida"
                                           name="valor_saida"
                                           value=""
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('valor_saida') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="margem_lucro_bruto" class="">Lucro Bruto</label>
                                <div class="input-group">
                                    <input type="number"
                                           step="0.01"
                                           id="margem_lucro_bruto"
                                           name="margem_lucro_bruto"
                                           value=""
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('margem_lucro_bruto') ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= csrf_field(); ?>
            <div class="card-footer py-2">
                <div class="d-flex justify-content-end">
                    <button type="button" onclick="cancelar('producao/listar-taloes')"
                            class="btn btn-light border-secondary fixed" style="margin-right: 1rem;">
                        <i class="fa fa-arrow-left"></i> Voltar</button>
                    <button class="btn btn-primary fixed"><i class="fa fa-save"></i> Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>