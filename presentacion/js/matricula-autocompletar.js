$("#txtestudiante").autocomplete({
    source: "buscar-estudiante-autocompletar.php", //Llama al archivo que contiene los datos en formato JSON
    minLength: 2, //Ejecuta el autocompletado a partir de 2 caracteres
    focus: f_buscar_registro,
    select: f_seleccionar_registro
});
function f_buscar_registro(event, ui){
    var registro = ui.item.value;
    $("#txtestudiante").val(registro.nombre);
    event.preventDefault();
}
function f_seleccionar_registro(event, ui){
    var registro = ui.item.value;
    $("#txtestudiante").val(registro.nombre);
    $("#lbldireccion").text(registro.direccion);
    $("#lbltelefono").text(registro.telefono);
    $("#txtcodigo").val(registro.codigo);
    event.preventDefault();
}




/*
$("#txtestudiante").autocomplete({
    source: "buscar-estudiante-autocompletar.php", //el archivo que realiza la busqueda
    minLength: 2, //le decimos que tenga al menos 2 caracteres para ejecutrar la busqueda
    select: f_seleccionar_registro, //funcion que se ejecuta cuando el usuario selecciona un registro
    focus: f_marcar_registro
})

function f_seleccionar_registro(event, ui){
    var registro = ui.item.value;
    $("#txtestudiante").val( registro.nombre);
    $("#txtcodigoestudiante").val( registro.codigo);
    $("#lbldireccion").text( registro.direccion );

    event.preventDefault();
}

function f_marcar_registro(event, ui){
    var registro = ui.item.value;
    $("#txtestudiante").val( registro.nombre);
    event.preventDefault();
}
*/