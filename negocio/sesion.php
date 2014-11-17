<?php
    require_once '../datos/acceso-datos.php';
    
    class Sesion extends Conexion{
        public function iniciarSesion($correo, $clave, $recordar){
            $sql = "select correo, clave, nombre, estado, codigo from usuario where correo = '$correo'";
            $resultado = $this->consultar($sql)->fetch();
            
            if ($resultado["clave"] == md5($clave)){
                session_name("cursosvirtuales");
                session_start();
                $_SESSION["correo"] = $correo;
                $_SESSION["nombre"] = $resultado["nombre"];
                $_SESSION["codigo_usuario"] = $resultado["codigo"];
                
                if ($recordar=="s"){
                    setcookie("correousuario", $correo);
                }else{
                    setcookie("correousuario", "");
                }
                
                return TRUE;
            }
            return FALSE;
        }
    }
?>