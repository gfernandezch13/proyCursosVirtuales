<?php
    session_name("cursosvirtuales");
    session_start();
    
    if (! isset($_SESSION["nombre"])){
        header("location:index.php");
    }
?>

<?php
    $nombres     = $_POST["txtnombrecurso"];
    $precio     = $_POST["txtprecio"];
    $codigo     = $_POST["txtcodigo"]; //viene de un campo oculto
    
    
    require_once '../negocio/curso.php';
    $objCurso = new Curso();
    
    $objCurso->setNombre($nombres);
    $objCurso->setPrecio($precio);
    
    if ($codigo == "0"){ //AGREGAR UN NUEVO CURSO
        if ($objCurso->agregar()==TRUE){
            require_once '../util/funciones/funciones.php';
            Funciones::mensaje("El curso se ha registrado correctamente", "s", "cursos.php", 3);
        }
    }else{ //EDITAR UN CURSO EXISTENTE
        if ($objCurso->editar($codigo)==TRUE){
            //header("location:cursos.php");
            require_once '../util/funciones/funciones.php';
            Funciones::mensaje("El curso ha sido modificado correctamente", "s", "cursos.php", 3);
        }
    }
    
    
?>