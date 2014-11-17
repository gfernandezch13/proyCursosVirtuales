<?php

    require_once '../datos/acceso-datos.php';
    
    class Estudiante extends Conexion
    {
        private $codigo;
        private $apellidos;
        private $nombres;
        private $dni;
        private $sexo;
        private $fechaNacimiento;
        private $direccion;
        private $telefono;
        private $correo;

        public function setCodigo($codigo)
        {
            $this->codigo = $codigo;
        }

        public function getCodigo()
        {
            return $this->codigo;
        }

        public function setApellidos($apellidos)
        {
            $this->apellidos = $apellidos;
        }

        public function getApellidos()
        {
            return $this->apellidos;
        }

        public function setNombres($nombres)
        {
            $this->nombres = $nombres;
        }

        public function getNombres()
        {
            return $this->nombres;
        }

        public function setDni($dni)
        {
            $this->dni = $dni;
        }

        public function getDni()
        {
            return $this->dni;
        }

        public function setSexo($sexo)
        {
            $this->sexo = $sexo;
        }

        public function getSexo()
        {
            return $this->sexo;
        }

        public function setFechaNacimiento($fechaNacimiento)
        {
            $this->fechaNacimiento = $fechaNacimiento;
        }

        public function getFechaNacimiento()
        {
            return $this->fechaNacimiento;
        }

        public function setDireccion($direccion)
        {
            $this->direccion = $direccion;
        }

        public function getDireccion()
        {
            return $this->direccion;
        }

        public function setTelefono($telefono)
        {
            $this->telefono = $telefono;
        }

        public function getTelefono()
        {
            return $this->telefono;
        }

        public function setCorreo($correo)
        {
            $this->correo = $correo;
        }

        public function getCorreo()
        {
            return $this->correo;
        }

        public function listar()
        {
            $sql = "select codigo, apellidos, nombres, fecha_nacimiento, direccion, telefono from estudiante";
            $resultado = $this->consultar($sql);

            $tabla = '
                <table id="tabla-listado" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Apellidos y Nombres</th>
                            <th>Fecha Nacimiento</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    
                    <tfoot>
                        <tr>
                            <th>Código</th>
                            <th>Apellidos y Nombres</th>
                            <th>Fecha Nacimiento</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                    
                    <tbody>
                ';

            while ($registro = $resultado->fetch()) {
                $tabla .= '
                        <tr>
                            <td>' . $registro["codigo"] . '</td>
                            <td>' . stripslashes($registro["apellidos"]) . ' ' . stripslashes($registro["nombres"]) . '</td>
                            <td>' . $registro["fecha_nacimiento"] . '</td>
                            <td>' . $registro["direccion"] . '</td>
                            <td>' . $registro["telefono"] . '</td>
                            <td align="center">
                                <a href="javascript:void();" onclick="editarEstudiante(' . $registro["codigo"] . ');" data-toggle="modal" data-target="#myModal"> <img src="../util/imagenes/edit.png"> </a>
                                <a href="javascript:void();" onclick="eliminarEstudiante(' . $registro["codigo"] . ');"> <img src="../util/imagenes/delete.png"> </a>
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

        public function agregar()
        {
            $sql = "insert into estudiante(apellidos, nombres, dni, sexo, fecha_nacimiento, direccion, telefono, correo)"
                . "values('$this->apellidos', '$this->nombres', '$this->dni', '$this->sexo', '$this->fechaNacimiento','$this->direccion', '$this->telefono', '$this->correo')";

            $resultado = $this->consultar($sql);

            if ($resultado != 0) {
                return TRUE;
            }
            return FALSE;
        }

        public function agregar2()
        {
            $sql = "insert into estudiante(apellidos, nombres, dni, sexo, fecha_nacimiento, direccion, telefono, correo)"
                . "values(:ape,:nom,:dni,:sexo,:fecnac,:dir,:tel,:cor)";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":ape", $this->apellidos);
            $sentencia->bindParam(":nom", $this->nombres);
            $sentencia->bindParam(":dni", $this->dni);
            $sentencia->bindParam(":sexo", $this->sexo);
            $sentencia->bindParam(":fecnac", $this->fechaNacimiento);
            $sentencia->bindParam(":dir", $this->direccion);
            $sentencia->bindParam(":tel", $this->telefono);
            $sentencia->bindParam(":cor", $this->correo);

            $respuesta = $sentencia->execute();

            if ($respuesta == 1) { //exito en la ejecución de la sentencia sql
                return TRUE;
            }

            return FALSE;

        }

        public function editar()
        {
            $sql = "update estudiante set apellidos = :ape, nombres = :nom, dni = :dni, sexo = :sexo, fecha_nacimiento = :fecnac, direccion = :dir, telefono = :tel, correo = :cor where codigo=:cod";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":cod", $this->codigo);
            $sentencia->bindParam(":ape", $this->apellidos);
            $sentencia->bindParam(":nom", $this->nombres);
            $sentencia->bindParam(":dni", $this->dni);
            $sentencia->bindParam(":sexo", $this->sexo);
            $sentencia->bindParam(":fecnac", $this->fechaNacimiento);
            $sentencia->bindParam(":dir", $this->direccion);
            $sentencia->bindParam(":tel", $this->telefono);
            $sentencia->bindParam(":cor", $this->correo);


            $respuesta = $sentencia->execute();

            if ($respuesta == 1) { //exito en la ejecución de la sentencia sql
                return TRUE;
            }

            return FALSE;

        }

        public function eliminar($codigo)
        {
            $sql = "delete from estudiante where codigo=:cod";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":cod", $codigo);


            $respuesta = $sentencia->execute();

            if ($respuesta == 1) { //exito en la ejecución de la sentencia sql
                return TRUE;
            }

            return FALSE;

        }

        function buscar($codigo)
        {
            $sql = "select * from estudiante where codigo = " . $codigo;
            $resultado = $this->consultar($sql)->fetch();
            return $resultado;
        }

        function buscar2($codigo)
        {
            $sql = "select * from estudiante where codigo = " . $codigo;
            $resultado = $this->consultar($sql)->fetch();

            $retorno = array(
                "codigo" => $resultado["codigo"],
                "apellidos" => stripslashes($resultado["apellidos"]),
                "nombres" => stripslashes($resultado["nombres"]),
                "dni" => $resultado["dni"],
                "sexo" => $resultado["sexo"],
                "fecha_nacimiento" => $resultado["fecha_nacimiento"],
                "direccion" => $resultado["direccion"],
                "telefono" => $resultado["telefono"],
                "correo" => $resultado["correo"]
            );
            return $retorno;
        }

        public function cargarEstudiante($valor)
        {
            $sql = "select codigo, apellidos, nombres, direccion, telefono from estudiante where lower(apellidos || nombres) like '%" . strtolower($valor) . "%' order by apellidos, nombres";
            $resultado = $this->consultar($sql);

            $i = 0;
            $retorno = null;
            while ($registro = $resultado->fetch()) {
                $i++;
                $retorno[$i]["codigo"] = $registro["codigo"];
                $retorno[$i]["apellidos"] = stripslashes($registro["apellidos"]);
                $retorno[$i]["nombres"] = stripslashes($registro["nombres"]);
                $retorno[$i]["direccion"] = $registro["direccion"];
                $retorno[$i]["telefono"] = $registro["telefono"];
            }
            return $retorno;

        }

        public function cargarEstudiante2($valor)
        {
            $sql = "select codigo, apellidos, nombres, direccion from estudiante where lower(apellidos || nombres) like :valor";

            $valorBusqueda = "%" . strtolower($valor) . "%";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":valor", $valorBusqueda);
            $sentencia->execute();

            $i = 0;
            $retorno = null;
            while ($registro = $sentencia->fetchObject()) {
                $i++;
                $retorno[$i]["codigo"] = $registro->codigo;
                $retorno[$i]["apellidos"] = stripslashes($registro->apellidos);
                $retorno[$i]["nombres"] = stripslashes($registro->nombres);
                $retorno[$i]["direccion"] = $registro->direccion;
            }
            return $retorno;

        }

        function reporteEstudiantes($sexo)
        {
            $sql = "select codigo, apellidos, nombres, telefono, correo " . "from estudiante where sexo like '%$sexo%'";
            $resultado = $this->consultar($sql);

            $html = '
                        <html>
                            <head>
                                <link rel="stylesheet" href="css/reporte.css"/>
                            </head>
                            <body>
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td colspan="4" align="center class="titulo-reporte">REPORTE DE ESTUDIANTES</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="center">&nbsp;</td>
                                    </tr>
                                    <tr class="cabecera-reporte ">
                                        <td class="cabecera-reporte-lineas">CODIGO</td>
                                        <td class="cabecera-reporte-lineas">APELLIDOS Y NOMBRES</td>
                                        <td class="cabecera-reporte-lineas">TELEFONO</td>
                                        <td class="cabecera-reporte-lineas">CORREO</Td>
                                    </tr>
                    ';

            while ($registro = $resultado->fetchObject()) {
                $html .= '
                                        <tr>
                                            <td class="cuerpo-reporte">' . $registro->codigo . '</td>
                                            <td class="cuerpo-reporte">' . stripcslashes($registro->apellidos) . " " . stripcslashes($registro->nombres) . '</td>
                                            <td class="cuerpo-reporte">' . $registro->telefono . '</td>
                                            <td class="cuerpo-reporte">' . $registro->correo . '</td>
                                        </tr>
                                    ';
            }

            $html .= "</table>";
            $html .= "</body>";
            $html .= "</html>";

            return $html;
        }
    }

?>