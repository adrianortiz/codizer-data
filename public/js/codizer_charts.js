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
            },
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0)",
                strokeColor: "#E5E5E5",
                pointColor: colorB,
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data : res[0][9]
            },

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
                    $('#radio3' + graphDiv).val(dato.value);
                    $('#span1' + graphDiv).text(dato.value);
                    labelA = dato.label;
                }

                if( $('#radio2' + graphDiv).prop('checked') ) {
                    $('#radio2' + graphDiv).val(dato.value);
                    $('#radio4' + graphDiv).val(dato.value);
                    $('#span2' + graphDiv).text(dato.value);
                    lalebB = dato.label;
                }

                console.log(labelA);
                console.log(lalebB);


            });
        }
    );
}