<?php
    session_name("cursosvirtuales");
    session_start();
    
    if (! isset($_SESSION["nombre"])){
        header("location:index.php");
    }
?>

<?php
    require_once '../negocio/curso.php';
    
    $codigo = $_POST["codigo"];
    
    $objCurso = new Curso();
    echo json_encode($objCurso->buscarCurso($codigo)); //Devolver los resultados en formato JSON
    
?>