<?php
include __DIR__ . '/../Componentes/inicio-html.php';
include __DIR__ . '/../Componentes/navbar.php';
$valor = 0;
$qtd = 0;
$linhas = 0;
?>
<div class="">
    <div class="d-flex align-items-center align-items-stretch busca">
        <form action="/modelos" method="post" class="d-flex">
            <input type="text"
                   name="busca"
                   id="busca"
                   placeholder="Digite o modelo ou código de barras"
                   autofocus
                   style="height: 82%; width: 18rem">
            <input type="text"
                   name="semana"
                   id="semana"
                   placeholder="Semana"
                   style="height: 82%;width: 5rem"
            class="ms-2">
            <button class="btn btn-info text-light mb-2 ms-2" type="submit">
                <i class="bi bi-search"></i> Buscar
            </button>
            <select type="button" name="filtro-saida" id="filtro-saida"
                    class="btn btn-toolbar btn-info text-light ms-2 mb-2">
                <option value="1" selected class="dropdown-item bg-white text-start">
                    Todos
                </option>
                <option value="2" class="dropdown-item bg-white text-start">
                    Com saída
                </option>
                <option value="3" class="dropdown-item bg-white text-start">
                    Sem saída
                </option>
            </select>
        </form>
        <div id="menssagem-listar-modelos" class="flex-fill">
            <?php include __DIR__ . '/../Componentes/mensagens.php';?>
        </div>
        <div>
            <a type="button" href="/novo-modelo" class="btn btn-info text-light mb-2">
                <i class="bi bi-plus-circle-fill primary bi-align-middle"> Novo</i>
            </a>
        </div>
    </div>
    <div class="list-group">
        <table class="table table-primary table-striped bg-light">
            <thead class="" style="background-color: black;">
            <tr>
                <th scope="col" style="width: 4%">#</th>
                <th scope="col" style="width: 10%">Modelo</th>
                <th scope="col" style="width: 8%">Rel.Produção</th>
                <th scope="col" style="width: 8%">Sublote</th>
                <th scope="col" style="width: 8%">Quantidade</th>
                <th scope="col" style="width: 7%">Valor</th>
                <th scope="col" style="width: 7%">Semana</th>
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
                    <?php if (in_array(11, $_SESSION['permissoes'])) : ?>
                    <td><?= $modelo->getValor(true); ?></td>
                    <?php else :?>
                    <td>0</td>
                    <?php endif; ?>
                    <td><?= $modelo->getSemana(); ?></td>
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
                                onclick="excluir('modelo', '<?= $modelo->getModelo() ?>', '<?= $modelo->getId(); ?>')"
                                style="border: none; padding: 0;">
                            <i class="bi bi-trash3-fill" style="color: black;"></i>
                        </button>
                    </td>
                </tr>
            <?php
                $valor += (in_array(11, $_SESSION['permissoes'])) ?
                    ($modelo->getValor() * $modelo->getQuantidade()) :
                    0;
                $qtd += $modelo->getQuantidade();
                $linhas += 1;
            ?>
            <?php endforeach; ?>
            <tfoot class="text-start">
            <tr>
                <td></td>
                <td colspan="3">
                    <strong>Total: </strong>
                    <?= number_format($linhas,0, ',', '.'); ?> registros
                </td>
                <td colspan="3">
                    <strong>Quantidade Total: </strong>
                    <?= number_format($qtd,0, ',', '.'); ?>
                </td>
                <td></td>
                <td colspan="4" class="text-end">
                    <strong>Valor Total: </strong>
                    <?= number_format($valor, 2, ',', '.'); ?>
                </td>
                <td></td>
            </tr>
            </tfoot>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../Componentes/fim-html.php';
