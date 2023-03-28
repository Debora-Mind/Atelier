<?php include __DIR__ . '/../Componentes/inicio-html.php'; ?>
<?php include __DIR__ . '/../Componentes/navbar.php'; ?>

    <a href="/novo-modelo" class="btn btn-primary mb-2">
        Novo
    </a>

    <ul class="list-group">
        <?php foreach ($modelos as $modelo): ?>
            <li class="list-group-item d-flex justify-content-between">
                <?= $modelo->getModelo(); ?>
                <span>
                    <a href="/alterar-curso?id=<?= $modelo->getId(); ?>" class="btn btn-info btn-sm">
                        Alterar
                    </a>
                    <a href="/excluir-curso?id=<?= $modelo->getId(); ?>" class="btn btn-danger btn-sm">
                        Excluir
                    </a>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>

<?php include __DIR__ . '/../Componentes/fim-html.php';
