<?php
    session_name("cursosvirtuales");
    session_start();
    
    if (! isset($_SESSION["nombre"])){
        header("location:index.php");
    }
?>

<?php
    require_once '../negocio/curso.php';
    $objCurso = new Curso();
    echo $objCurso->llenarComboCurso();
?>