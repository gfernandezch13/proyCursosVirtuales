<html>
<head>
    <link href="../util/bs/css/bootstrap.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-4">
                <h4>
                    REPORTE DE MATRICULAS POR GRUPO
                </h4>
                <form name="frmReporte" action="reporte-estudiantes-generar.php" method="post" target="_blank">
                    <p>
                        <select class="form-control" id="cbocurso">

                        </select>
                    </p>

                    <p>
                        <select class="form-control" id="cbogrupo">

                        </select>
                    </p>
                    <p>
                        <button type="submit" class="btn btn-primary">Generar Reportes</button>
                    </p>
                </form>
            </div>
        </div>
    </div>


    <script src="../util/jquery/jquery.js"></script>
    <script src="../util/bs/js/bootstrap.js"></script>
    <script src="../util/bs/js/dataTables.bootstrap.js"></script>

    <script src="js/matricula.js"></script>

    <script src="../util/jquery/jquery.ui.js"></script>
</body>
</html>