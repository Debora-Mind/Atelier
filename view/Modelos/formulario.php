<?php include __DIR__ . '/../Componentes/inicio-html.php'; ?>
<?php include __DIR__ . '/../Componentes/navbar.php'; ?>

    <form action="/salvar-modelo<?= isset($modelo) ? '?id=' . $modelo->getId() : ''; ?>"
          method="post">
        <div class="form-group gx-2 justify-content-md-start col-3">
            <div class="col col-md-auto">
                <label for="modelo">Modelo</label>
                <input type="text"
                       autofocus
                       id="modelo"
                       name="modelo"
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getModelo() : ''; ?>">
            </div>
            <div class="col col-md-auto">
                <label for="producao">Rel.Produção</label>
                <input type="number"
                       id="producao"
                       name="producao"
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getProducao() : ''; ?>">
            </div>
            <div class="col col-md-auto">
                <label for="sublote">Sublote</label>
                <input type="number"
                       id="sublote"
                       name="sublote"
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getSublote() : ''; ?>">
            </div>
            <div class="col col-md-auto">
                <label for="quantidade">Quantidade</label>
                <input type="number"
                       id="quantidade"
                       name="quantidade"
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getSublote() : ''; ?>">
            </div>
            <div class="col col-md-auto">
                <label for="valor">Valor</label>
                <input type="number"
                       step="0.01"
                       id="valor"
                       name="valor"
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getSublote() : ''; ?>">
            </div>
            <div class="col col-md-auto">
                <label for="cod-barras">Cod.Barras</label>
                <input type="number"
                       id="cod-barras"
                       name="cod-barras"
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getCodBarras() : ''; ?>">
            </div>
            <div class="col col-md-auto">
                <label for="data-entrada">Entrada</label>
                <div>
                <input type="date"
                       id="data-entrada"
                       name="data-entrada"
                       class="data-entrada"
                       value="<?= isset($modelo) ? $modelo->getDataEntrada() : $dataAtual->format('Y-m-d') ?>"
                       style="width: 100%; height: 2.4rem"
                >
                </div>
            </div>
        </div>
        <button class="btn btn-primary col-2 mt-2">Salvar</button>
    </form>

<?php include __DIR__ . '/../Componentes/fim-html.php';