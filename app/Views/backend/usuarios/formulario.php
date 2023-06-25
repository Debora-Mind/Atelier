<div class="col-sm-12">
    <div class="card shadow">
        <div class="card-header pt-2">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" data-bs-toggle="tab" href="#aba1">Principal</a>
                </li>
            </ul>
        </div>
        <form action="<?= base_url('usuarios/salvar-usuario') ?>" <?= isset($usuario) ? 'method="post"' : ''; ?>>
            <div class="card-body">
                <div class="tab-content">
                    <!--  Principal  -->
                    <div hidden>
                        <input type="text" id="id" name="id" value="<?= $usuario['id'] ?? '' ?>">
                    </div>
                    <div id="aba1" class="tab-pane fade m-3 show active">
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label for="usuario" class="col-form-label-sm">Login</label>
                                <div class="input-group">
                                    <input type="text"
                                           name="usuario"
                                           id="usuario"
                                           value="<?= $usuario['usuario'] ?? ''?>"
                                           class="form-control"
                                            autofocus>
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('usuario') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
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
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label for="senha">Senha</label>
                                <input class="form-control w-auto" name="senha" id="senha" type="password"/>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('senha') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label for="senha-repetida">Repita a senha</label>
                                <input class="form-control w-auto" name="senha-repetida" id="senha-repetida" type="password"/>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('senha-repetida') ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= csrf_field(); ?>
            <div class="card-footer py-2">
                <div class="d-flex justify-content-end">
                    <button type="button" onclick="cancelar('usuarios')"
                            class="btn btn-light border-secondary fixed" style="margin-right: 1rem;">
                        <i class="fa fa-arrow-left"></i> Voltar</button>
                    <button class="btn btn-primary fixed"><i class="fa fa-save"></i> Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>
