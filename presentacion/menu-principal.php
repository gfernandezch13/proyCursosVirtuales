<?php
    session_name("cursosvirtuales");
    session_start();
    
    if (! isset($_SESSION["nombre"])){
        header("location:index.php");
    }
    
    $nombre_usuario = ucwords(strtolower($_SESSION["nombre"]));
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
        Funciones::menu(1);
    ?>

    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>Bienvenido!!!</h1>
      </div>
      <div class="alert alert-info" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h3>Software de gestión de cursos virtuales</h3>
          En esta solución usted podrá gestionar cursos, docentes, estudiantes, matriculas, notas. Asi mismo encontrará diferenrtes reportes para facilitar sus actividades.<br><br>
      </div>
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
    <script src="../util/bs/js/bootstrap.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
  </body>
</html>
