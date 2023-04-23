<?php

use Dam\Atelier\Model\Funcoes\Paginacao;

include __DIR__ . '/../Componentes/inicio-html.php';
include __DIR__ . '/../Componentes/navbar.php';

$paginacao = new Paginacao($usuarios);
$paginado = $paginacao->paginate();
?>

    <div class="d-flex align-items-center align-items-stretch">
        <form action="/usuarios" method="post" class="d-flex">
            <input type="text"
                   name="busca"
                   id="busca"
                   placeholder="Usuário"
                   autofocus
                   style="height: 82%">
            <button class="btn btn-primary text-light mb-2 ms-2" type="submit">
                <i class="bi bi-search"></i> Buscar
            </button>
        </form>
        <div class="flex-fill">
            <?php include __DIR__ . '/../Componentes/mensagens.php';?>
        </div>
        <div>
            <a type="button" href="/novo-usuario" class="btn btn-primary text-light mb-2">
                <i class="bi bi-plus-circle-fill primary bi-align-middle"> Novo</i>
            </a>
        </div>
    </div>
    <div class="list-group">
        <table class="table table-primary table-striped bg-light">
            <thead style="background-color: black;">
                <tr>
                    <th scope="col" style="width: 4%">#</th>
                    <th scope="col" style="width: 15%">Usuario</th>
                    <th scope="col">Funcionario</th>
                    <th colspan="3" style="width: 8%" scope="col" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody class="table table-striped">
            <?php foreach ($paginado['itens'] as $usuario): ?>
                <tr>
                    <th scope="row"><?= $usuario->getId(); ?></th>
                    <td><?= $usuario->getUsuario(); ?></td>
                    <td><?= $usuario->getFuncionario() == null ? '' : $usuario->getFuncionario()->getNome() ?></td>
                    <td class="text-right px-0">
                        <button style="border: none; padding: 0;">
                            <a title="Permissões" href="/alterar-permissoes?id=<?= $usuario->getId(); ?>">
                                <i class="bi bi-list-check" style="color: black;"></i>
                            </a>
                        </button>
                    </td>
                    <td class="text-right px-0">
                        <button style="border: none; padding: 0;">
                            <a title="Editar" href="/alterar-usuario?id=<?= $usuario->getId(); ?>">
                                <i class="bi bi-pencil-square" style="color: black;"></i>
                            </a>
                        </button>
                    </td>
                    <td class="text-right px-0">
                        <button title="Excluir?"
                                onclick="excluir('usuario',
                                    '<?= $usuario->getUsuario() ?>',
                                    '<?= $usuario->getId(); ?>')"
                                style="border: none; padding: 0;">
                            <i class="bi bi-trash3-fill" style="color: black;"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
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
                           href="?pagina=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($paginacao->paginate()['paginaAtual'] < $paginacao->paginate()['totalPaginas']): ?>
                    <li class="page-item"><a class="page-link text-primary border-secondary" href="?pagina=<?= ($paginacao->paginate()['paginaAtual']+1); ?>">Próximo</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

<?php include __DIR__ . '/../Componentes/fim-html.php';
