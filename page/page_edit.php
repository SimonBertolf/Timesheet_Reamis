<?php
require_once '../system/system_edit.php';
require_once '../system/system_recording.php';
require_once '../class/navigation.php';
if ($_SESSION['user_typ'] == 'standard' || $_SESSION['user_typ'] == 'controller'|| $_SESSION['user_typ'] == 'admin'){
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
        <div class="button_02_slider" id='1'>Menue</div>
        <div class="div_slider" id="2">
            <form method="post" class="div_flex_colum">
                <?php
                navigation($_SESSION['user_typ']);
                ?>
            </form>
        </div>
        <!--     Content       -->
        <div class="button_03_slider" id='3' >Time Recording</div>
        <div class="div_slider" id="4">
            <form method="post" class="div_flex_colum">
                <input class="input_01" id="navigation" type="date" name="date" required>
                <input class="input_01" id="navigation" type="time" name="start" required>
                <input class="input_01" id="navigation" type="time" name="stop" required>
                <select class="input_01" id="navigation" name="projectname" required>
                    <?php
                    while ($res = $query_project->fetch_assoc()) {
                        echo '<option>' . $res['projectname'] . '</option>';
                    }
                    ?>
                </select>
                <input class="input_01" id="navigation" type="text" name="description" placeholder="Description" required>
                <button class="button_01" id="navigation" name="save">Save</button>
            </form>
        </div>
        <div class="button_03_slider" id='5' >Full Days</div>
        <div class="div_slider" id="6">
            <form method="post">
                <input class="input_01" id="navigation" type="date" name="date_full" required>
                <button class="button_01" id="navigation" name="ferientag">Ferientag</button>
                <button class="button_01" id="navigation" name="feiertag">Feiertag</button>
                <button class="button_01" id="navigation" name="krank">Krankheit</button>
            </form>
        </div>
        <div>
            <form method="get" class="div_flex_colum">
                <select class="input_01" id="navigation_J" name="projectname" onchange="this.form.submit();">
                    <?php
                    echo '<option>'.$_GET['projectname'].'</option>';

                    while ($res = $query_project1->fetch_assoc()) {
                        echo '<option value="' . $res['projectname'] . '">' . $res['projectname'] . '</option>';
                    }
                    ?>
                </select>
<!--                <button class="button_01" id="navigation" name="seach">Seach</button>-->
            </form>
        </div>
        <div class="div_table">
            <table>
            <tr><th>Datum</th><th>Zeit</th><th>Beschreibung</th><th>Löschen</th></tr>
            <?php
            while ($res = $query_time->fetch_assoc()) {
                $r = new DateTime ($res['date']);
                echo '<tr>';
                echo '<td>' . $r->format('j.n') . '</td>';
                echo '<td>' . $res['time'] . '</td>';
                echo '<td>' . $res['task'] . '</td>';
                echo '<td><form method="post" action="page_edit.php?projectname='.$_GET['projectname'].'"><button class="button_delete" name="delete" value="'.$res['id'].'">X</button></form></td>';
                echo '</tr>';
            }
            ?>
            </table>
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
