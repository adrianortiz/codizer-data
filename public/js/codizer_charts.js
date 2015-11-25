/**
 * Created by Codizer on 11/23/15.
 */
/*
 * GRAFICAR POR VARIABLE
 */

function byVar(res, graphDiv, colorA, colorB) {

    // console.log( res[0][2]['data'] );
    // console.log( res[0][0]['categories'] );

    var barChartData = {
        // labels : ["January","February","March","April","May","June","July"],
        labels : res[0][0]['categories'],
        label: "My First dataset",

        datasets : [
            {
                fillColor : colorB,
                strokeColor : colorB,
                highlightFill : colorB,
                highlightStroke : colorB,
                data : res[0][2]['data']
            }
        ]

    };

    var ctx = document.getElementById('graphB' + graphDiv ).getContext("2d");
    var myBarChart = new Chart(ctx).Bar(barChartData, {
        responsive : true,
        animateScale: true,
        animationSteps: 60,
    });

    $('#graphB' + graphDiv).click(
        function(evt){

            var activeBars = myBarChart.getBarsAtEvent(evt);

            activeBars.forEach(function(dato) {
                console.log(dato);
            });


        }
    );
}


/*
 * GRAFICAR POR VARIABLE
 */

function byAutoInterval(res, graphDiv, colorA, colorB) {
    var barChartData = {
        labels : res[0][4], // X
        label: "HISTOGRAMA",
        datasets : [
            {
                fillColor : colorB,
                strokeColor : colorB,
                highlightFill : colorB,
                highlightStroke : colorB,
                data : res[0][5]
            }
        ]
    };
    var ctx = document.getElementById('graphB' + graphDiv ).getContext("2d");
    var myBarChart = new Chart(ctx).Bar(barChartData, {
        responsive : true,
        animateScale: true,
        animationSteps: 60
    });

    $('#graphB' + graphDiv).click(
        function(evt){

            var activeBars = myBarChart.getBarsAtEvent(evt);

            activeBars.forEach(function(dato) {
                console.log(dato);
            });
        }
    );
}


/*
 * GRAFICAR POR OJIVA
 */

function byAutoIntervalOji(res, graphDiv, colorA, colorB) {
    var barChartData = {
        labels : res[0][4], // X
        label: "OJIVA",
        datasets : [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0)",
                strokeColor: "#E5E5E5",
                pointColor: colorB,
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data : res[0][6]
            }
        ]
    };
    var ctx = document.getElementById('graphB' + graphDiv ).getContext("2d");
    var myBarChart = new Chart(ctx).Line(barChartData, {
        responsive : true,
        animateScale: true,
        animationSteps: 60
    });

    $('#graphB' + graphDiv).click(
        function(evt){
            var activeBars = myBarChart.getPointsAtEvent(evt);
            activeBars.forEach(function(dato) {
                console.log(dato);
            });
        }
    );
}


/*
 GRÁFICA POR DISPERSIÓN
 */

var labelA, lalebB;
function byAutoIntervalDisp(res, graphDiv, colorA, colorB) {
    var barChartData = {
        labels : res[0][4], // X
        label: "OJIVA",
        datasets : [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0)",
                strokeColor: "#E5E5E5",
                pointColor: colorB,
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data : res[0][8]
            },/*
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0)",
                strokeColor: "#E5E5E5",
                pointColor: colorB,
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data : res[0][9]
            },*/
        ]
    };
    var ctx = document.getElementById('graphB' + graphDiv ).getContext("2d");
    var myBarChart = new Chart(ctx).Line(barChartData, {
        responsive : true,
        animateScale: true,
        animationSteps: 60
    });

    $('#graphB' + graphDiv).click(
        function(evt){
            var activeBars = myBarChart.getPointsAtEvent(evt);
            activeBars.forEach(function(dato) {

                console.log(dato);
                if( $('#radio1' + graphDiv).prop('checked') ) {
                    $('#radio1' + graphDiv).val(dato.value);
                    $('#radio3' + graphDiv).val(dato.label);
                    $('#span1' + graphDiv).text(dato.value);
                }

                if( $('#radio2' + graphDiv).prop('checked') ) {
                    $('#radio2' + graphDiv).val(dato.value);
                    $('#radio4' + graphDiv).val(dato.label);
                    $('#span2' + graphDiv).text(dato.value);
                }

            });
        }
    );
}


/*
    VALIDAR DATOS DE PUNTOS SELECTO AL FOMULARIO
    VALIDAR PARA ENVIAR
 */
function getDataPuntos(graphDiv)
{
    $('#punto1X').val( $('#radio1' + graphDiv).val() );
    $('#punto1Y').val( $('#radio3' + graphDiv).val() );
    $('#punto2X').val( $('#radio2' + graphDiv).val() );
    $('#punto2Y').val( $('#radio4' + graphDiv).val() );

    if( $('#radio1' + graphDiv).val() == null || $('#radio1' + graphDiv).val() == ''
        || $('#radio2' + graphDiv).val() == null || $('#radio2' + graphDiv).val() == ''
        || $('#radio3' + graphDiv).val() == null || $('#radio3' + graphDiv).val() == ''
        || $('#radio4' + graphDiv).val() == null || $('#radio4' + graphDiv).val() == '')
    {

        $('#msj-danger-state').empty();
        hideShowAlert('msj-danger', 'Por favor selecciona los dos puntos.');

    } else {
        getDataPuntosToGraph(graphDiv);
    }
}

function getDataPuntosToGraph(graphDiv)
{
    var datos = $("#form-points-data").serializeArray();
    var route = $("#form-points-data").attr('action');

    $.ajax({
        url: route,
        type: 'GET',
        dataType: 'json',
        // async: false,
        data: datos,

        success: function (result)
        {
            alert('Se recibio: ' + result);
        }

    }).fail(function( jqXHR, textStatus )
    {

        alert('Error al enviar');

    });

}

function addDataMinCuadrado(graphDiv, datosX )
{
    console.log( graphDiv + " Data: " + datosX.length );
}