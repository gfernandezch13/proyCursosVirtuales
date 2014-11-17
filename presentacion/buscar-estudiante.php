<?php
    session_name("cursosvirtuales");
    session_start();
    
    if (! isset($_SESSION["nombre"])){
        header("location:index.php");
    }
?>

<?php
    require_once '../negocio/estudiante.php';
    $codigo = $_POST["codigo"];
    $objEstudiante = new Estudiante();
    echo json_encode($objEstudiante->buscar2($codigo)); //Devolver los resultados en formato JSON
?>