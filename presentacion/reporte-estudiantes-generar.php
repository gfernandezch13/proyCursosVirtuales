<?php

    require_once '../negocio/estudiante.php';
    require_once '../util/funciones/funciones.php';

    $objEstudiante = new Estudiante();

    $sexo = $_POST["cbosexo"];

    if ($sexo == "T")
    {
        $sexo = "%";
    }

    $html_reporte = $objEstudiante->reporteEstudiantes($sexo);
    $archivo_pdf = "reportes/reporte-estudiantes.pdf";

    Funciones::generaPDF($archivo_pdf, $html_reporte);

    header("location: " . $archivo_pdf);
