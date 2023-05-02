<?php
include __DIR__ . '/../Componentes/inicio-html.php';
include __DIR__ . '/../Componentes/navbar.php';
?>
    <form action="/salvar-configuracoes" method="post" class="form-group">
        <div class="display-6">Configurações Gerais</div>
        <hr>

        <?php foreach ($configuracoes as $configuracao) :?>
            <div id="" class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch"
                       id="switch<?= $configuracao->getId() ?>"
                       name="switch<?= $configuracao->getId() ?>"
                    <?= $empresa->getConfiguracoes()[$configuracao->getId()][0] ? 'checked' : '' ?>>
                <label class="form-check-label" for="<?= $configuracao->getId() ?>"><?= $configuracao->getDescricao() ?></label>
                <input class="form-control-sm number-input d-inline"
                       id="numero<?= $configuracao->getId() ?>"
                       name="numero<?= $configuracao->getId() ?>"
                       type="number"
                       style="width: 4rem"
                       value="<?= $empresa->getConfiguracoes()[$configuracao->getId()][1] ?? '' ?>">
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

