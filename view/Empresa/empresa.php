<?php
include __DIR__ . '/../Componentes/inicio-html.php';
include __DIR__ . '/../Componentes/navbar.php';
?>
    <form action="/salvar-empresa" method="post" enctype="multipart/form-data">
        <div class="barra-rolagem px-1">
            <div class="display-6 d-inline-flex"><?= $empresa->getDescricao()?></div>
            <hr>
            <div class="row d-inline-block">
                <div class="col col-md-auto col-4">
                    <label for="descricao">Nome</label>
                    <input type="text"
                           autofocus
                           required
                           id="descricao"
                           name="descricao"
                           class="form-control"
                           value="<?= $empresa->getDescricao() ?? '' ?>">
                </div>
                <div class="col col-md-auto col-4">
                    <label for="funcionario">Tema</label>
                    <select type="button" name="tema" id="tema"
                            class="btn btn-toolbar border mb-2">
                        <option selected class="dropdown-item bg-white text-start"
                                value="<?= $empresa->getTema()?>">
                            <?= $empresa->getTema()?>
                        </option>
                        <option value="Claro" class="dropdown-item bg-white text-start">
                            Claro
                        </option>
                        <option value="Escuro" class="dropdown-item bg-white text-start">
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
            <div>
                <button class="btn btn-success mt-2 fixed">Confirmar</button>
                <button type="button" onclick="cancelar('')"
                        class="btn btn-danger mt-2 fixed">Cancelar</button>
            </div>
        </div>
    </form>

<?php include __DIR__ . '/../Componentes/fim-html.php';

