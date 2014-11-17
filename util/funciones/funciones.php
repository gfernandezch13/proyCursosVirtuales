<?php
    class Funciones {
        
        public static function mensaje($mensaje, $tipo, $archivoDestino="", $tiempo=0) {
            $estiloMensaje = "";
            
            if ($archivoDestino==""){
                $destino = "javascript:window.history.back();";
            }else{
                $destino = $archivoDestino;
            }
            
            if ($tiempo==0){
                $tiempoRefrescar = 5;
            }else{
                $tiempoRefrescar = $tiempo;
            }
            
            switch ($tipo) {
                case "s":
                    $estiloMensaje = "alert alert-success";
                    break;
                
                case "i":
                    $estiloMensaje = "alert alert-info";
                    break;
                
                case "a":
                    $estiloMensaje = "alert alert-warning";
                    break;
                
                case "e":
                    $estiloMensaje = "alert alert-danger";
                    break;

                default:
                    $estiloMensaje = "alert alert-info";
                    break;
            }
            
            $html_mensaje = '
                    <html>
                        <head>
                            <title>Mensaje del sistema</title>
                            <meta charset="utf-8">
                            <meta http-equiv="refresh" content="'.$tiempoRefrescar.';'.$destino.'">
                            <link href="../util/bs/css/bootstrap.css" rel="stylesheet">
                        </head>
                        <body>
                            <div align="center" class="'.$estiloMensaje.'">
                                '.$mensaje.'
                                <br>
                                
                                <a href="'.$destino.'">Regresar</a>
                                
                                <!--
                                    //comentado
                                    <table border="0">
                                        <tr>
                                            <td>'.$mensaje.'</td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript:window.history.back();">Regresar</a></td>
                                        </tr>
                                    </table>
                                -->
                            </div>
                        </body>
                    </html>
                ';
            
            echo $html_mensaje;
            
        }
        
        public static function menu($menu){
            
            /* validar la sesión*/
            $nombre_usuario = ucwords(strtolower($_SESSION["nombre"]));
            /* validar la sesión*/
            
            
            $menu1 = "";
            $menu2 = "";
            $menu3 = "";
            $menu4 = "";
            
            switch ($menu) {
                case 1:
                    $menu1 = "active";
                    break;
                
                case 2:
                    $menu2 = "active";
                    break;
                
                case 3:
                    $menu3 = "active";
                    break;
                
                case 4:
                    $menu4 = "active";
                    break;
                
                default:
                    $menu1 = "active";
                    break;
            }
            
            $html = '
                    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                        <div class="container">
                          <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#"><div class="label label-primary">Cursos Virtuales</div></a>
                          </div>
                          <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                              <li class="'.$menu1.'"><a href="menu-principal.php">Inicio</a></li>
                              <li class="dropdown '.$menu2.'">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Archivo<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="cursos.php">Cursos</a></li>
                                  <li><a href="estudiantes.php">Estudiantes</a></li>
                                  <li><a href="#">Docentes</a></li>
                                  <li class="divider"></li>
                                  <li><a href="grupo-academico.php">Grupos Académicos</a></li>
                                </ul>
                              </li>

                             <li class="dropdown '.$menu3.'">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Transcciones<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="matricula.php">Matricula</a></li>
                                  <li class="divider"></li>
                                  <li><a href="#">Notas</a></li>
                                </ul>
                              </li>

                              <li class="dropdown '.$menu4.'">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="reporte-estudiantes.php">Estudiantes</a></li>
                                  <li><a href="#">Cursos</a></li>
                                  <li><a href="#">Docentes</a></li>
                                  <li class="divider"></li>
                                  <li><a href="#">Matriculas</a></li>
                                  <li><a href="#">Notas</a></li>
                                  <li><a href="#">Actas</a></li>
                                </ul>
                              </li>
                            </ul>

                            <ul class="nav navbar-nav navbar-right">
                              <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> '.$nombre_usuario.' <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="cerrarsesion.php">Cerrar Sesión</a></li>
                                  <li class="divider"></li>
                                  <li><a href="#">Cambiar Contraseña</a></li>
                                </ul>
                              </li>
                            </ul>

                          </div><!--/.nav-collapse -->
                        </div>
                      </div>
                ';
            
            echo $html;
        }

        public static function generaPDF($file='', $html='', $paper='a4', $download=false) {
            require_once '../util/dompdf/dompdf_config.inc.php';

            $dompdf = new DOMPDF();
            $dompdf->set_paper($paper);
            $dompdf->load_html( utf8_decode($html));
            ini_set("memory_limit","32M");
            $dompdf->render();
            file_put_contents($file, $dompdf->output());

            if ($download){
                $dompdf->stream($file);
            }
        }
        
    }
?>