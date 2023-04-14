<?php

use Dam\Atelier\Model\Funcoes\Calcular;
use Dam\Atelier\Model\Funcoes\Paginacao;

include __DIR__ . '/../Componentes/inicio-html.php';
include __DIR__ . '/../Componentes/navbar.php';

$qtd = 0;
$calcula = new Calcular();
$paginacao = new Paginacao($modelos);
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
            <input type="number"
                   name="semana"
                   id="semana"
                   placeholder="Semana"
                   style="height: 82%;width: 5rem"
            class="ms-2">
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
            <button class="btn btn-info text-light mb-2 ms-2" type="submit">
                <i class="bi bi-search"></i> Buscar
            </button>
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
        <table class="table table-primary bg-light">
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
            <tbody class="table">
            <?php foreach ($paginacao->paginate()['itens'] as $modelo): ?>
                <tr <?=  $calcula->corDaLinha($modelo, $entityManager); ?>>
                    <th scope="row"><?= $modelo->getId(); ?></th>
                    <td><?= $modelo->getModelo(); ?></td>
                    <td><?= $modelo->getProducao(); ?></td>
                    <td><?= $modelo->getSublote(); ?></td>
                    <td><?= $modelo->getQuantidade(); ?></td>
                    <?php if (in_array(11, $_SESSION['permissoes'])) : ?>
                    <td><?= $modelo->getValor(true); ?></td>
                    <?php else :?>
                    <td>*</td>
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
                        <button style="border: none; padding: 0;">
                            <a title="Editar" href="/alterar-modelo?id=<?= $modelo->getId(); ?>">
                                <i class="bi bi-pencil-square" style="color: black;"></i>
                            </a>
                        </button>
                    </td>
                    <td class="text-center px-0">
                        <button title="Excluir?"
                                onclick="excluir('modelo', '<?= $modelo->getModelo() ?>', '<?= $modelo->getId(); ?>')"
                                style="border: none; padding: 0;"
                                class="mx-2">
                            <i class="bi bi-trash3-fill" style="color: black;"></i>
                        </button>
                    </td>
                </tr>
            <?php
                $qtd += $modelo->getQuantidade();
            ?>
            <?php endforeach; ?>
            </tbody>
            <tfoot class="text-start">
                <td colspan="13" class="justify-content-between">
                    <span class="float-start mx-2">
                        <strong>Total nesta página: </strong>
                        <?= number_format($paginacao->getTotalItensPagina(),0, ',', '.'); ?> registros
                    </span>
                    <span class="float-start mx-2">
                        <strong>Quantidade total nesta página: </strong>
                        <?= in_array(11, $_SESSION['permissoes'])
                            ? number_format($qtd,0, ',', '.')
                            : '*' ?>
                    </span>
                    <span class="float-start mx-2">
                        <strong>Valor total nesta página: </strong>
                        <?= number_format($paginacao->getValorTotalItensPagina(), 2, ',', '.'); ?>
                    </span>
                    <span class="float-end mx-2">
                        <strong>Valor Total: </strong>
                        <?= in_array(11, $_SESSION['permissoes'])
                            ? number_format($paginacao->getValorTotalItens(), 2, ',', '.')
                            : '*' ?>
                    </span>
                    <span class="float-end mx-2">
                        <strong>Quantidade Total: </strong>
                        <?= number_format($paginacao->getQuantidadeTotal(),0, ',', '.'); ?>
                    </span>
                    <span class="float-end mx-2">
                        <strong>Total: </strong>
                        <?= number_format($paginacao->getTotalItens(),0, ',', '.'); ?> registros
                    </span>
                </td>
            </tfoot>
        </table>
        <nav class="position-sticky">
            <ul class="pagination justify-content-center">
                <?php if ($paginacao->paginate()['paginaAtual'] > 1): ?>
                    <li class="page-item"><a class="page-link text-info border-secondary" href="?pagina=<?= ($paginacao->paginate()['paginaAtual']-1); ?>">Anterior</a></li>
                <?php endif; ?>
                <?php for($i=1;$i<=$paginacao->paginate()['totalPaginas'];$i++): ?>
                    <li class="page-item <?= ($i==$paginacao->paginate()['paginaAtual']) ? 'active' : ''; ?>">
                        <a class="page-link bg-info border-secondary
                        <?= ($i==$paginacao->paginate()['paginaAtual']) ? 'text-light' : 'text-secondary'; ?>"
                           href="?pagina=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($paginacao->paginate()['paginaAtual'] < $paginacao->paginate()['totalPaginas']): ?>
                    <li class="page-item"><a class="page-link text-info border-secondary" href="?pagina=<?= ($paginacao->paginate()['paginaAtual']+1); ?>">Próximo</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>

<?php include __DIR__ . '/../Componentes/fim-html.php';
