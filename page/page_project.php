<?php
require_once '../system/system_project.php';

if ($_SESSION['user_typ'] == 'controller' || $_SESSION['user_typ'] == 'admin'){
    ?>
    <html>
    <head>
        <link href="../CSS/timesheet_font.css" rel="stylesheet" type="text/css">
        <link href="../CSS/timesheet_style.css" rel="stylesheet" type="text/css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#1").click(function(){
                    $("#2").slideToggle("slow");
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#3").click(function(){
                    $("#4").slideToggle("fast");
                });
            });
        </script>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['user', 'zeit'],
                    ['t', 10],
                    ['t2', 20],
                    ['t6', 50],

                ]);
                var options = {
                    'title': '<?php echo($_POST['project']);?>',
                    colors: ['#909090','#404545','#1B1D1F'],
                    'backgroundColor': 'transparent',
                    'borderColor': '#383838',
                    'width': 150, 'height': 150,
                    chartArea:{left:10,top:10,width:'100%',height:'100%'},
                    legend: {position: 'bottom', textStyle: {color: '#AC2D2D', fontSize: 12}},
                    pieHole: 0.6,
                    pieSliceBorderColor: undefined,
                    titleTextStyle:{
                        color: '#383838',
                        bold: true,
                        fontSize: 12,
                    }
                };
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
        </script>


        <title>TimeSheet</title>
    </head>

    <body id="start">
    <div class="div_flex_colum" id="start">
        <div>
            <img id="image_main" src="../image/fimesheet_font.svg" >
        </div>
        <div class="button_02_slider" id='1' >Menue</div>
        <div class="div_slider" id="2">
            <form method="post" class="div_flex_colum">
                <button class="button_01" id="navigation" name="record">Time Recording</button>
                <button class="button_01" id="navigation" name="edit">Edit</button>
                <button class="button_01" id="navigation" name="report">Report</button>
                <button class="button_01" id="navigation" name="auto">Authorization</button>
                <button class="button_01" id="navigation" name="main">Mainpage</button>
                <button class="button_01" id="navigation" name="logout">Logout</button>
            </form>
        </div>
        <div class="button_03_slider" id='3' >Add new project</div>
        <div class="div_slider" id="4">
            <form method="post" class="div_flex_colum">
                <input class="input_01" id="navigation" type="text" name="projectname" placeholder="Projectname">
                <input class="input_01" id="navigation"  type="text" name="desription" placeholder="description">
                <input class="input_01" id="navigation"  type="number" name="budget" placeholder="Budget">
                <button class="button_01" id="navigation" name="add" >Add</button>
            </form>
        </div>
        <div class="div_flex_row">
            <div class="div_left">
                <form method="post" class="div_flex_colum">
                <?php
                while ($res = $query->fetch_assoc()){
                    echo ('<button class="button_01" id="button_project" name="project" value='.$res['projectname'].'>'.$res['projectname'].'</button>');
                }
                ?>
                </form>
            </div>
            <div class="div_right" >
                <?php
                if (isset($_POST['project'])) {
                    echo '<p class="font_01">'.$_POST['project'].'<p>';
                ?>
                    <p>projecktbeschreibung </p>
                <div class="toggle text">
                <label>
                    <input type="checkbox"> <span class="slider"></span>
                </label>
                </div>
                         <?php
                        // echo '<div id="piechart">';
                        ?>
                        <form method="post">
                            <button class="button_01" id="button_project" type="submit" name="delete">Delete</button>
                        </form>
                        <div>
                        </div>
                        <?php
                        if (isset($_POST['delete'])){
                            $project = $_POST['project'];
                            delet_project($project);
                        }
                    }
                ?>
            </div>
                </div>
            </div>

        </div>
    </div>
    </body>

    <footer>
        <p class="font_footer"> Angemeldet als: <?php  echo $_SESSION['user_name']; ?>  </p>
    </footer>

    </html>
    <?php

}
else{
    header('Location:../page/page_login.php');
}
?>
