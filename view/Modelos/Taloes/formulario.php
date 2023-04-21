<?php include __DIR__ . '/../../Componentes/inicio-html.php'; ?>
<?php include __DIR__ . '/../../Componentes/navbar.php'; ?>

    <form action="/salvar-modelo<?= isset($modelo) ? '?id=' . $modelo->getId() : ''; ?>"
          method="post" class="justify-content">
        <div class="form-group justify-content-start row">
            <div class="col col-md-3 me-5">
                <label for="modelo-filtro">Modelo</label>
                <input type="text" id="modelo-filtro" class="form-control" list="modelo-lista" required>
                <datalist id="modelo-lista" class="translate-middle-x">
                    <?php foreach ($modelos as $item) : ?>
                        <option value="<?= $item->getModelo() ?>">
                            <?= $item->getModelo() ?>
                        </option>
                    <?php endforeach; ?>
                </datalist>
            </div>
            <div class="col col-md-3 mx-5">
                <label for="producao">Rel.Produção</label>
                <input type="text"
                       required
                       id="producao"
                       name="producao"
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getProducao() : ''; ?>">
            </div>
            <div class="col col-md-3 mx-5">
                <label for="sublote">Sublote</label>
                <input type="number"
                       required
                       id="sublote"
                       name="sublote"
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getSublote() : ''; ?>">
            </div>
            <div class="col col-md-3 me-5">
                <label for="quantidade">Quantidade</label>
                <input type="number"
                       id="quantidade"
                       name="quantidade"
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getQuantidade() : ''; ?>">
            </div>
            <div class="col col-md-3 mx-5">
                <label for="semana">Semana</label>
                <input type="number"
                       required
                       id="semana"
                       name="semana"
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getValor() : ''; ?>">
            </div>
            <div class="col col-md-3 mx-5">
                <label for="cod-barras">Cod.Barras</label>
                <input type="number"
                       required
                       id="cod-barras"
                       name="cod-barras"
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getCodBarras() : ''; ?>">
            </div>
            <div class="col col-md-3 me-5">
                <label for="data-entrada">Entrada</label>
                <div>
                <input type="date"
                       required
                       id="data-entrada"
                       name="data-entrada"
                       class="form-control"
                       value="<?= isset($modelo) ?
                           $modelo->getDataEntrada()->format('Y-m-d') :
                           $dataAtual->format('Y-m-d') ?>"
                       style="width: 100%; height: 2.4rem">
                </div>
            </div>
            <?php if(isset($modelo) && $modelo->getDataSaida() != null) : ?>
            <div class="col col-md-3 mx-5">
                <label for="data-entrada">Saída</label>
                <div class="input-group">
                    <input type="datetime-local"
                           id="data-saida"
                           name="data-saida"
                           class="form-control"
                           value="<?= $modelo->getDataSaida(true) ?>"
                           style="height: 2.4rem">
                    <button type="button" class="input-group-text btn btn-outline-dark border-secondary" onclick="limparConteudo()">
                        <i class='bi-eraser-fill d-inline d-flex float-end'></i>
                    </button>
                </div>


            </div>
            <?php endif;?>
        </div>
        <div class="position-absolute">
            <button class="btn btn-success mt-2 fixed">Confirmar</button>
            <button type="button" onclick="cancelar('modelos')"
                    class="btn btn-danger mt-2 fixed">Cancelar</button>
        </div>
    </form>

<?php include __DIR__ . '/../../Componentes/fim-html.php'; ?>

    <script>
        var listaCodigoBarras = <?= json_encode($listaCodigoBarras) ?>;
        var input = document.getElementById('cod-barras');
        input.addEventListener('input', function() {
            var valor = this.value;
            if (listaCodigoBarras.indexOf(valor) !== -1) {
                this.setCustomValidity('Código de barras já cadastrado');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>