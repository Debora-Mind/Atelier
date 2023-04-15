<?php
include __DIR__ . '/../Componentes/inicio-html.php';
include __DIR__ . '/../Componentes/navbar.php';
?>
<div class="container-xl mt-5 bg-dark w-100 py-3 float-start">
    <div class="float-start w-50 d-inline pe-2">
        <form action="/dar-saida" class="form-control" method="post">
            <div class="text-center">
                <div class="my-3 display-5">Dar saída:</div>
                <input type="text"
                       name="codigo-barras-saida"
                       id="codigo-barras-saida"
                       placeholder="Código de barras"
                       autofocus
                       class="my-3 input-group-lg">
                <div class="m-3">
                    <button class="btn btn-lg btn-primary">Confirmar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="w-50 float-end d-inline form-control ps-2 pb-3">
        <div class="my-3 display-6 ms-5">Última saída:</div>
        <div>
            <span class="h5 ms-5">Modelo:</span>
            <span><?= $_SESSION['modelo'] ?? ''?></span>
        </div>
        <div>
            <span class="h5 ms-5">Quantidade:</span>
            <span><?= $_SESSION['quantidade'] ?? ''?></span>
        </div>
        <div>
            <span class="h5 ms-5">Semana:</span>
            <span><?= $_SESSION['semana'] ?? ''?></span>
        </div>
        <div>
            <span class="h5 ms-5">Entrada:</span>
            <span><?= $_SESSION['entrada'] ?? ''?></span>
        </div>
        <div class="mb-1">
            <span class="h5 ms-5">Saída:</span>
            <span><?= $_SESSION['saida'] ?? ''?></span>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../Componentes/fim-html.php';
