<?php
include __DIR__ . '/../Componentes/inicio-html.php';
include __DIR__ . '/../Componentes/navbar.php';
?>

    <div class="d-flex align-items-center align-items-stretch">
        <form action="/usuarios" method="post" class="d-flex">
            <input type="text"
                   name="busca"
                   id="busca"
                   placeholder="Digite o modelo ou código de barras"
                   autofocus
                   style="height: 82%">
            <button class="btn btn-primary mb-2 ms-2" type="submit">
                <i class="bi bi-search"></i> Buscar
            </button>
            <select type="button" name="filtro-funcao" id="filtro-funcao"
                    class="btn btn-toolbar btn-primary ms-2 mb-2">
                <option value="1" selected class="dropdown-item bg-white text-start">
                    Todos
                </option>
                <?php foreach ($funcoes as $funcao) :?>

                <option value="<?= $funcao->getId() ?>" class="dropdown-item bg-white text-start">
                    <?= $funcao->getDescricao(); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </form>
        <div class="flex-fill">
            <?php include __DIR__ . '/../Componentes/mensagens.php';?>
        </div>
        <div>
            <a type="button" href="/novo-usuario" class="btn btn-primary mb-2">
                <i class="bi bi-plus-circle-fill primary bi-align-middle"> Novo</i>
            </a>
        </div>
    </div>
    <div class="list-group">
        <table class="table table-dark table-striped">
            <thead style="background-color: black;">
            <tr>
                <th scope="col" style="width: 4%">#</th>
                <th scope="col" style="width: 15%">Usuario</th>
                <th scope="col">Funcionario</th>
                <th colspan="3" style="width: 10%" scope="col" class="text-center">Ações</th>
            </tr>
            </thead>
            <tbody class="table table-striped">
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <th scope="row"><?= $usuario->getId(); ?></th>
                    <td><?= $usuario->getUsuario(); ?></td>
                    <td><?= $usuario->getIdFuncionario(); ?></td>
                    <td class="text-center px-0">
                        <a title="Ficha"
                                href="/ficha?id=<?= $usuario->getId(); ?>"
                                style="border: none; padding: 0;">
                            <i class="bi bi-search" style="color: black"></i>
                        </a>
                    </td>
                    <td class="text-center px-0">
                        <a title="Editar" href="/alterar-modelo?id=<?= $usuario->getId(); ?>">
                            <i class="bi bi-pencil-square" style="color: black;"></i>
                        </a>
                    </td>
                    <td class="text-center px-0">
                        <button title="Excluir?"
                                onclick="excluir('<?= $usuario->getUsuario() ?>', '<?= $usuario->getId(); ?>')"
                                style="border: none; padding: 0;">
                            <i class="bi bi-trash3-fill" style="color: black;"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php include __DIR__ . '/../Componentes/fim-html.php';
