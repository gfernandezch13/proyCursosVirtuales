<?php
    require_once '../datos/acceso-datos.php';
    
    class Curso extends Conexion {
        
        private $nombre;
        private $precio;
        
        
        
        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }
        
        public function setPrecio($precio) {
            $this->precio = $precio;
        }
        
        public function getNombre() {
            return $this->nombre;
        }
        
        public function getPrecio() {
            return $this->precio;
        }
        
        public function listar(){
            $sql = "select codigo, nombre, precio from curso";
            $resultado = $this->consultar($sql);
            
            $tabla = '
                <table id="listado" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    
                    <tfoot>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                    
                    <tbody>
                ';
            
            while ($registro = $resultado->fetch()){
                $tabla .= '
                        <tr>
                            <td>'.$registro["codigo"].'</td>
                            <td>'.$registro["nombre"].'</td>
                            <td>'.$registro["precio"].'</td>
                            <td align="center">
                                <a href="javascript:void();" onclick="editarCurso('.$registro["codigo"].');" data-toggle="modal" data-target="#myModal"> <img src="../util/imagenes/edit.png"> </a>
                                <a href="javascript:void();" onclick="eliminarCurso('.$registro["codigo"].');"> <img src="../util/imagenes/delete.png"> </a>
                            </td>
                        </tr>
                    ';
            }
            
            $tabla .= '
                    </tbody>
                </table>
                ';
            
            echo $tabla;
            
        }
        
        public function agregar() {
            $sql = "insert into curso(nombre, precio) values('".$this->nombre."',".$this->precio.")";
            $resultado = $this->consultar($sql);
            
            if ($resultado != 0){
                return TRUE;
            }
            
            return FALSE;
        }
        
        public function eliminar($codigo){
            $sql = "delete from curso where codigo = ".$codigo;
            $resultado = $this->consultar($sql);
            
            if ($resultado != 0){
                return TRUE;
            }
            
            return FALSE;
        }
        
        public function editar($codigo) {
            $sql = "update curso set nombre = '".$this->nombre."', precio =".$this->precio." where codigo = ".$codigo;
            $resultado = $this->consultar($sql);
            
            if ($resultado != 0){
                return TRUE;
            }
            
            return FALSE;
        }
        
        public function buscarCurso($codigo){
            $sql = "select codigo, nombre, precio from curso where codigo=".$codigo;
            $resultado = $this->consultar($sql)->fetch();
            return $resultado; //retorna un array con los resultados de la consulta sql
        }
        
        public function obtenerCursos() {
            $sql = "select * from curso order by nombre";
            $resultado = $this->consultar($sql);
            return $resultado; //retorna un array con los resultados de la consulta sql
        }
        
        public function llenarComboCurso(){
            $resultado = $this->obtenerCursos();
            $html = '<option value="" style="display: none">Seleccione curso</option>';
            while($registro = $resultado->fetch()){
                $html .= '
                        <option value="'.$registro["codigo"].'">'.$registro["nombre"].'</option>
                    ';
            }
            return $html;
        }
        
        
        
    }
?>