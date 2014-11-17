<?php
    session_name("cursosvirtuales");
    session_start();
    
    if (! isset($_SESSION["nombre"])){
        header("location:index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cursos virtuales, cursos de educación continua">
    <meta name="author" content="Huider Mera">
    <link rel="icon" href="../util/imagenes/logo.ico">

    <title>Cursos Virtuales</title>

    <!-- Bootstrap core CSS -->
    <link href="../util/bs/css/bootstrap.css" rel="stylesheet">
    <link href="../util/bs/css/dataTables.bootstrap.css" rel="stylesheet">
    
    <link href="../util/jquery/jquery.ui.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../util/bs/css/sticky-footer-navbar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--<script src="../../assets/js/ie-emulation-modes-warning.js"></script>!!>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <?php
        require_once '../util/funciones/funciones.php';
        Funciones::menu(3);
    ?>

    <!-- Begin page content -->
    <div class="container">
        <h3>Gestión de Matrículas</h3>
        
        <div id="listado">
            
        </div>
        
      <!-- Button trigger modal -->
      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" id="btn-agregar">
          Agregar Matrícula
        </button>
      
        <br><br>

        <!-- Modal -->
        <form name="frm" action="">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Curso</h4>
                  </div>
                  <div class="modal-body">
                      <input type="hidden" name="txtcodigo" id="txtcodigo">
                      <p>Fecha de Matrícula</p>
                      <p><input type="date" name="txtfecha" id="txtfecha" value="<?php echo date('Y-m-d'); ?>" required="" class="form-control"></p>
                      <p><input type="text" name="txtestudiante" id="txtestudiante" placeholder="Apellidos y Nombres del Estudiante" required="" class="form-control"></p>
                      <p>Dirección:&nbsp;<label id="lbldireccion"></label></p>
                      <p>Teléfono:&nbsp;<label id="lbltelefono"></label></p>
                      <p>
                          <select class="form-control" id="cbocurso">
                              
                          </select>
                      </p>
                      
                      <p>
                          <select class="form-control" id="cbogrupo">
                              
                          </select>
                      </p>
                      <p>Vacantes Disponibles:&nbsp;<label id="lblvacantes"></label></p>
                      
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" id="btn-cerrar" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn-grabar">Grabar</button>
                  </div>
                </div>
              </div>
            </div>
        </form>
    </div>

    <div class="footer">
      <div class="container">
        <p class="text-muted">Gestión de cursos Virtuales. Todos los derechos reservados</p>
      </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../util/jquery/jquery.js"></script>
    <script src="../util/jquery/jquery.dataTables.min.js"></script>
    <script src="../util/jquery/jquery.maskedinput.js"></script>
    <script src="../util/bs/js/bootstrap.js"></script>
    <script src="../util/bs/js/dataTables.bootstrap.js"></script>
    
    <script src="js/matricula.js"></script>
    
    <script src="../util/jquery/jquery.ui.autocomplete.js"></script>
    <script src="../util/jquery/jquery.ui.js"></script>
    <script src="js/matricula-autocompletar.js"></script>
    
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
    
  </body>
</html>
