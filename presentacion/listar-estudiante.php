<?php
    session_name("cursosvirtuales");
    session_start();
    
    if (! isset($_SESSION["nombre"])){
        header("location:index.php");
    }
?>

<?php
    require_once '../negocio/estudiante.php';
    $objEstudiante = new Estudiante();
    $objEstudiante->listar();
?>