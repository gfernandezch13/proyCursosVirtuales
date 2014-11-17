<?php
    session_name("cursosvirtuales");
    session_start();
    
    if (! isset($_SESSION["nombre"])){
        header("location:index.php");
    }
?>

<?php
    $valorBusqueda = $_GET["term"];
    
    if (!$valorBusqueda){
        return;
    }
    
    require_once '../negocio/estudiante.php';
    $objEst = new Estudiante();
    
    $resultado = $objEst->cargarEstudiante($valorBusqueda);
    
    $cadena_json = null;
    
    echo "[";
    
    for ($i=1;$i<=count($resultado);$i++){
        $cadena_json = array(
          "label"=>$resultado[$i]["apellidos"].' '.$resultado[$i]["nombres"],
          "value"=>array(
               "codigo"=>$resultado[$i]["codigo"],
               "nombre"=>$resultado[$i]["apellidos"].' '.$resultado[$i]["nombres"],
               "direccion"=>$resultado[$i]["direccion"],
               "telefono"=>$resultado[$i]["telefono"]
          )
        );
        
        echo json_encode($cadena_json);
        
        if ($i < count($resultado)){
            echo ',';
        }
        
    }
    
    echo "]";
    
    
?>