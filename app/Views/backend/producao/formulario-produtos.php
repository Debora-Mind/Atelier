<div class="col-sm-12">
    <div class="card shadow">
        <div class="card-header pt-2">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" data-bs-toggle="tab" href="#aba1">Principal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#aba2">Impostos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#aba3">Tributário</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#aba4">Parâmetros</a>
                </li>
            </ul>
        </div>
        <form action="<?= base_url('producao/salvar-produto') ?>" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="tab-content">
                    <!--  Principal  -->
                    <div hidden>
                        <input type="text" id="id" name="id" value="<?= $produto['id'] ?? '' ?>">
                        <input type="text" id="empresa_id" name="empresa_id" value="<?= session()->get('empresa')['id'] ?? '' ?>">
                    </div>
                    <div id="aba1" class="tab-pane fade m-3 show active">
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label for="xProd" class="col-form-label-sm">Descrição</label>
                                <div class="input-group">
                                    <input type="text"
                                           name="xProd"
                                           id="xProd"
                                           value="<?= $produto['xProd'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('xProd') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="tp_produto" class="">Tipo de Produto</label>
                                <div class="input-group">
                                    <select id="tp_produto" name="tp_produto" class="form-control">
                                        <option disabled selected value="">Selecione</option>
                                        <option value="1" <?= ($produto['tp_produto'] ?? '') == '1' ? 'selected' : '' ?>>Serviço</option>
                                        <option value="2" <?= ($produto['tp_produto'] ?? '') == '2' ? 'selected' : '' ?>>Produto</option>
                                    </select>
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tp_produto') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="departamento" class="">Departamento</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="departamento"
                                           name="departamento"
                                           value="<?= $produto['departamento'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('departamento') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="classe" class="">Classe</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="classe"
                                           name="classe"
                                           value="<?= $produto['classe'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('classe') ?>
                                </small>
                            </div>
                            <div class="col-4 form-group">
                                <label for="ICMS_beneficio" class="">Cliente</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="ICMS_beneficio"
                                           name="ICMS_beneficio"
                                           value="<?= $produto['ICMS_beneficio'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('ICMS_beneficio') ?>
                                </small>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label for="cod_fabrica" class="col-form-label-sm">Referência da Fabrica</label>
                                <div class="input-group">
                                    <input type="text"
                                           name="cod_fabrica"
                                           id="cod_fabrica"
                                           value="<?= $produto['cod_fabrica'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('cod_fabrica') ?>
                                </small>
                            </div>
                            <div class="col-2">
                                <label for="cProd" class="">Código Real</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="cProd"
                                           name="cProd"
                                           value="<?= $produto['cProd'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('cProd') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="grupo" class="">Grupo</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="grupo"
                                           name="grupo"
                                           value="<?= $produto['grupo'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('grupo') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="sub_grupo" class="">Subgrupo</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="sub_grupo"
                                           name="sub_grupo"
                                           value="<?= $produto['sub_grupo'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('sub_grupo') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 form-group">
                                <label for="cEAN" class="col-form-label-sm">Código de Barras</label>
                                <div class="input-group">
                                    <input type="number"
                                           name="cEAN"
                                           id="cEAN"
                                           value="<?= $produto['cEAN'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('cEAN') ?>
                                </small>
                            </div>
                            <div class="col-3">
                                <label for="cEANTrib" class="">Código de Barras da Caixa</label>
                                <div class="input-group">
                                    <input type="number"
                                           id="cEANTrib"
                                           name="cEANTrib"
                                           value="<?= $produto['cEANTrib'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('cEANTrib') ?>
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
                            <div class="col-6 form-group">
                                <label for="img" class="">Foto</label>
                                <div class="input-group">
                                    <input type="file"
                                           id="img"
                                           name="img"
                                           class="form-control-file">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-6 form-group">
                                <label for="pdf" class="">Roteiro</label>
                                <div class="input-group">
                                    <input type="file"
                                           id="pdf"
                                           name="pdf"
                                           class="form-control-file">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  Outros  -->
                    <div id="aba2" class="tab-pane fade m-3">
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="valor" class="">Valor</label>
                                <div class="input-group">
                                    <input type="number"
                                           step="0.01"
                                           id="valor"
                                           name="valor"
                                           value="<?= $produto['valor'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('valor') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="valor_entrada" class="">Valor de Entrada</label>
                                <div class="input-group">
                                    <input type="number"
                                           step="0.01"
                                           id="valor_entrada"
                                           name="valor_entrada"
                                           value="<?= $produto['valor_entrada'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('valor_entrada') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="valor_saida" class="">Valor de Saída</label>
                                <div class="input-group">
                                    <input type="number"
                                           step="0.01"
                                           id="valor_saida"
                                           name="valor_saida"
                                           value="<?= $produto['valor_saida'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('valor_saida') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="margem_lucro_bruto" class="">Lucro Bruto</label>
                                <div class="input-group">
                                    <input type="number"
                                           step="0.01"
                                           id="margem_lucro_bruto"
                                           name="margem_lucro_bruto"
                                           value="<?= $produto['margem_lucro_bruto'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('margem_lucro_bruto') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="CFOP_Saida" class="">Código CFOP Saída</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="CFOP_Saida"
                                           name="CFOP_Saida"
                                           value="<?= $produto['CFOP_Saida'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('CFOP_Saida') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="CFOP_Entrada" class="">Código CFOP Entrada</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="CFOP_Entrada"
                                           name="CFOP_Entrada"
                                           value="<?= $produto['CFOP_Entrada'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('CFOP_Entrada') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="CEST" class="">CEST</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="CEST"
                                           name="CEST"
                                           value="<?= $produto['CEST'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('CEST') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="tICMS_mva" class="">Percentual MVA</label>
                                <div class="input-group">
                                    <input type="number"
                                           step="0.01"
                                           id="tICMS_mva"
                                           name="tICMS_mva"
                                           value="<?= $produto['tICMS_mva'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tICMS_mva') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="tPIS_cst" class="">PIS</label>
                                <div class="input-group">
                                    <input type="number"
                                           id="tPIS_cst"
                                           name="tPIS_cst"
                                           value="<?= $produto['tPIS_cst'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tPIS_cst') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="tPIS_tpcalc" class="">Calculo PIS</label>
                                <div class="input-group">
                                    <select id="tPIS_tpcalc" name="tPIS_tpcalc" class="form-control">
                                        <option disabled selected value="">Selecione</option>
                                        <option value="1" <?= ($produto['tPIS_tpcalc'] ?? '') == '1' ? 'selected' : '' ?>>Percentual(%)</option>
                                        <option value="2" <?= ($produto['tPIS_tpcalc'] ?? '') == '2' ? 'selected' : '' ?>>Valor(R$)</option>
                                    </select>
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tPIS_tpcalc') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="tPIS_aliq" class="">Aliquota PIS</label>
                                <div class="input-group">
                                    <input type="number"
                                           step="0.01"
                                           id="tPIS_aliq"
                                           name="tPIS_aliq"
                                           value="<?= $produto['tPIS_aliq'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tPIS_aliq') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="tCOFINS_cst" class="">COFINS</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="tCOFINS_cst"
                                           name="tCOFINS_cst"
                                           value="<?= $produto['tCOFINS_cst'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tCOFINS_cst') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="tCOFINS_tpcalc" class="">Calculo COFINS</label>
                                <div class="input-group">
                                    <select id="tCOFINS_tpcalc" name="tCOFINS_tpcalc" class="form-control">
                                        <option disabled selected value="">Selecione</option>
                                        <option value="1" <?= ($produto['tCOFINS_tpcalc'] ?? '') == '1' ? 'selected' : '' ?>>Percentual(%)</option>
                                        <option value="2" <?= ($produto['tCOFINS_tpcalc'] ?? '') == '2' ? 'selected' : '' ?>>Valor(R$)</option>
                                    </select>
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tCOFINS_tpcalc') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="tCOFINS_aliq" class="">Aliquota COFINS</label>
                                <div class="input-group">
                                    <input type="number"
                                           step="0.01"
                                           id="tCOFINS_aliq"
                                           name="tCOFINS_aliq"
                                           value="<?= $produto['tCOFINS_aliq'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tCOFINS_aliq') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="tIPI_cst" class="">IPI</label>
                                <div class="input-group">
                                    <input type="number"
                                           id="tIPI_cst"
                                           name="tIPI_cst"
                                           value="<?= $produto['tIPI_cst'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tIPI_cst') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="tIPI_tpcalc" class="">Calculo IPI</label>
                                <div class="input-group">
                                    <select id="tIPI_tpcalc" name="tIPI_tpcalc" class="form-control">
                                        <option disabled selected value="">Selecione</option>
                                        <option value="1" <?= ($produto['tIPI_tpcalc'] ?? '') == '1' ? 'selected' : '' ?>>Percentual(%)</option>
                                        <option value="2" <?= ($produto['tIPI_tpcalc'] ?? '') == '2' ? 'selected' : '' ?>>Valor(R$)</option>
                                    </select>
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tIPI_tpcalc') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="tIPI_aliq" class="">Aliquota IPI</label>
                                <div class="input-group">
                                    <input type="number"
                                           step="0.01"
                                           id="tIPI_aliq"
                                           name="tIPI_aliq"
                                           value="<?= $produto['tIPI_aliq'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tIPI_aliq') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="tICMS_cst_A" class="">ICMS A</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="tICMS_cst_A"
                                           name="tICMS_cst_A"
                                           value="<?= $produto['tICMS_cst_A'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tICMS_cst_A') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="tICMS_cst" class="">ICMS B</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="tICMS_cst"
                                           name="tICMS_cst"
                                           value="<?= $produto['tICMS_cst'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tICMS_cst') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="tICMS_tpcalc" class="">Calculo ICMS</label>
                                <div class="input-group">
                                    <select id="tICMS_tpcalc" name="tICMS_tpcalc" class="form-control">
                                        <option disabled selected value="">Selecione</option>
                                        <option value="1" <?= ($produto['tICMS_tpcalc'] ?? '') == '1' ? 'selected' : '' ?>>Percentual(%)</option>
                                        <option value="2" <?= ($produto['tICMS_tpcalc'] ?? '') == '2' ? 'selected' : '' ?>>Valor(R$)</option>
                                    </select>
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tICMS_tpcalc') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="tICMS_aliq" class="">Aliquota ICMS</label>
                                <div class="input-group">
                                    <input type="number"
                                           step="0.01"
                                           id="tICMS_aliq"
                                           name="tICMS_aliq"
                                           value="<?= $produto['tICMS_aliq'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tICMS_aliq') ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div id="aba3" class="tab-pane fade m-3">
                        <div class="row">

                            <div class="col-2 form-group">
                                <label for="uCom_Entrada" class="">Un. Med. Entrada</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="uCom_Entrada"
                                           name="uCom_Entrada"
                                           value="<?= $produto['uCom_Entrada'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('uCom_Entrada') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="uCom_Saida" class="">Un. Med. Saída</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="uCom_Saida"
                                           name="uCom_Saida"
                                           value="<?= $produto['uCom_Saida'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('uCom_Saida') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="uTrib" class="">Un. Med. Tributada</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="uTrib"
                                           name="uTrib"
                                           value="<?= $produto['uTrib'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('uTrib') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="qTrib" class="">Quantidade Tributada</label>
                                <div class="input-group">
                                    <input type="number"
                                           step="0.01"
                                           id="qTrib"
                                           name="qTrib"
                                           value="<?= $produto['qTrib'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('qTrib') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="vUnTrib" class="">Valor Tributario</label>
                                <div class="input-group">
                                    <input type="number"
                                           step="0.01"
                                           id="vUnTrib"
                                           name="vUnTrib"
                                           value="<?= $produto['vUnTrib'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('vUnTrib') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="tp_item" class="">Tipo de Item</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="tp_item"
                                           name="tp_item"
                                           value="<?= $produto['tp_item'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tp_item') ?>
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 form-group">
                                <label for="NCM" class="">Nomenclatura Mercosul</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="NCM"
                                           name="NCM"
                                           value="<?= $produto['NCM'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('NCM') ?>
                                </small>
                            </div>
                            <div class="col-2 form-group">
                                <label for="tICMS_origem" class="">Origem do Produto</label>
                                <div class="input-group">
                                    <input type="text"
                                           id="tICMS_origem"
                                           name="tICMS_origem"
                                           value="<?= $produto['tICMS_origem'] ?? ''?>"
                                           class="form-control">
                                </div>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('tICMS_origem') ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div id="aba4" class="tab-pane fade m-3">
                            <div class="col-3 form-group">
                                <div class="switch">
                                    <input type="checkbox" id="ICMS_beneficio" name="ICMS_beneficio"
                                           value="Sim" <?= ($produto['ICMS_beneficio'] ?? '') ? 'checked' : '' ?>>
                                    <label class="slider" for="ICMS_beneficio"></label>
                                </div>
                                <label for="ICMS_beneficio" class="">Beneficio Fiscal</label>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('ICMS_beneficio') ?>
                                </small>
                            </div>
                            <div class="col-3 form-group">
                                <div class="switch">
                                    <input type="checkbox" id="vender_sem_estoque" name="vender_sem_estoque"
                                           value="Sim" <?= ($produto['vender_sem_estoque'] ?? '') ? 'checked' : '' ?>>
                                    <label class="slider" for="vender_sem_estoque"></label>
                                </div>
                                <label for="vender_sem_estoque" class="">Vender sem Estoque</label>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('vender_sem_estoque') ?>
                                </small>
                            </div>
                            <div class="col-3 form-group">
                                <div class="switch">
                                    <input type="checkbox" id="prod_balanca" name="prod_balanca"
                                           value="Sim" <?= ($produto['prod_balanca'] ?? '') ? 'checked' : '' ?>>
                                    <label class="slider" for="prod_balanca"></label>
                                </div>
                                <label for="prod_balanca" class="">Vendido por Peso</label>
                                <small class="text-danger position-absolute">
                                    <?= \Config\Services::validation()->getError('prod_balanca') ?>
                                </small>
                            </div>
                    </div>
                </div>
            </div>
            <?= csrf_field(); ?>
            <div class="card-footer py-2">
                <div class="d-flex justify-content-end">
                    <button type="button" onclick="cancelar('producao/produtos')"
                            class="btn btn-light border-secondary fixed" style="margin-right: 1rem;">
                        <i class="fa fa-arrow-left"></i> Voltar</button>
                    <button class="btn btn-primary fixed"><i class="fa fa-save"></i> Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>