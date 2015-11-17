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
    /*
    for(i=0; i<= 51; i++)
    {
        $('#graphA' + i).empty();
        $('#graphC' + i).empty();
        // Creamos nuestro canvas
        var canvas = document.getElementById("graphB" + i);
        var ctx = canvas.getContext("2d");
        // Borramos el área que nos interese
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
    */
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
var graphDiv = 0;
function getDataToGraphics()
{
    var datos = $("#form-columns-data").serializeArray();
    var route = $("#form-columns-data").attr('action');

    var items = ['#FFAE00', '#A75BDF', '#FF3F50', '#39E861', '#00D6D5', '#00B7FE', '#D7D7D7'];

    var rint = Math.round(0xffffff * Math.random());
    var colorA = 'rgba(' + (rint >> 16) + ',' + (rint >> 8 & 255) + ',' + (rint & 255);

    // rint = Math.round(0xffffff * Math.random());
    // var colorB = 'rgba(' + (rint >> 16) + ',' + (rint >> 8 & 255) + ',' + (rint & 255);
    var colorB = items[Math.floor(Math.random()*items.length)];

    $.ajax({
        url: route,
        type: 'POST',
        dataType: 'json',
        data: datos,

        success: function (res) {

            $(".alert").click();
            //console.log( res[0][0]['categories'].sort() );
            graphDiv++;

            // byVar(res, graphDiv, item);
            jChar(res, graphDiv, items, colorB);

            $('#graph' + graphDiv).css({'height': 'auto', 'width': '44%'});

            $('#graphA' + graphDiv).append('<div><h3 style="text-align: center">Datos analizados</h3> </div>');
            $('#graphA' + graphDiv).append('<p style="text-align: center"> ' + res[0][1] + ' -> ' + res[0][3] + '<p><div class="tag-collect"> ' + res[0][1] + ' </div></dvi><div class="btn-group" style="float: right;" role="group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span><img src="/images/icon-menu.svg" class="icon-button"></span><span class="caret"></span></button><ul class="dropdown-menu dropdown-menu-right"> <li class="dropdown-header">Descargar imagen de:</li> <li><a href="#" onclick="saveImg(\'#graphB'+ graphDiv +'\');">Solo gráfica</a></li><li><a href="#" onclick="saveImg(\'#graphC'+ graphDiv +'\');">Medidas de dispersión</a></li><li role="separator" class="divider"></li><li><a href="#" onclick="$(\'#graph'+ graphDiv +'\').fadeOut().empty();">Eliminar gráfica</a></li></ul></div>');
            $('#graphC' + graphDiv).append('<div class="tag-var"><span> ' + res[0][3] + ' </span></div>');
            $('#graphC' + graphDiv).append('<div class="container-rangos"> <div><div></div><h3>' + res[0][4].toFixed(2)  + '</h3><p>Media</p></div> <div><div></div><h3>' + res[0][5] + '</h3><p>Mediana</p></div> <div><div></div><h3>'+res[0][6]+'</h3><p>Moda</p></div> </div>');

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



function filterPath(string) {
    return string
        .replace(/^\//,'')
        .replace(/(index|default).[a-zA-Z]{3,4}$/,'')
        .replace(/\/$/,'');
}
var locationPath = filterPath(location.pathname);
var scrollElem = scrollableElement('html', 'body');

$('a[href*=#]').each(function() {
    var thisPath = filterPath(this.pathname) || locationPath;
    if (  locationPath == thisPath
        && (location.hostname == this.hostname || !this.hostname)
        && this.hash.replace(/#/,'') ) {
        var $target = $(this.hash), target = this.hash;
        if (target) {
            var targetOffset = $target.offset().top;
            $(this).click(function(event) {
                event.preventDefault();
                $(scrollElem).animate({scrollTop: targetOffset}, 400, function() {
                    location.hash = target;
                });
            });
        }
    }
});


// use the first element that is "scrollable"
function scrollableElement(els) {
    for (var i = 0, argLength = arguments.length; i <argLength; i++) {
        var el = arguments[i],
            $scrollElement = $(el);
        if ($scrollElement.scrollTop()> 0) {
            return el;
        } else {
            $scrollElement.scrollTop(1);
            var isScrollable = $scrollElement.scrollTop()> 0;
            $scrollElement.scrollTop(0);
            if (isScrollable) {
                return el;
            }
        }
    }
    return [];
}


$('#graphA1xx').click( function() {
    $('#div-data').scrollTop( -1000 );
});


/*
    SAVE A IMAGE .PNG
 */
function saveImg( toImage ) {
    html2canvas($( toImage ), {
        onrendered: function(canvas) {
            theCanvas = canvas;
            document.body.appendChild(canvas);

            canvas.toBlob(function(blob) {
                saveAs(blob, "codizer-data.png");
            }, "image/png");

            document.body.removeChild(canvas);
        }
    });
}


/*
    ORDENAR LOS DATOS DE MENOAR A MAYOR O DE MAYOR A MENOR
 */
function deMenorAMayor(elem1, elem2)
{
    return elem1-elem2;
}

function deMayorAMenor(elem1, elem2)
{
    return elem2-elem1;
}





/*
    GRÁFICA BASE
 */
function base(res, graphDiv, item) {
    $('#graphB' + graphDiv).highcharts({
        chart: {
            // type: 'column'
        },
        title: {
            text: res[0][1] + '->' + res[0][3] // Alumnos
        },
        xAxis: {
            categories: res[0][0]['categories'].sort() // Categories
        },
        yAxis: {
            title: {
                text: res[0][1] // Alumnos
            }
        },
        series: [{
            name: res[0][3], // Edad
            data: res[0][2]['data']
            // }, {
            //    name: 'John',
            //    data: [5, 7, 3]
        }],
        colors: [item, '#434348', '#90ed7d', '#f7a35c', '#1A91F2',
            '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1']
    });
}



/*
 GRAFICAR POR VARIABLE
 */

function byVar(res, graphDiv, item) {
    $('#graphB' + graphDiv).highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Average Rainfall'
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rainfall (mm)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Tokyo',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

        }, {
            name: 'New York',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

        }, {
            name: 'London',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

        }, {
            name: 'Berlin',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }]
    });
}


/*
    JCHAR
 */

function jChar(res, graphDiv, colorA, colorB) {

    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

    var barChartData = {
        // labels : ["January","February","March","April","May","June","July"],
        labels : res[0][0]['categories'].sort(deMenorAMayor),
        label: "My First dataset",

        datasets : [
            {

                fillColor : colorB,
                strokeColor : colorB,
                highlightFill : colorB,
                highlightStroke : colorB,
                data : res[0][2]['data']
            }
            /*
            {
                fillColor : "rgba(44, 44, 44, 0.8)",
                strokeColor : "rgba(44, 44, 44, 0.8)",
                highlightFill: "rgba(44, 44, 44, 0.9)",
                highlightStroke: "rgba(44, 44, 44, 0.9)",
                data : res[0][0]['categories'].sort()
            }*/
        ]

        }

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