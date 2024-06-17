$(document).ready(function() {
    console.log('hola');

    $('#select-clase').change(function() {
        var idClase = $(this).val();
        console.log(idClase);
        if (idClase) {
            $.ajax({
                url: '../../controllers/controllers_educador/educador_listar_galeria_c.php',
                type: 'GET',
                data: { idClase: idClase },
                success: function(data) {
                    $('#fotos').html(data);
                },
                error: function() {
                    $('#fotos').html('<p>Error al obtener las fotos</p>');
                }
            });
        } else {
            $('#fotos').html('');
        }
    });
});