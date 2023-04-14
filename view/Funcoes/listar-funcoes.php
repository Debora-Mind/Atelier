<?php

use Dam\Atelier\Model\Funcoes\Paginacao;

include __DIR__ . '/../Componentes/inicio-html.php';
include __DIR__ . '/../Componentes/navbar.php';

$paginacao = new Paginacao($funcoes);
?>

    <div class="d-flex align-items-center align-items-stretch">
        <form action="/funcoes" method="post" class="d-flex">
            <input type="text"
                   name="busca"
                   id="busca"
                   placeholder="Função"
                   autofocus
                   style="height: 82%">
            <button class="btn btn-info text-light mb-2 ms-2" type="submit">
                <i class="bi bi-search"></i> Buscar
            </button>
        </form>
        <div class="flex-fill">
            <?php include __DIR__ . '/../Componentes/mensagens.php';?>
        </div>
        <div>
            <a type="button" href="/nova-funcao" class="btn btn-info text-light mb-2">
                <i class="bi bi-plus-circle-fill primary bi-align-middle"> Novo</i>
            </a>
        </div>
    </div>
    <div class="list-group">
        <table class="table table-primary table-striped bg-light">
            <thead style="background-color: black;">
            <tr>
                <th scope="col" style="width: 4%">#</th>
                <th scope="col">Função</th>
                <th colspan="2" style="width: 8%" scope="col" class="text-center">Ações</th>
            </tr>
            </thead>
            <tbody class="table table-striped">
            <?php foreach ($funcoes as $funcao): ?>
                <tr>
                    <th scope="row"><?= $funcao->getId(); ?></th>
                    <td><?= $funcao->getDescricao(); ?></td>
                    <td class="text-center px-0">
                        <button style="border: none; padding: 0;">
                            <a title="Editar" href="/alterar-funcao?id=<?= $funcao->getId(); ?>">
                                <i class="bi bi-pencil-square" style="color: black;"></i>
                            </a>
                        </button>
                    </td>
                    <td class="text-center px-0">
                        <button title="Excluir?"
                                onclick="excluir('funcao',
                                    '<?= $funcao->getDescricao() ?>',
                                    '<?= $funcao->getId(); ?>')"
                                style="border: none; padding: 0;">
                            <i class="bi bi-trash3-fill" style="color: black;"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <td colspan="6" class="">
                <div class="d-inline-block mx-2">
                    <strong>Total nesta página: </strong>
                    <?= number_format($paginacao->getTotalItensPagina(),0, ',', '.'); ?>
                    registros
                </div>
                <span><span>
                    <div class="d-inline-flex float-end mx-2">
                        <strong>Total: </strong>
                        <?= number_format($paginacao->getTotalItens(),0, ',', '.'); ?>
                        registros
                    </div>
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

<?php include __DIR__ . '/../Componentes/fim-html.php';
