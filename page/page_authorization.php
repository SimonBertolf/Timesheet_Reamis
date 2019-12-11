<?php
require_once '../system/system_aothorization.php';

if ($_SESSION['user_typ'] == 'controller'){
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
                <button class="button_01" id="navigation" name="record">Time Recording</button>
                <button class="button_01" id="navigation" name="edit">Edit</button>
                <button class="button_01" id="navigation" name="project">Project</button>
                <button class="button_01" id="navigation" name="report">Report</button>
                <button class="button_01" id="navigation" name="logout">Logout</button>
            </form>
        </div>

        <div class="div_flex_row">
            <div class="div_left">
                <form method="post" class="div_flex_colum">
                    <?php
                    while ($res = $query->fetch_assoc()){
                        echo ('<button class="button_01" id="button_project" name="project_name" value='.$res['projectname'].'>'.$res['projectname'].'</button>');
                    }
                    ?>
                </form>
            </div>
            <div class="div_right" >
                <div class="div_flex_colum">
                    <p class="font_01">Authentifikation</p>
                    <?php
                    echo '<p class="font_04">Project: '.$_POST['project_name'].'</p>';

                    if (isset($_POST['project_name'])) {
                        while ($res_user = $query_all_user->fetch_assoc()){
                                $userid = $res_user['id'];
                                $query_project = pick_one_project($_POST['project_name']);
                                $projectid =  $query_project['id'];
                                $db = new class_database();
                                $query_authentifikation = $db->mysql->query("SELECT * from authorization WHERE userid = '$userid' and projectid ='$projectid' ")->fetch_assoc();
                            if ($query_authentifikation){
                                $authentifikation = 'Ja';
                            }
                            else{
                                $authentifikation = 'Nein';
                            }
                            echo '<form method="post" class="div_flex_row">
                                            <p class="font_03">'.$res_user['name'].' </p>
                                            <button class="button_01" id="button_auto" name="ident" value="'.$res_user['id'].'">'.$authentifikation.'</button>
                                  </form>';
                        }
                    ?>
                </div>
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

}
else{
    header('Location:../page/page_login.php');
}
?>
