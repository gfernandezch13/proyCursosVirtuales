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
        Funciones::menu(2);
    ?>

    <!-- Begin page content -->
    <div class="container">
        <h3>Listado de Cursos</h3>
        
        <?php
            require_once '../negocio/curso.php';
            $objCurso = new Curso();
            $objCurso->listar();
        ?>
        
      <!-- Button trigger modal -->
      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" onclick="agregarCurso();">
          Agregar Curso
        </button>
      
        <br><br>

        <!-- Modal -->
        <form name="frmcurso" action="registrar-curso.php" method="post">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Curso</h4>
                  </div>
                  <div class="modal-body">
                      <input type="hidden" name="txtcodigo" id="txtcodigo">
                      <p><input type="text" name="txtnombrecurso" id="txtnombrecurso" placeholder="Nombre del curso" required="" class="form-control"></p>
                      <p><input type="text" name="txtprecio" id="txtprecio" placeholder="Precio del Curso" required="" class="form-control"></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Grabar</button>
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
    <script src="../util/bs/js/bootstrap.js"></script>
    <script src="../util/bs/js/dataTables.bootstrap.js"></script>
    
    <script type="text/javascript">
        $('#myModal').on('shown.bs.modal', function () {
            $('#txtnombrecurso').focus();
        });
    </script>
    
    <script type="text/javascript">
        function eliminarCurso(codigo){
            if (confirm("Desea eliminar el curso seleccionado")==true){
                $.post("eliminar-curso.php", {codigocurso: codigo})
                        .done(function(data){
                           if (data=="1"){
                               document.location.href="cursos.php";
                           }
                        });
                        
            }
        }
        
        function buscarCurso(codigo){
            $.post("buscar-curso.php", {codigo: codigo})
                    .done(function(data){
                        //alert(data);
                        var resultado = $.parseJSON(data);
                        //alert(resultado);
                        $("#txtnombrecurso").val(resultado.nombre);
                        $("#txtprecio").val(resultado.precio);
                        $("#txtcodigo").val(resultado.codigo);
                    });
            
        }
        
        function editarCurso(codigo){
            buscarCurso(codigo);
            tipoOperacion(2);
            //aqui
        }
        
        function tipoOperacion(tipo){
            if (tipo == 1){
                $("#myModalLabel").html("Agregar nuevo curso");
            }else{
                $("#myModalLabel").html("Editar curso");
            }
        }
        
        function agregarCurso(){
            tipoOperacion(1);
            $("#txtcodigo").val("0");
            $("#txtnombrecurso").val("");
            $("#txtprecio").val("");
        }
        
    </script>
    
    <script type="text/javascript">
        $(document).ready(function(){
           $('#listado').dataTable();
        });
    </script>
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
    
  </body>
</html>
