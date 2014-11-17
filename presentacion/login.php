<?php
    require_once '../negocio/sesion.php';
    
    $correo = $_POST["txtcorreo"];
    $clave  = $_POST["txtclave"];
    $recordar  = $_POST["chkrecordar"];
    
    $objSesion = new Sesion();
    
    if ($objSesion->iniciarSesion($correo, $clave, $recordar) == TRUE){
        header("location:menu-principal.php");
    }else{
        echo "Ocurrio un error al iniciar sesión. Revise los datos del usuario";
    }
    
    
?>