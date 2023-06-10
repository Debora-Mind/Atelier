<div class="col-sm-12">
    <div class="card shadow">
        <div class="card-header pt-2">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" data-bs-toggle="tab" href="#aba1">Principal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#aba2">Contato</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#aba3">Endereço</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#aba4">Parâmetros</a>
                </li>
            </ul>
        </div>
        <form action="<?= base_url('empresa/gravar-cliente') ?>" method="post">
            <div class="card-body">
                <div class="tab-content">
                    <!--  Principal  -->
                    <div hidden>
                        <input type="text" id="id" name="id" value="<?= $cliente['id'] ?? '' ?>">
                        <input type="text" id="empresa_id" name="empresa_id" value="<?= $cliente['id'] ?? '' ?>">
                    </div>
                    <div id="aba1" class="tab-pane fade m-3 show active">
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="tp_produto" class="">Tipo de Pessoa</label>
                                <div class="input-group">
                                    <select id="tipo_pessoa" name="tipo_pessoa" class="form-control">
                                        <option value="2" <?= ($cliente['tipo_pessoa'] ?? '') == '2' ? 'selected' : '' ?>>Jurídica</option>
                                        <option value="1" <?= ($cliente['tipo_pessoa'] ?? '') == '1' ? 'selected' : '' ?>>Fisíca</option>
                                    </select>
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tipo_pessoa') ?>
                                </small>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label for="cpf_cnpj" class="col-form-label-sm  pessoa-fisica">CPF</label>
                                <label for="cpf_cnpj" class="col-form-label-sm pessoa-juridica">CNPJ</label>
                                <div class="input-group">
                                    <input type="text"
                                           name="cpf_cnpj"
                                           id="cpf_cnpj"
                                           value="<?= $cliente['cpf_cnpj'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('cpf_cnpj') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="rg_ie" class="pessoa-fisica">RG</label>
                                <label for="rg_ie" class="pessoa-juridica">IE</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="rg_ie"
                                           name="rg_ie"
                                           value="<?= $cliente['rg_ie'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('rg_ie') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="apelido_nome_fantasia" class="pessoa-fisica">Apelido</label>
                                <label for="apelido_nome_fantasia" class="pessoa-juridica">Nome Fantasia</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="apelido_nome_fantasia"
                                           name="apelido_nome_fantasia"
                                           value="<?= $cliente['apelido_nome_fantasia'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('apelido_nome_fantasia') ?>
                                </small>
                            </div>
                            <div class="col-4 form-group">
                                <label for="nome_razao_social" class="pessoa-fisica">Nome</label>
                                <label for="nome_razao_social" class="pessoa-juridica">Razão Social</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="nome_razao_social"
                                           name="nome_razao_social"
                                           value="<?= $cliente['nome_razao_social'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('nome_razao_social') ?>
                                </small>
                            </div>
                            <div class="col-sm-2 form-group pessoa-juridica">
                                <label for="inscr_munic" class="col-form-label-sm">IM</label>
                                <div class="input-group">
                                    <input type="text"
                                           name="inscr_munic"
                                           id="inscr_munic"
                                           value="<?= $cliente['inscr_munic'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('inscr_munic') ?>
                                </small>
                            </div>
                            <div class="col-2 pessoa-fisica">
                                <label for="estado_civil">Estado Civil</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="estado_civil"
                                           name="estado_civil"
                                           value="<?= $cliente['estado_civil'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('estado_civil') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 form-group pessoa-fisica">
                                <label for="sexo" class="">Sexo</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="sexo"
                                           name="sexo"
                                           value="<?= $cliente['sexo'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('sexo') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="nacionalidade" class="">Nacionalidade</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="nacionalidade"
                                           name="nacionalidade"
                                           value="<?= $cliente['nacionalidade'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('nacionalidade') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 form-group pessoa-fisica">
                                <label for="dt_chegada" class="col-form-label-sm">Data Chegada</label>
                                <div class="input-group">
                                    <input type="date"
                                           name="dt_chegada"
                                           id="dt_chegada"
                                           value="<?= $cliente['dt_chegada'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('dt_chegada') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="dt_nascimento_abertura" class="pessoa-fisica">Data de Nacimento</label>
                                <label for="dt_nascimento_abertura" class="pessoa-juridica">Data de Abertura</label>
                                <div class="input-group">
                                    <input type="date"
                                           id="dt_nascimento_abertura"
                                           name="dt_nascimento_abertura"
                                           value="<?= $cliente['dt_nascimento_abertura'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('dt_nascimento_abertura') ?>
                                </small>
                            </div>
                            <div class="col-3 pessoa-fisica">
                                <label for="naturalidade" class="">Naturalidade</label>
                                <div class="input-group">
                                    <input type="number"
                                           id="naturalidade"
                                           name="naturalidade"
                                           value="<?= $cliente['naturalidade'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('naturalidade') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group" hidden>
                                <label for="empresa_id" class="">Empresa</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="empresa_id"
                                           name="empresa_id"
                                           value="<?= session()->get('empresa')['id'] ?>"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 form-group pessoa-juridica">
                                <label for="cnae_cod" class="">CNAE</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="cnae_cod"
                                           name="cnae_cod"
                                           value="<?= $cliente['cnae_cod'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('cnae_cod') ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <!--  Outros  -->
                    <div id="aba2" class="tab-pane fade m-3">
                        <div class="row">
                            <div class="col-2 form-group pessoa-fisica">
                                <label for="profissao" class="">Profissao</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="profissao"
                                           name="profissao"
                                           value="<?= $cliente['profissao'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('profissao') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group pessoa-fisica">
                                <label for="escolaridade" class="">Escolaridade</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="escolaridade"
                                           name="escolaridade"
                                           value="<?= $cliente['escolaridade'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('escolaridade') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group pessoa-fisica">
                                <label for="nome_pai" class="">Nome do Pai</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="nome_pai"
                                           name="nome_pai"
                                           value="<?= $cliente['nome_pai'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('nome_pai') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group pessoa-fisica">
                                <label for="nome_mae" class="">Nome da Mãe</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="nome_mae"
                                           name="nome_mae"
                                           value="<?= $cliente['nome_mae'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('nome_mae') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="telefone01" class="">Telefone</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="telefone01"
                                           name="telefone01"
                                           value="<?= $cliente['telefone01'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('telefone01') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="email" class="">E-mail</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="email"
                                           name="email"
                                           value="<?= $cliente['email'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('email') ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div id="aba3" class="tab-pane fade m-3">
                        <div class="row">
                            <div class="col-sm-3 form-group">
                                <label for="cep" class="col-form-label-sm">Cep</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="cep"
                                           name="cep"
                                           class="form-control"
                                           value="<?= $cliente['cep'] ?? '' ?>">
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
                                       id="logradouro"
                                       name="logradouro"
                                       class="form-control"
                                       value="<?= $cliente['logradouro'] ?? '' ?>">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('logradouro') ?>
                                </small>
                            </div>
                            <div class="col col-sm-1 form-group">
                                <label for="nr" class="col-form-label-sm">Número</label>
                                <input type="text"
                                       id="nr"
                                       name="nr"
                                       class="form-control"
                                       value="<?= $cliente['nr'] ?? '' ?>">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('nr') ?>
                                </small>
                            </div>
                            <div class="col col-sm-2 form-group">
                                <label for="complemento" class="col-form-label-sm">Complemmento</label>
                                <input type="text"
                                       id="complemento"
                                       name="complemento"
                                       class="form-control"
                                       value="<?= $cliente['complemento'] ?? '' ?>">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('complemento') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-sm-2 form-group">
                                <label for="bairro" class="col-form-label-sm">Bairro</label>
                                <input type="text"
                                       id="bairro"
                                       name="bairro"
                                       class="form-control"
                                       value="<?= $cliente['bairro'] ?? '' ?>">
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('bairro') ?>
                                </small>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label for="uf">Estado</label>
                                <select name="uf" id="uf" class="custom-select">
                                    <option selected value="<?= $cliente['uf'] ?? '' ?>">
                                        <?= $cliente['uf'] ?? 'Selecione' ?>
                                    </option>
                                    <option value="RS">RS</option>
                                    <!-- Incluir outros estados aqui -->
                                </select>
                                <small class="text-danger">
                                    <?= \Config\Services::validation()->getError('uf') ?>
                                </small>
                            </div>
                            <div class="col col-sm-2 form-group">
                                <label for="cidade">Muncípio</label>
                                <select type="button" name="cidade" id="cidade"
                                        class="custom-select">
                                    <?php foreach ($municipios as $municipio) : ?>
                                        <option
                                            <?= $cliente['cidade'] == $municipio['descricao'] ? 'selected' : ''?>
                                            value="<?= $municipio['descricao'] ?>" class="dropdown-item">
                                            <?= $municipio['descricao'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('cidade') ?>
                                </small>
                            </div>
                            <input hidden
                                   type="text"
                                   id="cMun"
                                   name="cMun"
                                   value="<?= $cliente['cMun'] ?? '' ?>">
                            <input hidden
                                   type="text"
                                   id="pais"
                                   name="pais"
                                   value="<?= $cliente['pais'] ?? '' ?>">
                        </div>
                    </div>
                    <div id="aba4" class="tab-pane fade m-3">
                        <div class="col-3 form-group">
                            <div class="switch">
                                <input type="hidden" name="pessoa_cliente" value="0">
                                <input type="checkbox" id="pessoa_cliente" name="pessoa_cliente"
                                       value="1" <?= isset($cliente['pessoa_cliente']) ? 'checked' : '' ?>>
                                <label class="slider" for="pessoa_cliente"></label>
                            </div>
                            <label for="pessoa_cliente">Cliente</label>
                            <small class="text-danger position-absolute">
                                <?= \Config\Services::validation()->getError('pessoa_cliente') ?>
                            </small>
                        </div>
                        <div class="col-3 form-group">
                            <div class="switch">
                                <input type="hidden" name="pessoa_fornecedor" value="0">
                                <input type="checkbox" id="pessoa_fornecedor" name="pessoa_fornecedor"
                                       value="1" <?= isset($cliente['pessoa_fornecedor']) ? 'checked' : '' ?>>
                                <label class="slider" for="pessoa_fornecedor"></label>
                            </div>
                            <label for="pessoa_fornecedor">Fornecedor</label>
                            <small class="text-danger position-absolute">
                                <?= \Config\Services::validation()->getError('pessoa_fornecedor') ?>
                            </small>
                        </div>
                        <div class="col-3 form-group">
                            <div class="switch">
                                <input type="hidden" name="pessoa_transpotadora" value="0">
                                <input type="checkbox" id="pessoa_transpotadora" name="pessoa_transpotadora"
                                       value="1" <?= isset($cliente['pessoa_transpotadora']) ? 'checked' : '' ?>>
                                <label class="slider" for="pessoa_transpotadora"></label>
                            </div>
                            <label for="pessoa_transpotadora">Transportadora</label>
                            <small class="text-danger position-absolute">
                                <?= \Config\Services::validation()->getError('pessoa_transpotadora') ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <?= csrf_field(); ?>
            <div class="card-footer py-2">
                <div class="d-flex justify-content-end">
                    <button type="button" onclick="cancelar('empresa/clientes')"
                            class="btn btn-light border-secondary fixed" style="margin-right: 1rem;">
                        <i class="fa fa-arrow-left"></i> Voltar</button>
                    <button class="btn btn-primary fixed"><i class="fa fa-save"></i> Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    var tipoPessoaSelect = document.getElementById('tipo_pessoa');
    var pessoaFisicaInputs = document.getElementsByClassName('pessoa-fisica');
    var pessoaJuridicaInputs = document.getElementsByClassName('pessoa-juridica');

    function exibirCamposCorrespondentes() {
        var tipoPessoa = tipoPessoaSelect.value;

        if (tipoPessoa === '1') { // Pessoa Física
            for (var i = 0; i < pessoaFisicaInputs.length; i++) {
                pessoaFisicaInputs[i].style.display = 'block';
            }
            for (var j = 0; j < pessoaJuridicaInputs.length; j++) {
                pessoaJuridicaInputs[j].style.display = 'none';
            }
        } else if (tipoPessoa === '2') { // Pessoa Jurídica
            for (var k = 0; k < pessoaFisicaInputs.length; k++) {
                pessoaFisicaInputs[k].style.display = 'none';
            }
            for (var l = 0; l < pessoaJuridicaInputs.length; l++) {
                pessoaJuridicaInputs[l].style.display = 'block';
            }
        } else { // Nenhum tipo selecionado
            for (var m = 0; m < pessoaFisicaInputs.length; m++) {
                pessoaFisicaInputs[m].style.display = 'none';
            }
            for (var n = 0; n < pessoaJuridicaInputs.length; n++) {
                pessoaJuridicaInputs[n].style.display = 'none';
            }
        }
    }

    tipoPessoaSelect.addEventListener('change', exibirCamposCorrespondentes);
    exibirCamposCorrespondentes(); // Chamar a função no carregamento da página
</script>