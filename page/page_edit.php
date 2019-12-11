<?php
require_once '../system/system_edit.php';
require_once '../class/navigation.php';
if ($_SESSION['user_typ'] == 'standard' || $_SESSION['user_typ'] == 'controller'|| $_SESSION['user_typ'] == 'admin'){
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
            <button class="button_01" id="navigation" name="main">Mainpage</button>
            <button class="button_01" id="navigation" name="record">Time Record</button>
            <button class="button_01" id="navigation" name="project">Project</button>
            <button class="button_01" id="navigation" name="report">Report</button>
            <button class="button_01" id="navigation" name="logout">Logout</button>
        </form>
    </div>
    <div>
        <form method="post" class="div_flex_colum">
            <select class="input_01" id="navigation" name="projectname">
                <?php
                while ($res = $query_project->fetch_assoc()){
                    echo'<option>'.$res['projectname'].'</option>';
                }
                ?>
            </select>
            <button class="button_01" id="navigation" name="seach">Seach</button>
        </form>
    </div>
    <div class="div_table">
        <table>
            <tr><th>ID</th><th>Datum</th><th>Zeit</th><th>Beschreibung</th></tr>
        <?php
        while ($res = $query_time->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $res['id'] . '</td>';
            echo '<td>' . $res['date'] . '</td>';
            echo '<td>' . $res['time'] . '</td>';
            echo '<td>' . $res['task'] . '</td>';
            echo '</tr>';
        }
        ?></table>
    </div>
    <div>
        <form method="post" class="div_flex_colum">
            <input class="input_01" id="navigation" type="number" name="timeid" placeholder="ID">
            <button class="button_01" id="navigation" name="delete">Delete</button>
        </form>
    </div>
</div>
</body>

<footer>
    <p class="font_footer"> Angemeldet als: <?php  echo $_SESSION['user_name']; ?>  </p>
</footer>

</html>
    <?php
}else{
    header('Location:../page/page_login.php');
}
