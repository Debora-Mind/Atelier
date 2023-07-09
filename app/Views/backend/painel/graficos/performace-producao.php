<?php setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' )?>
<head>
    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawTrendlines);

        function drawTrendlines() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', '<?= date('M') ?>');
            data.addColumn('number', 'Meta');
            data.addColumn('number', 'Resultado');

            data.addRows([
                <?php $i = 0; foreach ($datas as $data):?>
                [
                    <?= substr($data['data'], -2) ?>,
                    <?= $metas->selectSum('meta')
                        ->where('data', $data['data'])
                        ->like('data', '-' . date('m') . '-')
                        ->getMetas()[0]['meta']?>,
                    <?= $taloes->selectSum('quantidade')
                        ->like('data_saida', $data['data'])
                        ->getTaloes()[0]['quantidade'] ?? 0 ?>] ,
                <?php endforeach; ?>
            ]);

            var options = {

                title: 'Performace de Produção',
                backgroundColor: {
                    fill: 'none'
                },
                chartArea: {
                    backgroundColor: 'none',
                },
                colors:['#f31f1f','#1e6da1'],

                trendlines: {
                    0: {lineWidth: 5, opacity: .3, tooltip: false},
                    1: {lineWidth: 5, opacity: .3, tooltip: false}
                },
                hAxis: {
                    title: '<?= ucfirst(strftime('%B'));?>',
                    format: '',
                    gridLines: {
                        multiple: 1
                    }
                },
                vAxis: {
                    title: 'Quantidade',
                    format: '',
                    gridLines: {
                        multiple: 100,

                    }
                }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);

            // var options = {
            //     chart: {
            //         title: 'Performace de Produção',
            //         subtitle: 'Metas e Resultados'
            //     },
            //     backgroundColor: {
            //         fill: 'none'
            //     },
            //     chartArea: {
            //         backgroundColor: 'none'
            //     },
            //     colors:['#f31f1f','#1e6da1'],
            //     vAxis: {
            //         format: '',
            //         gridLines: {
            //             multiple: 1
            //         }
            //     },
            //     hAxis: {
            //         format: '',
            //         gridLines: {
            //             multiple: 1
            //         }
            //     },
            // };
            //
            // var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
            //
            // chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
</head>


