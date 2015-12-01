/**
 * Created by Codizer on 12/1/15.
 */


$("#close-modal-stats-extra").click(function()
{
    $('#modal-stats-extra').animate({left: '-320px'});
});


function modalStacsExtra()
{
    var modal = $('#modal-stats-extra');
    $('#close-modal-stats-extra').click();
    modal.animate({left: '0px'});
}


function addExtraDataStats(option,  graphDiv )
{

    var datos = charConfig[graphDiv];

    if(option == 'clonar') {

        getDataToGraphics( option, datos );
        console.log("Clonar");

    } else {

        modalStacsExtra();

        datos.push({name: "extra",value: option});

        var route = $("#form-columns-data").attr('action');

        $.ajax({
            url: route,
            type: 'POST',
            dataType: 'json',
            data: datos,
            // async: false,

            success: function (result)
            {
                $('#opcion-extra-selected').text(result.msg);
            }
        }).fail(function( jqXHR, textStatus ) {

                hideShowAlert('msj-danger', 'Ocurrio un problema al obtener los datos');
        });
    }


}