    <form action="<?= base_url('sistema/empresa/salvar-empresa') ?>" method="post" enctype="multipart/form-data" class="form-group">
        <div class="barra-rolagem px-1">
            <div class="display-6 d-inline-flex"><?= $empresas['descricao']?></div>
            <hr>
            <input hidden value="<?= $empresas['id'] ?>" id="id" name="id">
            <div class="row d-inline-block">
                <div class="col col-md-auto col-4">
                    <label for="descricao">Nome</label>
                    <input type="text"
                           autofocus
                           required
                           id="descricao"
                           name="descricao"
                           class="form-control"
                           value="<?= $empresas['descricao'] ?? '' ?>">
                </div>
                <div class="col col-md-auto col-4">
                    <label for="tema">Tema</label>
                    <!-- MELHORAR -->
                    <select type="button" name="tema" id="tema"
                            class="btn btn-toolbar mb-2 form-group border">
                        <option selected class="dropdown-item text-start"
                                value="<?= $empresas['tema']?>">
                            <?= $empresas['tema']?>
                        </option>
                        <option value="Claro" class="dropdown-item text-start">
                            Claro
                        </option>
                        <option value="Escuro" class="dropdown-item text-start">
                            Escuro
                        </option>
                    </select>
                </div>
                <div class="col col-md-auto col-4">
                    <label for="logo">Logo</label>
                    <input type="file"
                           id="logo"
                           name="logo"
                           class="form-control"
                           accept=".png,.jpg,.jpeg,.svg">
                </div>
            </div>
            <?= csrf_field(); ?>
            <div>
                <button class="btn btn-success mt-2 fixed">Confirmar</button>
                <button type="button" onclick="cancelar('')"
                        class="btn btn-danger mt-2 fixed">Cancelar</button>
            </div>
        </div>
    </form>
