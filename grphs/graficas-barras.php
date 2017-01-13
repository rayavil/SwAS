<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {

 Highcharts.chart('container', {
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Resultado del total de Auditorias'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Calificación'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });

});
		</script>
	</head>
	<body>



<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<table id="datatable">

<thead>
        <tr>
            <th></th>
            <th>Actual</th>

        </tr>
    </thead>
    <tbody>

<?php
$data = file_get_contents("http://192.168.0.11/SwAS/app/index.php/graph-all-auditorias");
$products = json_decode($data, true);


foreach ($products as $product) {
    echo " <tr><th>".$product['serv_descripcion']."</th><td>".$product['promedio']."</td></tr>";
}

?>   
    </tbody>
</table>

	</body>
</html>
