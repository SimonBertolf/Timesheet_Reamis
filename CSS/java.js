// Menue
$(document).ready(function(){
    $("#1").click(function(){
        $("#2").slideToggle("slow");
    });
});

// New Project
$(document).ready(function(){
    $("#3").click(function(){
        $("#4").slideToggle("fast");
    });
});

//Barchart
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        [' ','Soll', 'Ist',],
        ['Soll/Ist',  soll ,ist]
]);
    var options = {
        title: ' ',
        colors: ['#777777','#202525'],
        'backgroundColor': 'transparent',
        'borderColor': '#AC2D2D',
        'width': 200, 'height': 200,
        legend: {position: 'bottom',
            textStyle: {color: '#383838', fontSize: 10, fontFamily: 'Century Gothic',}},
        titleTextStyle:{
            color: '#383838',
            bold: true,
            fontSize: 12,
        }
    };
    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
}


