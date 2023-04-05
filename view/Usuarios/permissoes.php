<?php
include __DIR__ . '/../Componentes/inicio-html.php';
include __DIR__ . '/../Componentes/navbar.php';
?>
    <form action="/salvar-permissoes<?= '?id=' . $usuario->getId() ?>" method="post">
        <div class="display-6">Permissões para <?= $usuario->getUsuario() ?></div>
        <hr>

        <?php foreach ($permissoes as $permissao) :?>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch"
                       id="<?= $permissao->getId() ?>"
                       name="permissao[]" value="<?= $permissao->getId() ?>"
                       <?= in_array($permissao->getId(), $usuario->getPermissoes()) ? 'checked' : '' ?>>
                <label class="form-check-label" for="<?= $permissao->getId() ?>"><?= $permissao->getNome() ?></label>
            </div>
        <?php endforeach ?>

        <div>
            <button class="btn btn-success mt-2 fixed">Confirmar</button>
            <button type="button" onclick="cancelar('usuarios')"
                    class="btn btn-danger mt-2 fixed">Cancelar</button>
        </div>
    </form>


<?php include __DIR__ . '/../Componentes/fim-html.php';
