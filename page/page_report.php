<?php
require_once '../system/system_report.php';
require_once '../class/navigation.php';
require_once '../export/export_time.php';

if ($_SESSION['user_typ'] == 'controller' || $_SESSION['user_typ'] == 'admin'){
?>
<html>
<head>
    <link href="../CSS/timesheet_font.css" rel="stylesheet" type="text/css">
    <link href="../CSS/timesheet_style.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../CSS/java.js"></script>
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
        <div class="div_flex_row">
            <form method="get" class="div_left">
                <button name="project_report">Projekte</button>
            </form>

            <form method="post" class="div_right">
                <?php
                ?>
                <p class="font_01">Monatsübersicht</p>
                <p class="font_03">Die Stundenübersicht über 1 Monat</p>
                <div>
                <select name="username" class="button_01" id="navigation" >
                    <?php
                    while ($res = $all_user->fetch_assoc()){
                        echo '<option>'.$res['username'].'</option>';
                    }
                    ?>
                </select>
                </div>
                <div>
                <select name="monat" class="button_01" id="navigation">
                    <?php
                    foreach ($monates as $item => $d){
                        echo '<option>'.$item.'</option>';
                    }
                    ?>
                </select>
                </div>
                 <div>
                <button name="export_monat" class="button_01" id="navigation">Export</button>
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
