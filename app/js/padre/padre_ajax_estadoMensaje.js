$(document).ready(function() {

    $('img[id^="visto-"]').click(function () { 
        var valor= $(this).data('valor')
        console.log(valor);
    });

});