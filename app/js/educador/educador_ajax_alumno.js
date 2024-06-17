$(document).ready(function() {

    $('#select-clase').change(function() {
        var idClase = $(this).val();
        console.log(idClase);
        if (idClase) {
            $.ajax({
                url: '../../controllers/controllers_educador/educador_listar_alumno_c.php',
                type: 'GET',
                data: { idClase: idClase },
                success: function(data) {
                    $('#alumnos').html(data);
                },
                error: function() {
                    $('#alumnos').html('<p>Error al obtener las fotos</p>');
                }
            });
        } else {
            $('#alumnos').html('');
        }
    });
});