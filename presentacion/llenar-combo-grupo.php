<?php
    session_name("cursosvirtuales");
    session_start();
    
    if (! isset($_SESSION["nombre"])){
        header("location:index.php");
    }
    
    
    $codigo_curso = $_POST["codigo_curso"];
    
    require_once '../negocio/grupo-academico.php';
    $objGrupo = new GrupoAcademico();
    
    echo $objGrupo->llenarComboGrupoAcademico($codigo_curso);
    
?>

