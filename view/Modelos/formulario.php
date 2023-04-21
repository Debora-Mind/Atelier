<?php include __DIR__ . '/../Componentes/inicio-html.php'; ?>
<?php include __DIR__ . '/../Componentes/navbar.php'; ?>

    <form action="/salvar-modelo<?= isset($modelo) ? '?id=' . $modelo->getId() : ''; ?>"
          method="post" class="justify-content" enctype="multipart/form-data">
        <div class="form-group justify-content-start row">
            <div class="col col-md-3 me-5">
                <label for="modelo-filtro">Modelo</label>
                <input type="text"
                       id="modelo-filtro"
                       class="form-control"
                       list="modelo-lista"
                       required
                       autofocus>
                <datalist id="modelo-lista" class="translate-middle-x">
                    <?php foreach ($modelos as $item) : ?>
                        <option value="<?= $item->getModelo() ?>">
                            <?= $item->getModelo() ?>
                        </option>
                    <?php endforeach; ?>
                </datalist>
            </div>
            <div class="col col-md-3 mx-5">
                <label for="valor-entrada">Valor Entrada</label>
                <input type="text"
                       required
                       id="valor-entrada"
                       name="valor-entrada"
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getValorEntrada() : ''; ?>">
            </div>
            <div class="col col-md-3 mx-5">
                <label for="valor-saida">Valor Saída</label>
                <input type="text"
                       required
                       id="valor-saida"
                       name="valor-saida"
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getValorSaida() : ''; ?>">
            </div>
            <div class="col col-md-7 me-5">
                <label for="foto">Foto do Modelo</label>
                <input type="file"
                       id="foto"
                       name="foto"
                       class="form-control">
            </div>
            <div class="col col-md-7 me-5">
                <label for="roteiro">Roteiro</label>
                <input type="file"
                       id="roteiro"
                       name="roteiro"
                       class="form-control">
            </div>
        </div>
        <div class="position-absolute">
            <button class="btn btn-success mt-2 fixed">Confirmar</button>
            <button type="button" onclick="cancelar('modelos')"
                    class="btn btn-danger mt-2 fixed">Cancelar</button>
        </div>
    </form>

<?php include __DIR__ . '/../Componentes/fim-html.php'; ?>
