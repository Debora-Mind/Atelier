<?php include __DIR__ . '/../Componentes/inicio-html.php'; ?>
<?php include __DIR__ . '/../Componentes/navbar.php'; ?>

    <div class="d-inline w-100">
        <input type="text" name="busca" id="busca" value="Modelo ou código de barras:" class="w-25">
        <a class="btn btn-primary mb-2">
            <i class="bi bi-search"></i> Buscar
        </a>
        <a href="/novo-modelo" class="btn btn-primary mb-2 end-0 text-end me-0 po">
            <i class="bi bi-plus-circle-fill primary bi-align-middle"> Novo</i>
        </a>
    </div>

    <ul class="list-group">
        <table class="table table-dark table-striped">
            <thead>
            <tr>
                <th scope="col" style="width: 4%">#</th>
                <th scope="col" style="width: 10%">Modelo</th>
                <th scope="col" style="width: 8%">Rel.Produção</th>
                <th scope="col" style="width: 8%">Sublote</th>
                <th scope="col" style="width: 8%">Quantidade</th>
                <th scope="col" style="width: 7%">Valor</th>
                <th scope="col" style="width: 16%">Cod.Barras</th>
                <th scope="col" style="width: 12%">Entrada</th>
                <th scope="col" style="width: 17%">Saída</th>
                <th colspan="3" style="width: 10%" scope="col" class="text-center">Ações</th>
            </tr>
            </thead>
            <tbody class="table table-striped">

            <?php foreach ($modelos as $modelo): ?>
                <tr>
                    <th scope="row"><?= $modelo->getId(); ?></th>
                    <td><?= $modelo->getModelo(); ?></td>
                    <td><?= $modelo->getProducao(); ?></td>
                    <td><?= $modelo->getSublote(); ?></td>
                    <td><?= $modelo->getQuantidade(); ?></td>
                    <td><?= $modelo->getValor(); ?></td>
                    <td><?= $modelo->getCodBarras(); ?></td>
                    <td><?= $modelo->getDataEntrada()->format('d/m/Y'); ?></td>
                    <td><?= $modelo->getDataSaida() ? $modelo->getDataSaida() : ''; ?></td>
                    <td class="text-center px-0">
                        <button title="Dar saída"
                            <?= $modelo->disabled() ?>
                            onclick="darSaida('<?= $modelo->getModelo() ?>', '<?= $modelo->getId(); ?>')"
                            style="border: none; padding: 0">
                            <i class="<?= $modelo->button() ?>" style="color: <?= $modelo->cor() ?>"></i>
                        </button>
                    </td>
                    <td class="text-center px-0">
                        <a title="Editar" href="/alterar-modelo?id=<?= $modelo->getId(); ?>">
                            <i class="bi bi-pencil-square" style="color: black"></i>
                        </a>
                    </td>
                    <td class="text-center px-0">
                        <button title="Excluír?"
                            onclick="excluir('<?= $modelo->getModelo() ?>', '<?= $modelo->getId(); ?>')"
                            style="border: none; padding: 0">
                            <i class="bi bi-trash3-fill" style="color: black"></i>
                        </button>
                    </td>
                <?php endforeach; ?>
            </tbody>
        </table>
    </ul>

<?php include __DIR__ . '/../Componentes/fim-html.php';
