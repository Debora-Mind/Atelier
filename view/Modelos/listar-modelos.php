<?php
include __DIR__ . '/../Componentes/inicio-html.php';
include __DIR__ . '/../Componentes/navbar.php';

?>

    <div class="d-flex align-items-center align-items-stretch">
        <form action="/modelos" method="post">
            <input type="text" name="busca" id="busca" placeholder="Digite o modelo ou código de barras" autofocus>
            <button class="btn btn-primary mb-2" type="submit">
                <i class="bi bi-search"></i> Buscar
            </button>
        </form>
        <div id="menssagem-listar-modelos" class="flex-fill">
            <?php include __DIR__ . '/../Componentes/mensagens.php';?>
        </div>
        <div>
            <a type="button" href="/novo-modelo" class="btn btn-primary mb-2">
                <i class="bi bi-plus-circle-fill primary bi-align-middle"> Novo</i>
            </a>
        </div>
    </div>

    <ul class="list-group">
        <table class="table table-dark table-striped">
            <thead style="background-color: black;">
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
                                style="border: none; padding: 0;">
                            <i class="<?= $modelo->button() ?>" style="color: <?= $modelo->cor() ?>"></i>
                        </button>
                    </td>
                    <td class="text-center px-0">
                        <a title="Editar" href="/alterar-modelo?id=<?= $modelo->getId(); ?>">
                            <i class="bi bi-pencil-square" style="color: black;"></i>
                        </a>
                    </td>
                    <td class="text-center px-0">
                        <button title="Excluir?"
                                onclick="excluir('<?= $modelo->getModelo() ?>', '<?= $modelo->getId(); ?>')"
                                style="border: none; padding: 0;">
                            <i class="bi bi-trash3-fill" style="color: black;"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </ul>

<?php include __DIR__ . '/../Componentes/fim-html.php';
