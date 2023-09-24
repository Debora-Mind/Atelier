<?php include __DIR__ . '/../Componentes/inicio-html.php'; ?>
<?php include __DIR__ . '/../Componentes/navbar.php'; ?>

    <form action="/salvar-funcao<?= isset($funcao) ? '?id=' . $funcao->getId() : ''; ?>"
          method="post">
        <div class="form-group gx-2 justify-content-md-start col-3">
            <div class="col col-md-auto">
                <label for="funcao">Função</label>
                <input type="text"
                       autofocus
                       id="funcao"
                       name="funcao"
                       class="form-control"
                       required
                       value="<?= (isset($funcao) ? $funcao->getDescricao() : ''); ?>">
            </div>
        </div>
        <div class="position-absolute">
            <button class="btn btn-success mt-2 fixed">Confirmar</button>
            <button type="button" onclick="cancelar('funcoes')"
                    class="btn btn-danger mt-2 fixed">Cancelar</button>
        </div>
    </form>

<?php include __DIR__ . '/../Componentes/fim-html.php';