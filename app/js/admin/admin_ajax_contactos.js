$(document).ready(function() {
    $('#select-alumno').change(function() {
        var idEstudiante = $(this).val();
        if (idEstudiante) {
            $.ajax({
                url: '../../controllers/controllers_admin/admin_listar_contacto_c.php',
                type: 'GET',
                data: { id_estudiante: idEstudiante },
                success: function(data) {
                    $('#contactos-emergencia').html(data);
                },
                error: function() {
                    $('#contactos-emergencia').html('<p>Error al obtener los contactos de emergencia.</p>');
                }
            });
        } else {
            $('#contactos-emergencia').html('');
        }
    });
});