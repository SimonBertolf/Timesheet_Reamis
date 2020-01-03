<?php
require_once '../system/system_report.php';
require_once '../class/navigation.php';

if ($_SESSION['user_typ'] == 'controller' || $_SESSION['user_typ'] == 'admin'){
?>
<html>
<head>
    <link href="../CSS/timesheet_font.css" rel="stylesheet" type="text/css">
    <link href="../CSS/timesheet_style.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../CSS/java.js"></script>
    <title>TimeSheet</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', '<?php echo($project['projectname']);?>'],
                <?php
                foreach ($time_user as $innername => $innerdata){
                    echo("['".$innername."', ".$innerdata."],");
                }
                ?>
            ]);
            var options = {
                'title': '<?php echo($project['projectname']);?>',
                colors: ['#383838','#8D8D8D','#D8D8D8','#3D3D3D','#383838'],
                'backgroundColor': 'transparent',
                'borderColor': 'black',
                'width': 150, 'height': 150,
                chartArea:{left:0,top:50,width:'75%',height:'75%'},
                legend: {position: 'bottom', textStyle: {color: '383838', fontSize: 10}},
                pieHole: 0.6,
                pieSliceBorderColor: 'transparent',
                titleTextStyle:{
                    color: '383838',
                    bold: true,
                    fontSize: 16,
                }
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart<?php echo $project['projectname']; ?>'));
            chart.draw(data, options);
        }
    </script>

</head>
<body id="start">
    <div class="div_flex_colum" id="start">
        <div>
            <img id="image_main" src="../image/fimesheet_font.svg" >
        </div>
        <div class="button_02_slider" id='1' >Menue</div>
        <div class="div_slider" id="2">
            <form method="post" class="div_flex_colum">
                <?php
                navigation($_SESSION['user_typ']);
                ?>
            </form>
        </div>
        <!--     Content       -->
        <div class="div_flex_row">

            <div class="div_left" id="left" style="margin-left: 10px; margin-top: 0px">
                <div style="margin-left: 30px">
                    <p class="font_01">Projekte</p>
                    <p class="font_03">Eine Übersicht über Projekte und ihre Budgets</p>
                </div>
                <form method="get" style="margin-left: 20px">
                    <select class="button_01" id="button_project" name="projects" onchange="this.form.submit();" style="margin-top: -5px">
                        <option></option>
                    <?php
                    while($projects = $all_Projects->fetch_assoc()){
                        echo '<option>'.$projects['projectname'].'</option>';
                    }
                    ?>
                    </select>
                    <div class="div_flex_colum" id="piechart<?php echo $project['projectname']; ?>"></div>
                    <p class="font_03" style="margin-top: 5px">Soll:   <?php echo $soll; ?> </p>
                    <p class="font_03" style="margin-top: -10px">Ist:    <?php echo $ist; ?> </p>
                    <p class="font_03" style="margin-top: -10px"><?php echo $stunden; ?> </p>
                    <button class="button_01" id="button_project" name="export_project" value="<?php echo $project['projectname']; ?>" style="margin-top: -10px">Export</button>
                </form>
            </div>

            <form method="post" class="div_right">
                <p class="font_01">Monatsübersicht</p>
                <p class="font_03">Die Stundenübersicht über 1 Monat</p>
                <div>
                <select name="username" class="button_01" id="button_project" >
                    <?php
                    while ($res = $all_user->fetch_assoc()){
                        echo '<option>'.$res['username'].'</option>';
                    }
                    ?>
                </select>
                </div>
                <div>
                <select name="monat" class="button_01" id="button_project">
                    <?php
                    foreach ($monates as $item => $d){
                        echo '<option>'.$item.'</option>';
                    }
                    ?>
                </select>
                </div>
                 <div>
                <button name="export_monat" class="button_01" id="button_project">Export</button>
                </div>
            </form>
        </div>
    </div>
</body>

<footer>
    <p class="font_footer"> Angemeldet als: <?php  echo $_SESSION['user_name']; ?></p>
</footer>

</html>
<?php
}else{
    header('Location:../page/page_login.php');
}
?>
