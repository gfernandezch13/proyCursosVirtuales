<?php
    session_name("cursosvirtuales");
    session_start();
    
    if (! isset($_SESSION["nombre"])){
        header("location:index.php");
    }
?>

<?php
    $codigo = $_POST["codigocurso"];
    
    require_once '../negocio/curso.php';
    $objCurso = new Curso();
    
    if ($objCurso->eliminar($codigo)==TRUE){
        echo "1";
    }else{
        echo "0";
    }
    
?>