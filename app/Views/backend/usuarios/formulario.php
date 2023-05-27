<!-- Begin Page Content -->
<div class="container-fluid">

<!--    MELHORAR VISUALIZAÇÃO DE VALIDAÇÕES -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow mb-sm-4">
                <div class="card-body">
                    <form action="<?= base_url('usuarios/salvar-usuario') ?>" <?= isset($usuario) ? 'method="post"' : ''; ?>>
                        <div class="form-group">
                            <label for="usuario" class="form-label">Usuário</label>
                            <input class="form-control w-auto" name="usuario" id="usuario" value="<?= $usuario['usuario'] ?? '' ?>" autofocus/>
                            <small class="text-danger position-absolute">
                                <?= \Config\Services::validation()->getError('usuario') ?>
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="funcionario" class="form-label">Funcionário<small> (Opcional)</small></label>
                            <select type="button" name="funcionario" id="funcionario"
                                    class="btn-sm btn-toolbar mb-2 form-control-sm col-auto">
                                <option selected class="dropdown-item bg-white text-start"
                                    <?php if(isset($usuario)) : ?>
                                        value=<?= !isset($usuario['funcionario_id']) ? '0' : $usuario['funcionario_id']?>>
                                    <?= $usuario['funcionario_id'] == null ? 'Selecione' : $usuario['funcionario_id']['nome']?>
                                    <?php else: ?>
                                        value=0>
                                        Selecione
                                    <?php endif; ?>
                                </option>
                                <?php foreach ($funcionarios as $funcionario) : ?>
                                    <option value="<?= $funcionario['id']; ?>" class="dropdown-item bg-white text-start">
                                        <?= $funcionario['nome']; ?>
                                    </option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input class="form-control w-auto" name="senha" id="senha" type="password"/>
                            <small class="text-danger position-absolute">
                                <?= \Config\Services::validation()->getError('senha') ?>
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="senha-repetida">Repita a senha</label>
                            <input class="form-control w-auto" name="senha-repetida" id="senha-repetida" type="password"/>
                            <small class="text-danger position-absolute">
                                <?= \Config\Services::validation()->getError('senha-repetida') ?>
                            </small>
                        </div>

                        <input type="hidden" value="<?= $usuario['id'] ?? '' ?>" name="id">
                        <?= csrf_field(); ?>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <button type="button" onclick="cancelar('usuarios')"
                                        class="btn btn-danger" style="margin-right: 1rem;">Cancelar</button>
                                <button class="btn btn-success">Confirmar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->