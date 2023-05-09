<!-- Flash Messenger -->
<?php if ($msg): ?>
    <div id="flash-message" class="hide d-flex alert alert-<?= $msg['tipo'] ?>">
        <?= $msg['mensagem'] ?>
    </div>
<?php endif; ?>
