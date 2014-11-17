var tipo_operacion;
var codigo;

$('#myModal').on('shown.bs.modal', function () {
    $('#txtestudiante').focus();
});

function listar(){
    $("#listado").load("listar-estudiante.php", function(){
       $("#tabla-listado").dataTable();
    });
}

$(document).ready(function(){
   llenarComboCurso();
});

function tipoOperacion(tipo){
    $("#myModalLabel").html("Agregar nueva matrícula");
}

function agregar(){
    codigo = 0;
    tipoOperacion(1);
}

$("#btn-agregar").click(function(){
   agregar();
});

function llenarComboCurso(){
    $("#cbocurso").load("llenar-combo-curso.php");
}
function llenarComboGrupo(){
    var codigo_curso = $("#cbocurso").val();
    
    $.post("llenar-combo-grupo.php", {codigo_curso: codigo_curso})
            .done(function(data){
                $("#cbogrupo").html(data);
                $("#lblvacantes").text("");
            });
}

$("#cbocurso").change(function(){
    llenarComboGrupo();
});

function obtenerVacantesDisponibles(){
    var codigo_grupo = $("#cbogrupo").val();
    
    $.post("obtener-vacantes-disponibles.php",{codigo_grupo: codigo_grupo})
            .done(function(data){
                $("#lblvacantes").text(data);
            });
}

$("#cbogrupo").change(function(){
    obtenerVacantesDisponibles();
})

$("#btn-grabar").click(function(){
    var fecha = $("#txtfecha").val();
    var cod_est = $("#txtcodigo").val();
    var cod_gru = $("#cbogrupo").val();
    
    if ( ! confirm("Esta seguro de grabar la matrícula") ){
        return;
    }

    $.post("registrar-matricula.php", {fecha: fecha, cod_est: cod_est, cod_gru: cod_gru})
            .done(function(data){
                alert(data);
                if ($.trim(data) == "ok"){
                    $("#btn-cerrar").click(); //CIERRA EL FORMULARIO MODAL
                }
            });
    
    
})