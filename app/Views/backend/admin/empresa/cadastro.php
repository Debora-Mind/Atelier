<div class="col-sm-12">
    <div class="card shadow">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" data-bs-toggle="tab" href="#aba1">Geral</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#aba2">Endereço</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#aba3">NFe</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#aba4">Configurações</a>
                </li>
            </ul>
        </div>
        <form action="<?= base_url('admin/empresa/salvar-empresa') ?>" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="tab-content">
                    <div id="aba1" class="tab-pane fade show active">
                        <input hidden value="<?= $empresas['id'] ?>" id="id" name="id">
                        <div class="row d-inline w-100">
                            <div class="col col-sm-4 form-group">
                                <label for="nome_fantasia" class="col-form-label-sm">Nome Fantasia</label>
                                <input type="text"
                                       autofocus
                                       required
                                       id="nome_fantasia"
                                       name="nome_fantasia"
                                       class="form-control"
                                       value="<?= $empresas['nome_fantasia'] ?? '' ?>">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('nome_fantasia') ?>
                                </small>
                            </div>
                            <div class="col col-sm-4 form-group">
                                <label for="razao_social" class="col-form-label-sm">Razão Social</label>
                                <input type="text"
                                       autofocus
                                       required
                                       id="razao_social"
                                       name="razao_social"
                                       class="form-control"
                                       value="<?= $empresas['razao_social'] ?? '' ?>">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('razao_social') ?>
                                </small>
                            </div>
                            <div class="col col-sm-5">
                                <label for="logamarca" class="col-form-label-sm">Logo</label>
                                <input type="file"
                                       id="logamarca"
                                       name="logamarca"
                                       class="form-control-file"
                                       accept=".png,.jpg,.jpeg,.svg">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('logamarca') ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <!--  Endereço  -->
                    <div id="aba2" class="tab-pane fade m-3">
                        <div class="row">
                            <div class="col-sm-3 form-group">
                                <label for="cep" class="col-form-label-sm">Cep</label>
                                <div class="input-group">
                                    <input type="text"
                                           autofocus
                                           required
                                           id="cep"
                                           name="cep"
                                           class="form-control"
                                           value="<?= $empresas['cep'] ?? '' ?>">
                                    <a href="#" class="btn-link ml-3">Não sei meu CEP</a>
                                </div>
                                <small class="text-danger">
                                    <?= \Config\Services::validation()->getError('cep') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-sm-3 form-group">
                                <label for="logradouro" class="col-form-label-sm">Endereço</label>
                                <input type="text"
                                       autofocus
                                       required
                                       id="logradouro"
                                       name="logradouro"
                                       class="form-control"
                                       value="<?= $empresas['logradouro'] ?? '' ?>">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('logradouro') ?>
                                </small>
                            </div>
                            <div class="col col-sm-1 form-group">
                                <label for="numero" class="col-form-label-sm">Número</label>
                                <input type="text"
                                       required
                                       id="numero"
                                       name="numero"
                                       class="form-control"
                                       value="<?= $empresas['numero'] ?? '' ?>">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('numero') ?>
                                </small>
                            </div>
                            <div class="col col-sm-2 form-group">
                                <label for="emitentexCpl" class="col-form-label-sm">Complemmento</label>
                                <input type="text"
                                       autofocus
                                       required
                                       id="emitentexCpl"
                                       name="emitentexCpl"
                                       class="form-control"
                                       value="<?= $empresas['emitentexCpl'] ?? '' ?>">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('emitentexCpl') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-sm-2 form-group">
                                <label for="bairro" class="col-form-label-sm">Bairro</label>
                                <input type="text"
                                       autofocus
                                       required
                                       id="bairro"
                                       name="bairro"
                                       class="form-control"
                                       value="<?= $empresas['bairro'] ?? '' ?>">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('bairro') ?>
                                </small>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label for="UF">Estado</label>
                                <select name="UF" id="UF" class="custom-select">
                                    <option selected value="<?= $empresas[''] ?? '' ?>">
                                        <?= $empresas['UF'] ?? 'Selecione' ?>
                                    </option>
                                    <option value="RS">RS</option>
                                    <!-- Incluir outros estados aqui -->
                                </select>
                                <small class="text-danger">
                                    <?= \Config\Services::validation()->getError('UF') ?>
                                </small>
                            </div>
                            <div class="col col-sm-2 form-group">
                                <label for="municipio">Cidade</label>
                                <!-- MELHORAR -->
                                <select type="button" name="municipio" id="municipio"
                                        class="custom-select">
                                    <option selected class="dropdown-item"
                                            value="<?= $empresas['municipio'] ?? '' ?>">
                                        <?= $empresas[''] ?? 'Selecione'?>
                                    </option>
                                    <option value="Claro" class="dropdown-item">
                                        Igrejinha
                                    </option>
                                    <!--                                Também prescisa do código da cidade/IBGE-->
                                </select>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('municipio') ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <!--  NFe  -->
                    <div id="aba3" class="tab-pane fade m-3">
                        <div class="row">
                            <div class="col col-sm-4 form-group">
                                <label for="cnpj" class="col-form-label-sm">CNPJ</label>
                                <input type="text"
                                       autofocus
                                       required
                                       id="cnpj"
                                       name="cnpj"
                                       class="form-control"
                                       value="<?= $empresas['cnpj'] ?? '' ?>">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('cnpj') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-sm-2 form-group">
                                <label for="ie" class="col-form-label-sm">Inscrição Estadual</label>
                                <input type="text"
                                       autofocus
                                       required
                                       id="ie"
                                       name="ie"
                                       class="form-control"
                                       value="<?= $empresas['ie'] ?? '' ?>">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('ie') ?>
                                </small>
                            </div>
                            <div class="col col-sm-2 form-group">
                                <label for="im" class="col-form-label-sm">Inscrição Municipal</label>
                                <input type="text"
                                       autofocus
                                       required
                                       id="im"
                                       name="im"
                                       class="form-control"
                                       value="<?= $empresas['im'] ?? '' ?>">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('im') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-sm-3 form-group">
                                <label for="CNAE" class="col-form-label-sm">CNAE</label>
                                <input type="text"
                                       autofocus
                                       required
                                       id="CNAE"
                                       name="CNAE"
                                       class="form-control"
                                       value="<?= $empresas['CNAE'] ?? '' ?>">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('') ?>
                                </small>
                            </div>
                            <div class="col col-sm-2 form-group">
                                <label for="CRT_ID" class="col-form-label-sm">Regime Tributário</label>
                                <input type="text"
                                       autofocus
                                       required
                                       id="CRT_ID"
                                       name="CRT_ID"
                                       class="form-control"
                                       value="<?= $empresas['CRT_ID'] ?? '' ?>">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('CRT_ID') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-auto col-4 form-group">
                                <label for="certificado_a3" class="col-form-label-sm">Certificado</label>
                                <input type="file"
                                       id="certificado_a3"
                                       name="certificado_a3"
                                       class="form-control-file"
                                       accept=".png,.jpg,.jpeg,.svg">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('') ?>
                                </small>
                            </div>
                            <div class="col col-sm-2 form-group">
                                <label for="password" class="col-form-label-sm">Senha</label>
                                <input type="text"
                                       autofocus
                                       required
                                       id="password"
                                       name="password"
                                       class="form-control"
                                       value="<?= $empresas['password'] ?? '' ?>">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('password') ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <!--  Configurações  -->
                    <div id="aba4" class="tab-pane fade">
                        <div class="row d-inline w-100">
                            <div class="col col-sm-4 form-group">
                                <label for="ambiente">Ambiente</label>
                                <!-- MELHORAR -->
                                <select type="button" name="ambiente" id="ambiente"
                                        class="custom-select">
                                    <option selected class="dropdown-item"
                                            value="<?= $empresas['ambiente'] ?? '' ?>">
                                        <?= $empresas[''] ?? 'Selecione'?>
                                    </option>
                                    <option value="Claro" class="dropdown-item">
                                        Homologação
                                    </option>
                                    <option value="Escuro" class="dropdown-item">
                                        Produção
                                    </option>
                                </select>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('ambiente') ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= csrf_field(); ?>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" onclick="cancelar('')"
                            class="btn btn-danger mt-2 fixed" style="margin-right: 1rem;">Cancelar</button>
                    <button class="btn btn-success mt-2 fixed">Confirmar</button>
                </div>
            </div>
        </form>
    </div>
</div>
