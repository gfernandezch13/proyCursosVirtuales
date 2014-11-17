<?php
    session_name("cursosvirtuales");
    session_start();
    
    if (! isset($_SESSION["nombre"])){
        header("location:index.php");
    }
?>


<?php
    $fecha                = $_POST["fecha"];
    $codigo_estudiante    = $_POST["cod_est"];
    $codigo_grupo         = $_POST["cod_gru"];
    $codigo_usuario       = $_SESSION["codigo_usuario"];
    
    require_once '../negocio/matricula.php';
    $objMat = new Matricula();
    
    $objMat->setFecha($fecha);
    $objMat->setCodigoEstudiante($codigo_estudiante);
    $objMat->setCodigoGrupo($codigo_grupo);
    $objMat->setCodigoUsuario($codigo_usuario);
    
    if ($objMat->agregar()){
        echo "ok";
    }
?>