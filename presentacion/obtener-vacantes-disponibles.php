<?php
    session_name("cursosvirtuales");
    session_start();
    
    if (! isset($_SESSION["nombre"])){
        header("location:index.php");
    }
    
    
    $codigo_grupo = $_POST["codigo_grupo"];
    
    require_once '../negocio/grupo-academico.php';
    $objGrupo = new GrupoAcademico();
    
    echo $objGrupo->obtenerVacantesDisponibles($codigo_grupo);
    
?>