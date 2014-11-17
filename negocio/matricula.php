<?php

require_once '../datos/acceso-datos.php';

class Matricula extends Conexion {
    private $numero;
    private $fecha;
    private $codigoEstudiante;
    private $codigoGrupo;
    private $codigoUsuario;
    
    public function getNumero() {
        return $this->numero;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getCodigoEstudiante() {
        return $this->codigoEstudiante;
    }

    public function getCodigoGrupo() {
        return $this->codigoGrupo;
    }

    public function getCodigoUsuario() {
        return $this->codigoUsuario;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setCodigoEstudiante($codigoEstudiante) {
        $this->codigoEstudiante = $codigoEstudiante;
    }

    public function setCodigoGrupo($codigoGrupo) {
        $this->codigoGrupo = $codigoGrupo;
    }

    public function setCodigoUsuario($codigoUsuario) {
        $this->codigoUsuario = $codigoUsuario;
    }
    
    public function agregar(){
        try {
            
            $this->dblink->beginTransaction(); //inicia la transacción
            
            $sql = "insert into matricula(fecha, codigo_estudiante, codigo_grupo, codigo_usuario)"
                . "values(:fecha,:ce,:cg,:cu)";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":fecha", $this->getFecha());
            $sentencia->bindParam(":ce", $this->getCodigoEstudiante());
            $sentencia->bindParam(":cg", $this->getCodigoGrupo());
            $sentencia->bindParam(":cu", $this->getCodigoUsuario());
            $sentencia->execute();
            

            $sql = "update grupo_academico "
                    . "set numero_vacantes = numero_vacantes - 1 "
                    . "where codigo_grupo = :cod_gru";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":cod_gru", $this->getCodigoGrupo());
            $sentencia->execute();

            $this->dblink->commit(); //Confirmar toda la transacción
            
        } catch (Exception $exc) {
            echo 'Error: '.$exc->getMessage();
            $this->dblink->rollBack(); //Extornar toda la transacción
            return FALSE;
        }

        return TRUE;
        
    }
    
       
}
