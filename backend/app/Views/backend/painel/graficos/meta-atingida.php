<head>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Legenda', 'Porcentagem'],
                [
                    'Atingida',
                    <?= $grafico['meta_atingida'] ?? 0 ?>
                ],
                [
                    'Faltante',
                    <?= $grafico['meta'] - $grafico['meta_atingida'] ?? 0?>
                ]
            ]);

            var options = {
                title: '<?= $grafico['titulo'] ?>',
                pieHole: 0.4,
                legend: {
                    position: 'bottom'
                },
                backgroundColor: {
                    fill: 'none'
                },
                chartArea: {
                    backgroundColor: 'none',
                    bottom:'10%',
                    width:'80%',
                    height:'80%'
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>
</head>