/**
 * Created by Ortiz on 11/4/15.
 */
/*
    SHOW/HIDE MODALS STATISTICS
 */


function closeModalInputs( nameModal )
{
    $("#"+nameModal).fadeOut();
    resetClear();
    $('#div-data').empty();
}

function showModalInputs(nameModal)
{
    $('#title').val('');
    $('#description').val('');
    $('#titleChangeTo').text('Título del campo');
    $("span#descChangeTo").attr("data-original-title", 'Descripción de este campo.' );
    $("#"+nameModal).fadeIn();
}






/*
    GET COLUMNS FROM COLLECTION SELECTED
 */

$("#get-columns").click( function()
{
    var datos = $("#form-columns").serializeArray();
    var route = $("#form-columns").attr('action');
    var formColumns = $('#list-colums');
    formColumns.empty();

    $.ajax({
        url: route,
        type: 'POST',
        dataType: 'json',
        // async: false,
        data: datos,

        success: function (result)
        {
            $('#get-columns').attr("disabled", true);
            $('#id').attr("disabled", true);
            $(result).each(function(key,value)
            {
                formColumns.append('<label class="btn btn-primary inactive check-input"><input type="checkbox" name="title[]" autocomplete="off" class="hola" value="'+ value.title +'">' + value.title + '</label>');
            });

            hideShowAlert('msj-success', 'Columnas obtenidas');

            $('#get-columns').slideUp( function()
            {
                $('#form-colums-div').slideDown();
            });

            $('#controlX').val( $('#id').val());

        }

    }).fail(function( jqXHR, textStatus )
    {

        $('#msj-danger-state').empty();
        $(jqXHR).each(function(key,error)
        {
            // console.log( error.responseJSON );
            /*
            if ( !(error.responseJSON.title == null) )
                $('#msj-danger-state').append('<li>' + error.responseJSON.title + '</li>');

            if ( !(error.responseJSON.description == null) )
                $('#msj-danger-state').append('<li>' + error.responseJSON.description + '</li>');
                */
            hideShowAlert('msj-danger', 'Ocurrio un problema');
        });

    });

});





/*
     VALIDATE COLUMNS SELECTED BY NUM COLUMNS TO GRAPHICS
 */
$("#get-data").click( function()
{
    var columsGraph = $('#num_colums').val();
    var numColSelect = 0;

    if( $('#group').val() >= 2 ) {

        $('input:checkbox:checked').each( function() { numColSelect++; });

        if (numColSelect == 0)
            hideShowAlert('msj-danger', 'Seleccionar columnas a gráficar.');

        if( columsGraph == 1 && numColSelect == 1)
            getDataToGraphics();

        if( columsGraph == 1 && numColSelect >= 2)
            hideShowAlert('msj-danger', 'No puedes elegir más de 1 columna.<br>Porque seleccionaste 1 columna a gráficar.');

        if( columsGraph == 2 && numColSelect >= 2)
            getDataToGraphics();

        if( columsGraph == 2 && numColSelect < 2)
            hideShowAlert('msj-danger', 'Selecciona almenos 2 columnas.<br>Porque seleccionaste 2 o más columnas a gráficar.');

        numColSelect = 0;
    } else {
        hideShowAlert('msj-danger', 'La graficación en grupos tiene que ser igual o mayor a 2.');
    }

});


/*
 GET COLUMNS DATA FROM COLUMNS SELECTED
 */
function getDataToGraphics()
{
    var datos = $("#form-columns-data").serializeArray();
    var route = $("#form-columns-data").attr('action');
    var divData = $('#div-data');

    $.ajax({
        url: route,
        type: 'POST',
        dataType: 'json',
        data: datos,

        success: function (res) {
            hideShowAlert('msj-success', 'Datos de la gráfica obtenidos');

            divData.append('<div><h1>Gráfica X</h1>');

            $(res).each(function(key,value){

                divData.append('<p>' + value.content + '</p>');
            });

            divData.append('</div>');
        }

    }).fail(function( jqXHR, textStatus ) {

        $('#msj-danger-state').empty();
        $(jqXHR).each(function(key,error){
            hideShowAlert('msj-danger', 'Ocurrio un problema al obtener datos de la gráfica');
        });

    });
}


$('#btn-limpiar').click( function()
{
    resetClear();
});

function resetClear()
{
    $('#get-columns').attr("disabled", false);
    $('#id').attr("disabled", false);
    $('#get-columns').slideDown( function()
    {
        $('#list-colums').empty(); // limpiar columnas
        $('#form-colums-div').slideUp(); // mostrar boton enviar collection
    });
}

// Hide alerts
$(".alert").click(function()
{
    $(".alert").fadeOut();
});


function hideShowAlert(show, desc)
{
    $(".alert").click();
    $('#' + show + '-state').html(desc);
    $('#' + show).fadeIn();
}