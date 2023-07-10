<?php setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' )?>
<head>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Legenda', 'Porcentagem'],
                [
                    'Atingida',
                    <?= $taloes->selectSum('quantidade')
                        ->like('data_saida', '-' . date('m') . '-')
                        ->getTaloes()[0]['quantidade'] ?? 0 ?>
                ],
                [
                    'Faltante',
                    <?= $metas->selectSum('meta')
                        ->like('data', '-' . date('m') . '-')
                        ->getMetas()[0]['meta'] -
                    $taloes->selectSum('quantidade')
                        ->like('data_saida', '-' . date('m') . '-')
                        ->getTaloes()[0]['quantidade'] ?? 0?>
                ]
            ]);

            var options = {
                title: '<?= 'Meta Atingida - ' . ucfirst(strftime('%B'))?>',
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