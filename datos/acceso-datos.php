<?php
    class Conexion{
        
        protected $dblink;
        
        function __construct() {
            $servidor = "pgsql:host=localhost;port=5432;dbname=bdcursosvirtuales";
            $usuario = "postgres";
            $clave = "GUSTA123";
            
            $this->dblink = new PDO($servidor, $usuario, $clave);
            $this->dblink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        protected function consultar($sql){
            require_once '../util/funciones/funciones.php';
            
            $resultado = 0;
            try {
                $resultado = $this->dblink->query($sql);
            }catch (Exception $exc){
                $resultado = 0;
                //echo $exc->getMessage();
                Funciones::mensaje($exc->getMessage(), "e");
                exit();
            }
            
            return $resultado;
        }
    }
?>