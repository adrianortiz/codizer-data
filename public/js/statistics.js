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

    $.ajax({
        url: route,
        type: 'POST',
        dataType: 'json',
        async: false,
        data: datos,

        success: function (result) {

            formColumns.append('<div class="form-group"><label>COLUMNAS</label></div><div class="btn-group-vertical" data-toggle="buttons" style="width: 233px;">');

            $(result).each(function(key,value){
                formColumns.append('<label class="btn btn-primary inactive check-input"><input type="checkbox" name="title[]" autocomplete="off" value="'+ value.title +'">' + value.title + '</label>');
            });

            formColumns.append('</div>');

            hideShowAlert('msj-success', 'Columnas obtenidas');

            $('#get-columns').slideUp( function() {
                $('#form-colums-div').slideDown();
            });

            // $('#id').attr('disabled', 'disabled');
            $('#controlX').val( $('#id').val());


            $('#container-checks').on('click', 'label.check-input input', function(e)
            {
                e.preventDefault();
                alert("Puto");
            });
        }

    }).fail(function( jqXHR, textStatus ) {

        $('#msj-danger-state').empty();
        $(jqXHR).each(function(key,error){

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
 GET COLUMNS DATA FROM COLUMNS SELECTED
 */
$("#get-data").click( function()
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

});




$('#btn-limpiar').click( function() {
    resetClear();
});

function resetClear() {
    // $('#id').attr('disabled', '');
    $('#get-columns').slideDown( function() {
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