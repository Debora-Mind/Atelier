<?php include __DIR__ . '/../Componentes/inicio-html.php'; ?>
<?php include __DIR__ . '/../Componentes/navbar.php'; ?>

    <form action="/salvar-usuario<?= isset($usuario) ? '?id=' . $usuario->getId() : ''; ?>"
          method="post">
        <div class="form-group gx-2 justify-content-md-start col-3">
            <div class="col col-md-auto">
                <label for="modelo">Usuário</label>
                <input type="text"
                       autofocus
                       id="modelo"
                       name="modelo"
                       class="form-control"
                       value="<?= isset($usuario) ? $usuario->getUsuario() : ''; ?>">
            </div>
            <div class="col col-md-auto">
                <label for="producao">Senha</label>
                <input type="password"
                       id="producao"
                       name="producao"
                       class="form-control"
                       value="<?= isset($usuario) ? $usuario->getSenha() : ''; ?>">
            </div>
            <div class="col col-md-auto">
                <label for="data-entrada">Funcionário</label>
                <div>
                    <input type=""
                           id="data-saida"
                           name="data-saida"
                           class="form-control"
                            <?php if(isset($usuario) && $usuario->$usuario->getIdFundionario()->getNome() != null) : ?>
                           value="<?= $usuario->getIdFundionario()->getNome() ?>"
                           <?php endif; ?>
                           style="width: 100%; height: 2.4rem">
                </div>
            </div>
        </div>
        <div class="position-absolute">
            <button class="btn btn-primary mt-2 fixed">Salvar</button>
            <button type="button" onclick="window.location.href='/usuarios'"
                    class="btn btn-danger mt-2 fixed">Cancelar</button>
        </div>
    </form>

<?php include __DIR__ . '/../Componentes/fim-html.php';