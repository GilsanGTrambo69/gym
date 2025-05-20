$(document).ready(function() {
    buscar_datos(); // Llama la función al cargar la página
});

// Cargar los datos de los usuarios
function buscar_datos(consulta = "") {
    $.ajax({
        url: './ajax/buscar_usuario.ajax.php',
        type: 'POST',
        dataType: 'html',
        data: {consulta: consulta}
    })
    .done(function(respuesta) {
        $("#resultado").html(respuesta);
    })
    .fail(function() {
        console.log("error");
    });
}

$(document).on('keyup', '#buscador', function() {
    var consulta = $(this).val();
    buscar_datos(consulta);
});