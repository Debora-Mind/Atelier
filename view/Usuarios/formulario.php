<?php include __DIR__ . '/../Componentes/inicio-html.php'; ?>
<?php include __DIR__ . '/../Componentes/navbar.php'; ?>

    <form action="/salvar-usuario<?= isset($usuario) ? '?id=' . $usuario->getId() : ''; ?>"
          method="post">
        <div class="form-group gx-2 justify-content-md-start col-3">
            <div class="col col-md-auto">
                <label for="usuario">Usuário</label>
                <input type="text"
                       autofocus
                       required
                       id="usuario"
                       name="usuario"
                       class="form-control"
                       value="<?= (isset($usuario) ? $usuario->getUsuario() : ''); ?>">
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <div class="d-flex">
                    <input type="password"
                           id="senha"
                           name="senha"
                           class="form-control"
                           required>
                </div>
            </div>
            <div class="col col-md-auto">
                <label for="senha-repitida">Repita a senha</label>
                <input type="password"
                       id="senha-repitida"
                       name="senha-repitida"
                       class="form-control"
                       required>
            </div>
            <div class="col col-md-auto">
                <label for="funcionario">Funcionário</label>
                <select type="button" name="funcionario" id="funcionario"
                        class="btn btn-toolbar border mb-2">
                    <option selected class="dropdown-item bg-white text-start"
                        <?php if(isset($usuario)) : ?>
                            value=<?= $usuario->getFuncionario() == null ? '0' : $usuario->getFuncionario()->getId()?>>
                            <?= $usuario->getFuncionario() == null ? 'Selecione' : $usuario->getFuncionario()->getNome()?>
                        <?php else: ?>
                            value=0>
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
            <button class="btn btn-success mt-2 fixed">Confirmar</button>
            <button type="button" onclick="cancelar('usuarios')"
                    class="btn btn-danger mt-2 fixed">Cancelar</button>
        </div>
    </form>

<?php include __DIR__ . '/../Componentes/fim-html.php';
