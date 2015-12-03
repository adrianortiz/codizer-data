/**
 * Created by Codizer on 12/1/15.
 */


$("#close-modal-stats-extra").click(function()
{
    var content = $('#content-data-extra');
    content.empty();
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

        datos.push({name: "extra", value: option});

        var route = $("#form-columns-data").attr('action');

        $.ajax({
            url: route,
            type: 'POST',
            dataType: 'json',
            data: datos,
            // async: false,

            success: function (result)
            {

                var title = $('#opcion-extra-selected');
                var content = $('#content-data-extra');

                title.empty();
                content.empty();

                title.text( result[0][7] );

                // Tendencia central
                if( result[0][7] == 'Tendencia central'){
                    content.append("<br>MEDIA: " + result[0][4].toFixed(2) );
                    content.append("<br>MEDIANA: " + result[0][5]);
                    content.append("<br>MODA: " + result[0][6]);
                }

                // Medidas de dispersión
                if( result[0][7] == 'Medidas de dispersión'){
                    content.append("<br>DESVIACIÓN MEDIA: " + result[0][1] );
                    content.append("<br>VARIANZA: " + result[0][2] );
                    content.append("<br>DESVIACIÓN ESTÁNDAR: " + result[0][3]);
                }

                // Medidas de Posición
                if( result[0][7] == 'Medidas de Posición'){
                    content.append("<br>DECILES: " + result[0][1] );
                    content.append("<br>PERCENTILES: " + result[0][2] );
                    content.append("<br>CUARTILES: " + result[0][3]);
                }

                // Medidas de Deformación
                if( result[0][7] == 'Medidas de Deformación'){
                    content.append("<br>SESGO MO: "         + result[0][1] );
                    content.append("<br>SESGO MO MEDIANA: " + result[0][2] );
                    content.append("<br>SESGO PER: "        + result[0][3]);
                    content.append("<br>SESGO CUAR: "       + result[0][4]);
                    content.append("<br>SESGO A: "          + result[0][5]);

                    content.append("<br>MO: "               + result[0][6]);
                    content.append("<br>CURTOSIS Q: "       + result[0][7]);
                    content.append("<br>CURTOSIS : "        + result[0][8]);
                    content.append("<br>CURTOSIS A : "      + result[0][9]);
                }


                console.log( result );


            }
        }).fail(function( jqXHR, textStatus ) {

                hideShowAlert('msj-danger', 'Ocurrio un problema al obtener los datos');
        });
    }


}