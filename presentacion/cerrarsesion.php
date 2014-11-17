<?php
    session_name("cursosvirtuales");
    session_start();
    
    unset($_SESSION["correo"]);
    unset($_SESSION["nombre"]);
    
    session_destroy();
    
    header("location:index.php");
    
?>