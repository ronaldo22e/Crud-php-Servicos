let url = 'http://localhost:8080/Api/personas/';

$(document).ready(function() {
    cargarPersonas();
});

function cargarPersonas() {
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Rest of your code for displaying personas
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Error en la solicitud AJAX:', textStatus, errorThrown);
        }
    });
}

function eliminarPersona(id) {
    if (confirm('¿Estás seguro de que deseas eliminar el registro?')) {
        $.ajax({
            url: url + 'eliminar/' + id,
            type: 'DELETE',
            success: function(response) {
                alert('Registro eliminado exitosamente');
                cargarPersonas();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        });
    }
}

// The code for editing and creating personas should be updated similarly.
// Ensure that your API supports these actions and their corresponding endpoints.
