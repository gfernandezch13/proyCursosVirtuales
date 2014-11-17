<?php
    $codigo       = $_POST["codigo"];
    $apellidos    = $_POST["apellidos"];
    $nombres      = $_POST["nombres"];
    $dni          = $_POST["dni"];
    $sexo         = $_POST["sexo"];
    $fechanac     = $_POST["fechanac"];
    $direccion    = $_POST["direccion"];
    $telefono     = $_POST["telefono"];
    $correo       = $_POST["correo"];
    
    require_once '../negocio/estudiante.php';
    $objEstudiante = new Estudiante();
    
    $objEstudiante->setApellidos($apellidos);
    $objEstudiante->setNombres($nombres);
    $objEstudiante->setDni($dni);
    $objEstudiante->setSexo($sexo);
    $objEstudiante->setFechaNacimiento($fechanac);
    $objEstudiante->setDireccion($direccion);
    $objEstudiante->setTelefono($telefono);
    $objEstudiante->setCorreo($correo);
    $objEstudiante->setCodigo($codigo);
    
    if ($codigo==0){
        if ($objEstudiante->agregar2()){
            echo "ok";
        }
    }else{
        if ($objEstudiante->editar()){
            echo "ok";
        }
    }
    
    
    //echo $codigo.';'.$apellidos.';'.$nombres;
    
    
?>
