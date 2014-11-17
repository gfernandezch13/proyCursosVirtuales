<?php
    require_once '../datos/acceso-datos.php';
    
    class GrupoAcademico extends Conexion {
        private $codigoGrupo;
        private $fechaInicio;
        private $fechaFin;
        private $numeroVacantes;
        private $descripcion;
        private $codigoCurso;
        private $dniDocente;
        
        public function getCodigoGrupo() {
            return $this->codigoGrupo;
        }

        public function getFechaInicio() {
            return $this->fechaInicio;
        }

        public function getFechaFin() {
            return $this->fechaFin;
        }

        public function getNumeroVacantes() {
            return $this->numeroVacantes;
        }

        public function getDescripcion() {
            return $this->descripcion;
        }

        public function getCodigoCurso() {
            return $this->codigoCurso;
        }

        public function getDniDocente() {
            return $this->dniDocente;
        }

        public function setCodigoGrupo($codigoGrupo) {
            $this->codigoGrupo = $codigoGrupo;
        }

        public function setFechaInicio($fechaInicio) {
            $this->fechaInicio = $fechaInicio;
        }

        public function setFechaFin($fechaFin) {
            $this->fechaFin = $fechaFin;
        }

        public function setNumeroVacantes($numeroVacantes) {
            $this->numeroVacantes = $numeroVacantes;
        }

        public function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }

        public function setCodigoCurso($codigoCurso) {
            $this->codigoCurso = $codigoCurso;
        }

        public function setDniDocente($dniDocente) {
            $this->dniDocente = $dniDocente;
        }
        
        public function listar(){
            $sql = "
                select 
                    g.codigo_grupo, 
                    g.fecha_inicio, 
                    g.fecha_fin, 
                    g.numero_vacantes, 
                    g.descripcion, 
                    c.nombre as curso, 
                    d.apellidos, 
                    d.nombres 
            from 
                    grupo_academico g 
                    inner join curso c on ( g.codigo_curso = c.codigo ) 
                    inner join docente d on ( g.dni_docente = d.dni )
                ";
            $resultado = $this->consultar($sql);
            
            $tabla = '
                <table id="tabla-listado" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>CÓDIGO</th>
                            <th>F.INICIO</th>
                            <th>F.FIN</th>
                            <th>N.VAC.</th>
                            <th>GRUPO</th>
                            <th>CURSO</th>
                            <th>DOCENTE</th>
                            <th>OPCIONES</th>
                        </tr>
                    </thead>
                    
                    <tfoot>
                        <tr>
                            <th>CÓDIGO</th>
                            <th>F.INICIO</th>
                            <th>F.FIN</th>
                            <th>N.VAC.</th>
                            <th>GRUPO</th>
                            <th>CURSO</th>
                            <th>DOCENTE</th>
                            <th>OPCIONES</th>
                        </tr>
                    </tfoot>
                    
                    <tbody>
                ';
            
            while ($registro = $resultado->fetch()){
                $tabla .= '
                        <tr>
                            <td>'.$registro["codigo_grupo"].'</td>
                            <td>'.$registro["fecha_inicio"].'</td>
                            <td>'.$registro["fecha_fin"].'</td>
                            <td>'.$registro["numero_vacantes"].'</td>
                            <td>'.$registro["descripcion"].'</td>
                            <td>'.$registro["curso"].'</td>
                            <td>'.stripslashes($registro["apellidos"]).' '.stripslashes($registro["nombres"]).'</td>
                            <td align="center">
                                <a href="javascript:void();" onclick="editarGrupo('.$registro["codigo_grupo"].');" data-toggle="modal" data-target="#myModal"> <img src="../util/imagenes/edit.png"> </a>
                                <a href="javascript:void();" onclick="eliminarGrupo('.$registro["codigo_grupo"].');"> <img src="../util/imagenes/delete.png"> </a>
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
        
        public function llenarComboGrupoAcademico($codigo_curso) {
            $sql = "select codigo_grupo, fecha_inicio, fecha_fin, descripcion from grupo_academico where codigo_curso = ".$codigo_curso." and numero_vacantes > 0";
            $resultado = $this->consultar($sql);
            $html = '<option value="" style="display: none">Seleccione grupo</option>';
            while($registro = $resultado->fetch()){
                $html .= '<option value="'.$registro["codigo_grupo"].'">'.$registro["descripcion"].' - '.$registro["fecha_inicio"].'</option>';
            }
            
            return $html;
        }
        
        public function obtenerVacantesDisponibles($codigo_grupo) {
            $sql = "select numero_vacantes from grupo_academico where codigo_grupo = ".$codigo_grupo;
            $resultado = $this->consultar($sql)->fetch();
            
            return $resultado["numero_vacantes"];
        }
        


        
    }
?>