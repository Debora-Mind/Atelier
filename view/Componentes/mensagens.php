<?php
    if (isset($_SESSION['mensagem'])): ?>
    <div class="d-flex align-items-center alert alert-<?= $_SESSION['tipo_mensagem']; ?> mx-2 my-0" style="height: 38px;">
        <?= $_SESSION['mensagem']; ?>
    </div>
    <?php
    unset($_SESSION['mensagem']);
    unset($_SESSION['tipo_mensagem']);
    endif;
?>