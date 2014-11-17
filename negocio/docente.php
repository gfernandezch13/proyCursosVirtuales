<?php
    require_once '../datos/acceso-datos.php';
    
    class Docente extends Conexion {
        
        public function obtenerDocentes() {
            $sql = "select * from docente order by apellidos, nombres";
            $resultado = $this->consultar($sql);
            return $resultado; //retorna un array con los resultados de la consulta sql
        }
        
        public function llenarComboDocente(){
            $resultado = $this->obtenerDocentes();
            $html = '<option value="" style="display: none">Seleccione docente</option>';
            while($registro = $resultado->fetch()){
                $html .= '
                        <option value="'.$registro["dni"].'">'.stripslashes($registro["apellidos"])." ".stripslashes($registro["nombres"]).'</option>
                    ';
            }
            return $html;
        }
        
        
        
    }
?>