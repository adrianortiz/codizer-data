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
                // console.log(dato);
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
                // console.log(dato);
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
        animationSteps: 60,
        bezierCurve: false
    });

    $('#graphB' + graphDiv).click(
        function(evt){
            var activeBars = myBarChart.getPointsAtEvent(evt);
            activeBars.forEach(function(dato) {
                // console.log(dato);
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
                label: "Intervalo automatico por dispersion",
                fillColor: "rgba(220,220,220,0)",
                strokeColor: "#E5E5E5",
                pointColor: colorB,
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data : res[0][8]
            }
        ]
    };

    var ctx = document.getElementById('graphB' + graphDiv ).getContext("2d");

    var myLiveChart = new Chart(ctx).Line(barChartData, {
        responsive : true,
        animateScale: true,
        animationSteps: 60,
        bezierCurve: false
    });


    $('#graphB' + graphDiv).click(
        function(evt){
            var activeBars = myLiveChart.getPointsAtEvent(evt);

            contador = 0;
            activeBars.forEach(function(dato) {
                // console.log(dato);
                if( $('#radio1' + graphDiv).prop('checked') && contador == 0) {
                    $('#radio1' + graphDiv).val(dato.value);
                    $('#radio3' + graphDiv).val(dato.label);
                    $('#span1' + graphDiv).text(dato.value);
                }

                if( $('#radio2' + graphDiv).prop('checked') && contador == 0) {
                    $('#radio2' + graphDiv).val(dato.value);
                    $('#radio4' + graphDiv).val(dato.label);
                    $('#span2' + graphDiv).text(dato.value);
                }

                contador++;

            });
        }
    );

    return myLiveChart;

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
            console.log( result );
            var x = result[0]['Punto 1']['X'] ;
            var y = result[0]['Punto 1']['Y'] ;

            alert('Se recibio: ' + result);
        }

    }).fail(function( jqXHR, textStatus )
    {

        alert('Error al enviar');

    });

}

function addDataMinCuadrado(graphDiv )
{

    // console.log("Minimos cuadrados" + resX[0][9]);
    // console.log("Labels" + resX[0][4] );

    var labels = resX[graphDiv][0][4];
    var medDis = resX[graphDiv][0][8];
    var minCua = resX[graphDiv][0][9];


    var myNewDataset = {
        pointColor: "#E5E5E5",
        data : resX[graphDiv][0][9],
        pointColor: "#E5E5E5"
    };

    // console.log("ALGO AQUI: " + charX.datasets[0].points[0].label);
    // console.log("ALGO AQUI: " + charX.datasets.length + 1 + " + " + charX.datasets.length + " + " + 0);
    // console.log("Mis labels = " + myNewDataset.data);
    // new Chart(ctx).Line(barChartData, {
    // charX.datasets[0].points[2].value = 50;
    // Would update the first dataset's value of 'March' to be 50


    var puntos = [];

    myNewDataset.data.forEach(function (value, i) {
        puntos.push(new char[graphDiv].PointClass({
            value: value,
            label: char[graphDiv].datasets[0].points[i].label,
            x: char[graphDiv].scale.calculateX(char[graphDiv].datasets.length + 1, char[graphDiv].datasets.length, i),
            y: char[graphDiv].scale.endPoint,
            pointColor: "#E5E5E5"
        }))
    });

    console.log( puntos );

    char[graphDiv].datasets.push({
        label: "Minimos cuadrados",
        fillColor: "rgba(220,220,220,0.1)",
        strokeColor: "#E5E5E5",
        pointColor: "#E5E5E5",
        pointStrokeColor: "#E5E5E5",
        pointHighlightFill: "#E5E5E5",
        pointHighlightStroke: "#E5E5E5",
        points: puntos
    });

    char[graphDiv].update();

    /*
    var i = 0;
    for (i in minCua) {
        // charX.addData(minCua[i], labels[i]);
        // console.log( minCua[i] + " OK " + labels[i] );

        // charX.datasets[1].points[ i ].value = minCua[i];
        // charX.update();

        // charX.removeData();
    }*/

}