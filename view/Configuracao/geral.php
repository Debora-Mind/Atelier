<?php
include __DIR__ . '/../Componentes/inicio-html.php';
include __DIR__ . '/../Componentes/navbar.php';
?>
    <form action="/salvar-configuracoes" method="post">
        <div class="display-6">Configurações Gerais</div>
        <hr>

        <?php foreach ($configuracoes as $configuracao) :?>
            <div id="" class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch"
                       id="switch<?= $configuracao->getId() ?>"
                       name="switch<?= $configuracao->getId() ?>"
                    <?= $configuracao->getAtivo() ? 'checked' : '' ?>>
                <label class="form-check-label" for="<?= $configuracao->getId() ?>"><?= $configuracao->getDescricao() ?></label>
                <input class="form-control form-control-sm number-input d-inline"
                       id="numero<?= $configuracao->getId() ?>"
                       name="numero<?= $configuracao->getId() ?>"
                       type="number"
                       style="width: 3rem"
                       value="<?= $configuracao->getNumero() == 0 ? '' : $configuracao->getNumero() ?>">
                <span class="input-text"> dias</span>
            </div>
        <?php endforeach ?>

        <div>
            <button class="btn btn-success mt-2 fixed">Confirmar</button>
            <button type="button" onclick="cancelar('usuarios')"
                    class="btn btn-danger mt-2 fixed">Cancelar</button>
        </div>
    </form>

<?php include __DIR__ . '/../Componentes/fim-html.php';

