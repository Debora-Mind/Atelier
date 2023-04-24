<?php include __DIR__ . '/../Componentes/inicio-html.php'; ?>
<?php include __DIR__ . '/../Componentes/navbar.php'; ?>
<?php
use Dam\Atelier\Model\FuncaoTrait;
?>

    <form action="/salvar-modelo<?= isset($modelo) ? '?id=' . $modelo->getId() : ''; ?>"
          method="post" class="justify-content" enctype="multipart/form-data">
        <div class="form-group justify-content-start row">
            <div class="col col-md-3 me-5">
                <label for="modelo-filtro">Modelo</label>
                <input type="text"
                       id="modelo-filtro"
                       name="modelo-filtro"
                       class="form-control"
                       list="modelo-lista"
                       required
                       autofocus
                       value="<?= isset($modelo) ? $modelo->getModelo() : ''; ?>">
                <datalist id="modelo-lista" class="translate-middle-x">
                    <?php foreach ($modelos as $item) : ?>
                        <option value="<?= $item->getModelo() ?>"></option>
                    <?php endforeach; ?>
                </datalist>
            </div>
            <div class="col col-md-3 mx-5">
                <label for="valor-entrada">Valor Entrada</label>
                <input type="number"
                       step="0.01"
                       required
                       id="valor-entrada"
                       name="valor-entrada"
                       class="form-control"
                       value="<?= isset($modelo) ? $modelo->getValorEntrada() : ''; ?>">
            </div>
            <div class="col col-md-3 mx-5">
                <label for="valor-saida">Valor Saída</label>
                <input type="number"
                       step="0.01"
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

<script>
    function setCustomValidate() {
        var modeloInput = document.getElementById('modelo-filtro');
        var modelosList = document.getElementById('modelo-lista');

        modeloInput.addEventListener('input', function() {
            var modeloValue = this.value;
            for (var i = 0; i < modelosList.options.length; i++) {
                if (modelosList.options[i].value === modeloValue) {
                    this.setCustomValidity('O modelo já existe.');
                    return;
                }
            }
            this.setCustomValidity('');
        });

        document.getElementById('persistir-modelo').addEventListener('submit', function(event) {
            var modeloInput = document.getElementById('modelo-filtro');
            var modelosList = document.getElementById('modelo-lista');

            for (var i = 0; i < modelosList.options.length; i++) {
                if (modelosList.options[i].value === modeloInput.value) {
                    modeloInput.setCustomValidity('O modelo já existe.');
                    break;
                }
            }

            if (!this.checkValidity()) {
                event.preventDefault();
            }
        });
    }

    window.addEventListener('load', function() {
        setCustomValidate();
    });
</script>