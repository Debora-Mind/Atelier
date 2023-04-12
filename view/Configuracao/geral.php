<?php
include __DIR__ . '/../Componentes/inicio-html.php';
include __DIR__ . '/../Componentes/navbar.php';
?>
    <form action="/salvar-configuracoes<?= '?id=' . $usuario->getId() ?>" method="post">
        <div class="display-6">Configurações Gerais</div>
        <hr>

        <?php foreach ($configuracoes as $configuracao) :?>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch"
                       id="<?= $configuracao->getId() ?>"
                       name="permissao[]" value="<?= $configuracao->getId() ?>"
                    <?= in_array($cofiguracao->getId(), $usuario->getPermissoes()) ? 'checked' : '' ?>>
                <label class="form-check-label" for="<?= $configuracao->getId() ?>"><?= $configuracao->getNome() ?></label>
            </div>
        <?php endforeach ?>

        <div>
            <button class="btn btn-success mt-2 fixed">Confirmar</button>
            <button type="button" onclick="cancelar('usuarios')"
                    class="btn btn-danger mt-2 fixed">Cancelar</button>
        </div>
    </form>


<?php include __DIR__ . '/../Componentes/fim-html.php';
