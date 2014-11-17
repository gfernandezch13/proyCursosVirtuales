<?php
    session_name("cursosvirtuales");
    session_start();
    
    if (! isset($_SESSION["nombre"])){
        header("location:index.php");
    }
?>

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
        <h3>Listado de Grupos</h3>
        
        <div id="listado">
            
        </div>
        
      <!-- Button trigger modal -->
      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" id="btn-agregar">
          Agregar Grupo
        </button>
      
        <br><br>

        <!-- Modal -->
        <form name="frmcurso" action="registrar-curso.php" method="post">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Agregar</h4>
                  </div>
                  <div class="modal-body">
                      <input type="hidden" name="txtcodigo" id="txtcodigo">
                      <p>
                          <select id="cbocurso" class="form-control">
                              <?php
                                  require_once '../negocio/curso.php';
                                  $objCurso = new Curso();
                                  echo $objCurso->llenarComboCurso();
                              ?>
                          </select>
                      </p>
                      
                      <p>
                          <select id="cbodocente" class="form-control">
                          </select>
                      </p>
                      
                      <p>Fecha de Inicio<input type="date" name="txtfechainicio" id="txtfechainicio" placeholder="Fecha de inicio" required="" class="form-control"></p>
                      <p>Fecha Fin<input type="date" name="txtfechafin" id="txtfechafin" placeholder="Fecha fin" required="" class="form-control"></p>
                      <p><input type="text" name="txtdescripcion" id="txtdescripcion" placeholder="Descripción (A,B,C)" required="" class="form-control"></p>
                      <p><input type="text" name="txtnrovacantes" id="txtnrovacantes" placeholder="Número de vacantes" required="" class="form-control"></p>
                      
                      
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
    
    <script type="text/javascript">
        $('#myModal').on('shown.bs.modal', function () {
            $('#txtapellidos').focus();
        });
    </script>
    
    <script type="text/javascript">
        
        var tipo_operacion;
        var codigo;
        
        function listar(){
            $("#listado").load("listar-grupo-academico.php", function(){
               $("#tabla-listado").dataTable();
            });
            
        }
        
        function llenarComboDocente(){
            $("#cbodocente").load("llenar-combo-docente.php");
        }
        
        $(document).ready(function(){
           listar();
           mascaras();
           llenarComboDocente();
        });
        
        function mascaras(){
            $("#txtdni").mask("99999999");
            $("#txttelefono").mask("(999)-999999");
        }
        
        function tipoOperacion(tipo){
            if (tipo == 1){
                $("#myModalLabel").html("Agregar nuevo estudiante");
            }else{
                $("#myModalLabel").html("Editar datos del estudiante");
            }
        }
        
        function agregar(){
            codigo = 0;
            tipoOperacion(1);
        }
        
        $("#btn-agregar").click(function(){
           agregar();
        });
        
        $("#btn-grabar").click(function(){
           var apellidos    = $("#txtapellidos").val();
           var nombres      = $("#txtnombres").val();
           var dni          = $("#txtdni").val();
           var sexo         = $("#cbosexo").val();
           var fechanac     = $("#txtfechanacimiento").val();
           var direccion    = $("#txtdireccion").val();
           var telefono     = $("#txttelefono").val();
           var correo       = $("#txtcorreo").val();
           
           codigo           = $("#txtcodigo").val();
           
           if ($.isEmptyObject(sexo)){
               alert("Debe seleccionar el sexo");
               return;
           }
           
           if ( ! confirm("Esta seguro de grabar los datos") ){
               return;
           }
           
           $.post("grabar-estudiante.php", {codigo: codigo, apellidos: apellidos, nombres: nombres, dni: dni, sexo: sexo, fechanac: fechanac, direccion: direccion, telefono: telefono, correo: correo})
                   .done(function(data){
               
                        //alert(data);
               
                       if (data == "ok"){
                           $("#myModal").modal("toggle"); //CIERRA EL FORMULARIO MODAL
                           listar();
                       }
                   });
           
        });
        
        function leerDatos(codigo){
            $.post("buscar-estudiante.php", {codigo: codigo})
                    .done(function(data){
                       resultado = $.parseJSON(data);
                       $("#txtcodigo").val(resultado.codigo);
                       $("#txtapellidos").val(resultado.apellidos);
                       $("#txtnombres").val(resultado.nombres);
                       $("#txtdni").val(resultado.dni);
                       $("#cbosexo").val(resultado.sexo);
                       $("#txtdireccion").val(resultado.direccion);
                       $("#txttelefono").val(resultado.telefono);
                       $("#txtcorreo").val(resultado.correo);
                       $("#txtfechanacimiento").val(resultado.fecha_nacimiento);
                    });
        }
        
        function editarEstudiante(codigo){
            tipoOperacion(2);
            leerDatos(codigo);
        }
        
        
        function eliminarEstudiante(codigo){
            if (confirm("Desea eliminar el estudiante seleccionado")==true){
                $.post("eliminar-estudiante.php", {codigo: codigo})
                        .done(function(data){
                           if (data=="1"){
                               listar();
                           }
                        });
            }
        }
        
        
        
    </script>
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
    
  </body>
</html>
