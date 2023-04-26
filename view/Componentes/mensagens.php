<?php if (isset($_SESSION['mensagem'])): ?>
    <div id="flash-message" class="hide d-flex alert alert-<?= $_SESSION['tipo_mensagem']; ?>">
        <?= $_SESSION['mensagem']; ?>
    </div>
    <?php unset($_SESSION['mensagem']); unset($_SESSION['tipo_mensagem']); ?>
<?php endif; ?>

