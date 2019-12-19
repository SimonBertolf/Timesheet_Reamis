<?php
require_once '../system/system_project.php';
require_once '../class/navigation.php';
if ($_SESSION['user_typ'] == 'controller' || $_SESSION['user_typ'] == 'admin'){
    ?>
    <html>
    <head>
        <link href="../CSS/timesheet_font.css" rel="stylesheet" type="text/css">
        <link href="../CSS/timesheet_style.css" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="../CSS/java.js"></script>
        <script type="text/javascript">
            //Barchart
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    [' ','Soll', 'Ist',],
                    <?php
                    echo("['Soll/Ist',".$soll_time.", ".$ist_time."],");
                    ?>
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
                <?php
                navigation($_SESSION['user_typ']);
                ?>
            </form>
        </div>
        <!--     Content       -->
        <div class="button_03_slider" id='3' >Add new project</div>
        <div class="div_slider" id="4">
            <form method="post" class="div_flex_colum">
                <input class="input_01" id="navigation" type="text" name="projectname" placeholder="Projectname" required>
                <input class="input_01" id="navigation"  type="text" name="projectnumber" placeholder="Projectnumber" required>
                <input class="input_01" id="navigation"  type="text" name="description" placeholder="Description" required>
                <input class="input_01" id="navigation"  type="number" name="budget" placeholder="Budget" required>
                <button class="button_01" id="navigation" name="add" >Add</button>
            </form>
        </div>
        <p class="font_error"> <?php if (isset($_POST['add'])){echo $error_message;} ?></p>
        <div class="div_flex_row">
            <div class="div_left">
                <form method="get" class="div_flex_colum">
                    <?php
                    while ($res = $query->fetch_assoc()){
                        echo ('<button class="button_01" id="button_project" name="Test" value='.$res['projectname'].'>'.$res['projectname'].'</button>');
                    }
                    ?>
                </form>
            </div>
            <div class="div_right" >
                <div>
                    <?php
                    if (isset($_GET['Test'])) {
                    echo '<p class="font_01">'.$project['projectname'].'<p>';
                    echo '<p class="font_02">'.$project['description'].'<p>';
                    echo '<p class="font_02">Projectnumber: '.$project['nr'].'<p>';
                    echo '<p class="font_02">Timebudget: '.$project['budget'].' Stunden<p>';
                    ?>
                </div>
                <div id="columnchart_material"></div>
                <form method="post" id="delete">
                    <button class="button_01" id="button_project" name="archive">Archive <?php echo $project['archive'] ?></button>
                </form>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    </body>

    <footer>
        <p class="font_footer"> Angemeldet als: <?php  echo $_SESSION['user_name']; ?>  </p>
    </footer>
    </html>
    <?php
} else{
    header('Location:../page/page_login.php');
}
?>
