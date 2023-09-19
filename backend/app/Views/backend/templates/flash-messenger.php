<!-- Flash Messenger -->
<?php if ($msg): ?>
    <div id="flash-message" class="hide d-flex alert alert-<?= $msg['tipo'] ?>">
        <?= $msg['mensagem'] ?>
    </div>
<?php endif; ?>

<!-- Erro Messenger -->
<?php if (session()->getFlashdata('erro')): ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#erroModal').modal('show');
        });
    </script>
<?php endif; ?>

<!-- Modal de erro -->
<div class="modal fade" id="erroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Erro</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php if(session()->getFlashdata('erro')): ?>
                <div class="modal-body">
                    <?php foreach (session()->getFlashdata('erro') as $erro): ?>
                        <p><?= $erro; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif;?>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
