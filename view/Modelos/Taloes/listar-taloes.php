<?php

use Dam\Atelier\Model\Funcoes\Calcular;
use Dam\Atelier\Model\Funcoes\Paginacao;

include __DIR__ . '/../../Componentes/inicio-html.php';
include __DIR__ . '/../../Componentes/navbar.php';

$qtd = 0;
$calcula = new Calcular();
$paginacao = new Paginacao($taloes);
$paginado = $paginacao->paginate();

?>
<div class="">
    <div class="d-flex align-items-center align-items-stretch busca">
        <form action="/taloes" method="post" class="d-flex">
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
                    class="btn btn-toolbar btn-primary text-light ms-2 mb-2">
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
            <button class="btn btn-primary text-light mb-2 ms-2" type="submit">
                <i class="bi bi-search"></i> Buscar
            </button>
        </form>
        <div id="menssagem-listar-modelos" class="flex-fill">
            <?php include __DIR__ . '/../../Componentes/mensagens.php';?>
        </div>
        <div>
            <a type="button" href="/novo-talao" class="btn btn-primary text-light mb-2">
                <i class="bi bi-plus-circle-fill primary bi-align-middle"> Novo</i>
            </a>
        </div>
    </div>
    <div class="">
        <table class="table table-primary">
            <thead class="" style="background-color: black;">
            <tr>
                <th scope="col" style="width: 3%">#</th>
                <th scope="col">Modelo</th>
                <th scope="col" style="width: 6%">R.Produção</th>
                <th scope="col" style="width: 6%">Sublote</th>
                <th scope="col" style="width: 6%">Quantidade</th>
                <?php if (in_array(11, $_SESSION['permissoes'])) : ?>
                <th scope="col" style="width: 7%">V.Entrada</th>
                <th scope="col" style="width: 7%">T.Entrada</th>
                <th scope="col" style="width: 7%">V.Saída</th>
                <th scope="col" style="width: 7%">T.Saída</th>
                <?php endif;?>
                <th scope="col" style="width: 5%">Semana</th>
                <th scope="col" style="width: 8%">Cod.Barras</th>
                <th scope="col" style="width: 6%">Entrada</th>
                <th scope="col" style="width: 10%">Saída</th>
                <th scope="col" style="width: 10%">Nota</th>
                <th colspan="5" style="width: 3%" scope="col" class="text-center">Ações</th>
            </tr>
            </thead>
            <tbody class="table">
            <?php foreach ($paginado['itens'] as $talao): ?>
                <tr <?=  $calcula->corDaLinha($talao, $empresa, $entityManager); ?>>
                    <th scope="row"><?= $talao->getId(); ?></th>
                    <td><?= $talao->getModelo()->getModelo(); ?></td>
                    <td><?= $talao->getProducao(); ?></td>
                    <td><?= $talao->getSublote(); ?></td>
                    <td><?= $talao->getQuantidade(); ?></td>
                    <?php if (in_array(11, $_SESSION['permissoes'])) : ?>
                    <td><?= $talao->getModelo()->getValorEntrada(true); ?></td>
                    <td><?= $talao->getModelo()->getValorEntrada(true) * $talao->getQuantidade(); ?></td>
                    <td><?= $talao->getModelo()->getValorSaida(true); ?></td>
                    <td><?= $talao->getModelo()->getValorSaida(true) * $talao->getQuantidade(); ?></td>
                    <?php endif; ?>
                    <td><?= $talao->getSemana(); ?></td>
                    <td><?= $talao->getCodBarras(); ?></td>
                    <td><?= $talao->getDataEntrada()->format('d/m/Y'); ?></td>
                    <td><?= $talao->getDataSaida() ? $talao->getDataSaida() : ''; ?></td>
                    <td><?= $talao->getNotaFiscal(); ?></td>
                    <td class="text-center px-0">
                        <button title="Dar saída"
                            <?= $talao->disabled() ?>
                                onclick="darSaida('<?= $talao->getModelo()->getModelo() ?>', '<?= $talao->getId(); ?>')"
                                style="border: none; padding: 0;"
                                class="mx-1">
                            <i class="<?= $talao->button() ?>" style="color: <?= $talao->cor() ?>"></i>
                        </button>
                    </td>
                    <td class="text-center px-0">
                        <button
                        <?php if ($talao->getModelo()->getRoteiro() !== null) :?>
                                title="Ver roteiro"
                                class="mx-1"
                                onclick="window.open('visualizar-documento?id=<?= $talao->getModelo()->getId(); ?>')"
                                style="border: none; padding: 0;">
                            <i class="bi bi-eye-fill" style="color: black;"></i>
                        <?php else: ?>
                                disabled
                                class="mx-1"
                                title="O roteiro não foi inserido"
                                style="border: none; padding: 0;">
                            <i class="bi bi-eye-slash" style="color: black;"></i>
                        <?php endif;?>
                        </button>
                    </td>
                    <td class="text-center px-0">
                        <button
                            <?php if ($talao->getModelo()->getImagemModelo() !== null) :?>
                                title="Ver foto"
                                class="mx-1"
                                onclick="window.open('visualizar-imagem?id=<?= $talao->getModelo()->getId(); ?>')"
                                style="border: none; padding: 0;">
                            <i class="bi bi-image" style="color: black;"></i>
                            <?php else: ?>
                                disabled
                                class="mx-1"
                                title="A imagem não foi inserida"
                                style="border: none; padding: 0;">
                                <i class="bi bi-x-lg" style="color: black;"></i>
                            <?php endif;?>
                        </button>
                    </td>
                    <td class="text-center px-0">
                        <button style="border: none; padding: 0;" class="mx-1">
                            <a title="Editar" href="/alterar-talao?id=<?= $talao->getId(); ?>">
                                <i class="bi bi-pencil-square" style="color: black;"></i>
                            </a>
                        </button>
                    </td>
                    <td class="text-center px-0">
                        <button title="Excluir?"
                                onclick="excluir('talao', '<?= $talao->getModelo()->getModelo() ?>', '<?= $talao->getId(); ?>')"
                                style="border: none; padding: 0;"
                                class="mx-1">
                            <i class="bi bi-trash3-fill" style="color: black;"></i>
                        </button>
                    </td>
                </tr>
            <?php
                $qtd += $talao->getQuantidade();
            ?>
            <?php endforeach; ?>
            </tbody>
            <tfoot class="text-start">
                <td colspan="19" class="justify-content-between">
                    <span class="float-start me-3">
                        <strong>Valor Total Entrada: </strong>
                        <?= in_array(11, $_SESSION['permissoes'])
                            ? number_format($paginacao->getValorTotalEntrada(), 2, ',', '.')
                            : '*' ?>
                    </span>
                    <span class="float-start mx-3">
                        <strong>Valor Total Saída: </strong>
                        <?= in_array(11, $_SESSION['permissoes'])
                            ? number_format($paginacao->getValorTotalSaida(), 2, ',', '.')
                            : '*' ?>
                    </span>
                    <span class="float-start mx-3">
                        <strong>Quantidade Total: </strong>
                        <?= number_format($paginacao->getQuantidadeTotal(),0, ',', '.'); ?>
                    </span>
                </td>
            </tfoot>
        </table>
        <div class="text-center text-secondary">
            <?= $paginacao->getPrimeiroRegistro() ?> - <?= $paginacao->getUltimoRegistro() ?> de <?= $paginacao->getTotalItens() ?>
        </div>
        <nav class="position-sticky">
            <ul class="pagination justify-content-center">
                <?php if ($paginacao->paginate()['paginaAtual'] > 1): ?>
                    <li class="page-item"><a class="page-link text-primary border-secondary" href="?pagina=<?= ($paginacao->paginate()['paginaAtual']-1); ?>">Anterior</a></li>
                <?php endif; ?>
                <?php for($i=1;$i<=$paginacao->paginate()['totalPaginas'];$i++): ?>
                    <li class="page-item <?= ($i==$paginacao->paginate()['paginaAtual']) ? 'active' : ''; ?>">
                        <a class="page-link bg-primary border-secondary
                        <?= ($i==$paginacao->paginate()['paginaAtual']) ? 'text-light' : 'text-secondary'; ?>"
                           href="?pagina=<?= $i; ?>"
                            onclick="<?php $_SESSION['pagina'] = true ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($paginacao->paginate()['paginaAtual'] < $paginacao->paginate()['totalPaginas']): ?>
                    <li class="page-item"><a class="page-link text-primary border-secondary" href="?pagina=<?= ($paginacao->paginate()['paginaAtual']+1); ?>">Próximo</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>

<?php include __DIR__ . '/../../Componentes/fim-html.php';
