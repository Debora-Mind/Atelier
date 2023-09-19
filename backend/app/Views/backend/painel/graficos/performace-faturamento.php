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