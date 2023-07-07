<!-- Begin Page Content -->
<div class="container-fluid py-3">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div class="row">
    <head>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Anos', 'Meta', 'Resultado'],
                    ['2014', 1000, 400],
                    ['2015', 1170, 460],
                    ['2016', 660, 1120],
                    ['2017', 1030, 540]
                ]);

                var options = {
                    chart: {
                        title: 'Performace de Produção',
                        subtitle: 'Metas e Resultados'
                    },
                    backgroundColor: {
                        fill: 'none'
                    },
                    chartArea: {
                        backgroundColor: 'none'
                    }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        </script>
    </head>

    <div class="col-6 w-auto h-50" id="columnchart_material"></div>


<!--    -------------------------------->
        <head>
            <script type="text/javascript">
                google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Legenda', 'Porcentagem'],
                        ['Atingida',     10],
                        ['Não atingida',      1]
                    ]);

                    var options = {
                        title: 'Meta Atingida',
                        pieHole: 0.4,
                        backgroundColor: {
                            fill: 'none'
                        },
                        chartArea: {
                            backgroundColor: 'none',
                            bottom:0,
                            width:'80%',
                            height:'90%'
                        }
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                    chart.draw(data, options);
                }
            </script>
        </head>
        <div class="col-6 w-auto h-50" id="donutchart"></div>




    </div>
<!--        ------------------------------->
    <div class="row mt-5">

        <head>
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Anos', 'Resultado', 'Meta', 'Lucro'],
                        ['2004',  1000,      400, 100],
                        ['2005',  1170,      460, 150],
                        ['2006',  660,       1120, 80],
                        ['2007',  1030,      540, 200]
                    ]);

                    var options = {
                        title: 'Performace de Faturamento',
                        curveType: 'function',
                        legend: { position: 'bottom' },
                        backgroundColor: {
                            fill: 'none'
                        },
                        chartArea: {
                            backgroundColor: 'none'
                        }
                    };

                    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                    chart.draw(data, options);
                }
            </script>
        </head>

        <div class="col-12 w-auto h-50" id="curve_chart"></div>
    </div>
</div>
<!-- /.container-fluid -->