<?php include __DIR__ . '/../Componentes/inicio-html.php'; ?>
<?php include __DIR__ . '/../Componentes/navbar.php'; ?>

    <form action="/salvar-modelo<?= isset($modelo) ? '?id=' . $modelo->getId() : ''; ?>"
          method="post" class="justify-content">
        <div class="form-group justify-content-start row">
            <div class="col col-md-3 me-5">
                <label for="modelo">Modelo</label>
                <input type="text"
                       autofocus
                       required
                       id="modelo"
                       name="modelo"
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getModelo() : ''; ?>">
            </div>
            <div class="col col-md-3 mx-5">
                <label for="producao">Rel.Produção</label>
                <input type="number"
                       id="producao"
                       name="producao"
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getProducao() : ''; ?>">
            </div>
            <div class="col col-md-3 mx-5">
                <label for="sublote">Sublote</label>
                <input type="number"
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
                <label for="valor">Valor</label>
                <input type="number"
                       step="0.01"
                       id="valor"
                       name="valor"
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getValor() : ''; ?>">
            </div>
            <div class="col col-md-3 mx-5">
                <label for="semana">Semana</label>
                <input type="number"
                       id="semana"
                       name="semana"
                       required
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getValor() : ''; ?>">
            </div>
            <div class="col col-md-3 me-5">
                <label for="cod-barras">Cod.Barras</label>
                <input type="number"
                       id="cod-barras"
                       name="cod-barras"
                       class="form-control"
                       required
                       value="<?= isset($modelo) ? $modelo->getCodBarras() : ''; ?>">
            </div>
            <div class="col col-md-3 mx-5">
                <label for="data-entrada">Entrada</label>
                <div>
                <input type="date"
                       id="data-entrada"
                       name="data-entrada"
                       class="form-control"
                       required
                       value="<?= isset($modelo) ?
                           $modelo->getDataEntrada()->format('Y-m-d') :
                           $dataAtual->format('Y-m-d') ?>"
                       style="width: 100%; height: 2.4rem">
                </div>
            </div>
            <?php if(isset($modelo) && $modelo->getDataSaida() != null) : ?>
            <div class="col col-md-3 mx-5">
                <label for="data-entrada">Saída</label>
                <div>
                    <input type="datetime-local"
                           id="data-saida"
                           name="data-saida"
                           class="form-control"
                           value="<?= $modelo->getDataSaida(true) ?>"
                           style="width: 100%; height: 2.4rem">
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

<?php include __DIR__ . '/../Componentes/fim-html.php';