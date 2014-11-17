/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 17/11/2014
 * Time: 7:43
 */

<?php
    require_once '../negocio/matricula.php';

    $objMatricula = new Matricula();
    $resultado = $objMatricula->matriculasPorCurso();

    //print_r($resultado);  -> para ver si funciona

    $grafico = "['Curso', 'Cantidad de Matriculas']";
    for ($i = 1; $i <= count($resultado); $i++)
    {
        $grafico .= ", ['".$resultado[$i]["curso"]."',     ".$resultado[$i]["nro_mat"]."]";
    }

    //echo $grafico;  -> para ver si funciona
?>

<html>
  <head>
    <meta charset="utf-8" />
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

          var data = google.visualization.arrayToDataTable([
                <?php
                    echo $grafico;
                ?>
              ]);

          var options = {
              title: 'Matriculas por Curso',
              is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;}"></div>
  </body>
</html>