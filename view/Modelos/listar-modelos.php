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
                   placeholder="Digite o modelo"
                   autofocus
                   style="height: 82%; width: 18rem">
            <button class="btn btn-primary text-light mb-2 ms-2" type="submit">
                <i class="bi bi-search"></i> Buscar
            </button>
        </form>
        <div id="menssagem-listar-modelos" class="flex-fill">
            <?php include __DIR__ . '/../Componentes/mensagens.php';?>
        </div>
        <div>
            <a type="button" href="/novo-modelo" class="btn btn-primary text-light mb-2">
                <i class="bi bi-plus-circle-fill primary bi-align-middle"> Novo</i>
            </a>
        </div>
    </div>
    <div class="">
        <table class="table table-primary">
            <thead class="" style="background-color: black;">
            <tr>
                <th scope="col" style="width: 4%">#</th>
                <th scope="col">Modelo</th>
                <th scope="col" style="width: 15%">V.Entrada</th>
                <th scope="col" style="width: 15%">V.Saída</th>
                <th colspan="3" style="width: 5%" scope="col" class="text-center">Ações</th>
            </tr>
            </thead>
            <tbody class="table table-light">
            <?php foreach ($paginacao->paginate()['itens'] as $modelo): ?>
                <tr>
                    <th scope="row"><?= $modelo->getId(); ?></th>
                    <td><?= $modelo->getModelo(); ?></td>
                    <td><?= $modelo->getValorEntrada(true); ?></td>
                    <td><?= $modelo->getValorSaida(true); ?></td>
                    <td class="text-center px-0">
                        <button style="border: none; padding: 0;">
                            <a title="Editar" href="/alterar-modelo?id=<?= $modelo->getId(); ?>">
                                <i class="bi bi-pencil-square ms-2" style="color: black;"></i>
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
            <?php endforeach; ?>
            </tbody>
            <tfoot class="text-start">
                <td colspan="13" class="justify-content-between">
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
                    <li class="page-item"><a class="page-link text-primary border-secondary" href="?pagina=<?= ($paginacao->paginate()['paginaAtual']-1); ?>">Anterior</a></li>
                <?php endif; ?>
                <?php for($i=1;$i<=$paginacao->paginate()['totalPaginas'];$i++): ?>
                    <li class="page-item <?= ($i==$paginacao->paginate()['paginaAtual']) ? 'active' : ''; ?>">
                        <a class="page-link bg-primary border-secondary
                        <?= ($i==$paginacao->paginate()['paginaAtual']) ? 'text-light' : 'text-secondary'; ?>"
                           href="?pagina=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($paginacao->paginate()['paginaAtual'] < $paginacao->paginate()['totalPaginas']): ?>
                    <li class="page-item"><a class="page-link text-primary border-secondary" href="?pagina=<?= ($paginacao->paginate()['paginaAtual']+1); ?>">Próximo</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>

<?php include __DIR__ . '/../Componentes/fim-html.php';
