/**
 * Created by Ortiz on 10/17/15.
 */

$(document).ready(function () {

    $('.btn-eliminar').click(function (e) {
        e.preventDefault();
        var div = $(this).parent('li').parent('ul').parent('div').parent('div');
        var id = div.data('id');
        var form = $('#form-delete');
        var url = form.attr('action').replace(':USER_ID', id);
        var data = form.serialize();

        $('.notificacion-text-fondo').fadeIn();

        $('#si').click(function (e) {
            div.fadeOut();
            $('.notificacion-text-fondo').fadeOut();
            $.post(url, data, function (result) {
                console.log(result.message);
            }).fail(function () {
                console.log('La colección no fue eliminada');
                div.fadeIn();
            });
        });

        $('#no').click(function (e) {
            $('.notificacion-text-fondo').fadeOut();
        });

    });
});