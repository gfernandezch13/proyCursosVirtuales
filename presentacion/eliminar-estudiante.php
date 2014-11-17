<?php
    session_name("cursosvirtuales");
    session_start();
    
    if (! isset($_SESSION["nombre"])){
        header("location:index.php");
    }
?>

<?php
    $codigo = $_POST["codigo"];
    
    require_once '../negocio/estudiante.php';
    $objEstudiante = new Estudiante();
    
    if ($objEstudiante->eliminar($codigo)==TRUE){
        echo "1";
    }else{
        echo "0";
    }
    
?>