<?php include __DIR__ . '/../Componentes/inicio-html.php'; ?>
<?php include __DIR__ . '/../Componentes/navbar.php'; ?>

    <a href="/novo-modelo" class="btn btn-primary mb-2">
        <i class="bi bi-plus-circle-fill primary bi-align-middle"> Novo</i>
    </a>

    <ul class="list-group">
        <table class="table table-dark table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Modelo</th>
                <th scope="col">Rel.Produção</th>
                <th scope="col">Sublote</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Valor</th>
                <th scope="col">Cod.Barras</th>
                <th scope="col">Entrada</th>
                <th scope="col">Saída</th>
                <th colspan="2" scope="col" width="6%">Ações</th>
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
                    <td><?= $modelo->getDataSaida() ? $modelo->getDataSaida()->format('d/m/Y H:i') : ''; ?></td>
                    <td class="text-center">
                        <a title="Editar" href="/alterar-modelo?id=<?= $modelo->getId(); ?>">
                            <i class="bi bi-pencil-square" style="color: black"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a title="Excluír" href="/excluir-modelo?id=<?= $modelo->getId(); ?>" style="color: black">
                            <i class="bi bi-trash3-fill" style="color: black"></i>
                        </a>
                    </td>
                <?php endforeach; ?>
            </tbody>
        </table>
    </ul>

<?php include __DIR__ . '/../Componentes/fim-html.php';
