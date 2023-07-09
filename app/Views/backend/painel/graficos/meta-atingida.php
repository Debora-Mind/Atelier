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