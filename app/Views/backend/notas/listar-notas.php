<div class="col-sm-12">
    <div class="card shadow">
        <div class="d-flex justify-content-sm-between align-items-sm-stretch card-header">
            Buscar NFe
        </div>
        <form action="/notas" method="post">
            <div class="card-body">
                <div class="row w-100">
                    <div class="d-inline-flex col-12">
                        <div class="col-12 form-group">
                            <label for="busca" class="col-form-label">Empresa</label>
                            <input type="text"
                                   name="busca"
                                   id="busca"
                                   autofocus
                                   class="input-group-sm shadow-sm col-12">
                        </div>
                    </div>
                    <div class="d-inline-flex col-12">
                        <div class="col-4">
                            <label for="nfe" class="">Número NF-e</label>
                            <input type="text"
                                   id="nfe"
                                   name="nfe"
                                   class="input-group-sm shadow-sm w-100">
                        </div>
                        <div class="col-4 form-group">
                            <label for="ide_serie" class="">Série</label>
                            <input type="text"
                                   id="ide_serie"
                                   name="ide_serie"
                                   class="input-group-sm shadow-sm w-100">
                        </div>
                        <div class="col-4 form-group">
                            <label for="modelo" class="">Modelo</label>
                            <input type="text"
                                   id="modelo"
                                   name="modelo"
                                   class="input-group-sm shadow-sm w-100">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer pt-2 pb-0">
                <div class="row w-100">
                    <div class="form-group">
                        <?= csrf_field(); ?>
                        <button class="btn-sm btn-primary text-light mx-sm-3" type="submit">
                            <i class="bi bi-search"></i> Buscar
                        </button>
                    </div>
                    <div class="form-group">
                        <a href="<?= base_url('notas/cadastrar') ?>">
                            <button class="btn-sm btn-light mx-sm-3 border-primary" type="button">
                                <i class="bi bi-plus-circle-fill bi-align-middle"></i> Cadastrar
                            </button>
                        </a>
                    </div>
                    <div class="form-group">
                        <a href="<?= base_url('notas/status-sefaz') ?>">
                            <button class="btn-sm btn-light mx-sm-3 border-primary" type="button">
                                <i class="bi bi-plus-circle-fill bi-align-middle"> STATUS SEFAZ</i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card shadow mt-1">
        <div class="card-body mt-2">
            <table class="table-sm table dataTable table-striped mb-3 w-100">
                <thead>
                    <tr role="row">
                        <th style="width: 10%" class="sorting" tabindex="0"></th>
                        <th style="width: 25%" class="sorting" tabindex="0">Cliente</th>
                        <th style="width: 5%" class="sorting" tabindex="0">Status</th>
                        <th style="width: 15%" class="sorting" tabindex="0">Retorno</th>
                        <th style="width: 6%" class="sorting" tabindex="0">NºNF-e</th>
                        <th style="width: 6%" class="sorting" tabindex="0">Série</th>
                        <th style="width: 10%" class="sorting" tabindex="0">Protocolo</th>
                        <th class="sorting" tabindex="0">Chave</th>
                    </tr>
                </thead>
                <tbody class="table-sm table-striped">
                <?php foreach ($nfes as $nfe): ?>
                    <tr>
                        <input type="hidden" name="id" id="id" value="<?= $nfe['id'] ?>">
                        <th>
                            <select name="acoes" onchange="redirect(this)">
                                <option value="" selected disabled>
                                    <i class="fa fa-cog"></i> Ações
                                </option>
                                <?php if ($nfe['status_id'] == 1): ?>
                                <option value="<?= base_url('notas/cadastrar?id=' . $nfe['id']) ?>" data-url="<?= base_url('notas/cadastrar?id=' . $nfe['id']) ?>">
                                    <i class="fa fa-server text-danger mx-1"> Visualizar</i>
                                </option>
                                <option href="<?= base_url('notas/transmitir') ?>">
                                    <i class="fa fa-server"></i> Faturar
                                </option>
                                <?php elseif ($nfe['status_id'] == 2): ?>
                                <option href="<?= base_url('notas/transmitir') ?>">
                                    <i class="fa fa-server"></i> Transmitir
                                </option>
                                <?php elseif ($nfe['status_id'] == 5): ?>
                                <option href="<?= base_url('notas/transmitir') ?>">
                                    <i class="fa fa-server"></i> Baixar XML
                                </option>
                                <option href="<?= base_url('notas/transmitir') ?>">
                                    <i class="fa fa-server"></i> Imprimir
                                </option>
                                <option href="<?= base_url('notas/transmitir') ?>">
                                    <i class="fa fa-server"></i> Nota de correção
                                </option>
                                <option href="<?= base_url('notas/transmitir') ?>">
                                    <i class="fa fa-server"></i> Cancelar
                                </option>
                                <?php elseif ($nfe['status_id'] == 10): ?>
                                <?php endif; ?>
                            </select>
                        </th>
                        <td><?= $cliente->getClientes($nfe['cliente_id'])['apelido_nome_fantasia'] . ' - '
                                . $cliente->getClientes($nfe['cliente_id'])['cpf_cnpj']?? '' ?></td>
                        <td>
                            <div class="btn-group-sm btn-<?= $status->getStatus($nfe['status_id'])['cor'] ?? ''?> py-1 px-1">
                                <?= $status->getStatus($nfe['status_id'])['titulo'] ?? ''?>
                            </div>
                        </td>
                        <td><?= $nfe['xEvento'] ?? ''?></td>
                        <td><?= $nfe['numero_nfe'] ?? ''?></td>
                        <td><?= $nfe['ide_serie'] ?? ''?></td>
                        <td><?= $nfe['nfe_prot'] ?? ''?></td>
                        <td><?= $nfe['ide_chave_nfe' ?? '']?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links(); ?>
        </div>
    </div>
</div>

<script>
    function redirect(select) {
        var selectedOption = select.options[select.selectedIndex];
        var url = selectedOption.getAttribute('data-url');
        if (url) {
            window.location.href = url;
        }
    }
</script>