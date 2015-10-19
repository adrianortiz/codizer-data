/**
 * Created by Ortiz on 10/19/15.
 */


// LIST INSPUTS
function listInputs()
{
    var tablaDatos = $('#datos');
    var route = $("#form-show").attr('action');

    var contador = 1;
    tablaDatos.empty();
    $.get(route, function(res) {
        $(res).each(function(key,value){
            tablaDatos.append('<div class="container-input-base"><div>'+ contador +'</div><div>'+ value.title +'</div><div><a href="#">Edit</a></div><div><a href="#">Delete</a></div></div>');
            contador++;
        });
    });
}


// SHOW/HIDE MODALS INPUTS
function closeModalInputs( nameModal ) {
    $("#"+nameModal).fadeOut();
}

function showModalInputs(nameModal) {
    $("#"+nameModal).fadeIn();
}

// NEW INSPUT
$("#registro-textoCorto").click( function() {
    var datos = $("#form-textoCorto").serializeArray();
    var route = $("#form-textoCorto").attr('action');

    $.ajax({
        url: route,
        type: 'POST',
        dataType: 'json',
        data: datos,

        success:function(){
            closeModalInputs('modal-textoCorto');
            $('#msj-success').fadeIn();
            listInputs();
        }
    });
});

listInputs();

