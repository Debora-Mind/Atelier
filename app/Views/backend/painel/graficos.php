<!-- Begin Page Content -->
<div class="container-fluid py-3">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div class="row px-3 mt-3">
        <?php include __DIR__ . '/graficos/performace-producao.php' ?>
        <div class="col-6 w-auto h-50" id="columnchart_material"></div>

        <?php include __DIR__ . '/graficos/meta-atingida.php' ?>
        <div class="col-6 w-auto h-50" id="donutchart"></div>
    </div>

    <div class="row mt-5">
        <?php include __DIR__ . '/graficos/performace-faturamento.php' ?>
        <div class="col-12 w-auto h-50" id="curve_chart"></div>
    </div>
</div>
<!-- /.container-fluid -->