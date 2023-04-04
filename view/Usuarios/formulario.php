<?php include __DIR__ . '/../Componentes/inicio-html.php'; ?>
<?php include __DIR__ . '/../Componentes/navbar.php'; ?>

    <form action="/salvar-usuario<?= isset($usuario) ? '?id=' . $usuario->getId() : ''; ?>"
          method="post">
        <div class="form-group gx-2 justify-content-md-start col-3">
            <div class="col col-md-auto">
                <label for="modelo">Usuário</label>
                <input type="text"
                       autofocus
                       id="usuario"
                       name="usuario"
                       class="form-control"
                       value="<?= ($_SESSION['usuario']) ?? (isset($usuario) ? $usuario->getUsuario() : ''); ?>">
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <div class="d-flex">
                    <input type="password"
                           id="senha"
                           name="senha"
                           class="form-control"
                           value="<?= isset($_SESSION['senha']) ? $_SESSION['senha'] : (isset($usuario) ? $usuario->getSenha() : ''); ?>">
                </div>
            </div>
            <div class="col col-md-auto">
                <label for="producao">Repita a senha</label>
                <input type="password"
                       id="senha-repitida"
                       name="senha-repitida"
                       class="form-control"
                       value="<?= ($_SESSION['senha-repitida']) ?? (isset($usuario) ? $usuario->getSenha() : ''); ?>">
            </div>
            <div class="col col-md-auto">
                <label for="funcionarios">Funcionário</label>
                <select type="button" name="funcionarios" id="funcionarios"
                        class="btn btn-toolbar border mb-2">
                    <option value="0" selected class="dropdown-item bg-white text-start">
                        <?php if(isset($usuario) && $usuario->$usuario->getIdFundionario()->getNome() != null) : ?>
                            <?= $usuario->getIdFundionario()->getNome() ?>
                        <?php else: ?>
                            Selecione
                        <?php endif; ?>
                    </option>
                    <?php foreach ($funcionarios as $funcionario) : ?>
                        <option value="<?= $funcionario->getId(); ?>" class="dropdown-item bg-white text-start">
                            <?= $funcionario->getNome(); ?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="position-absolute">
            <button class="btn btn-primary mt-2 fixed">Salvar</button>
            <button type="button" onclick="cancelar('usuarios')"
                    class="btn btn-danger mt-2 fixed">Cancelar</button>
        </div>
        <div class="flex-fill fixed-bottom m-5 px-5">
            <div class="">
                <?php include __DIR__ . '/../Componentes/mensagens.php';?>
            </div>
        </div>

    </form>

<?php include __DIR__ . '/../Componentes/fim-html.php';
