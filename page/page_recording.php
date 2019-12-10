<?php
require_once '../system/system_recording.php';
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
                <button class="button_01" id="navigation" name="edit">Edit</button>
                <button class="button_01" id="navigation" name="main">Mainpage</button>
                <button class="button_01" id="navigation" name="logout">Logout</button>
            </form>
        </div>
        <div>
            <form method="post" class="div_flex_colum">
                <input class="input_01" id="navigation" type="date" name="date">
                <input class="input_01" id="navigation" type="time" name="start">
                <input class="input_01" id="navigation" type="time" name="stop">
                <select class="input_01" id="navigation" name="projectname">
                    <?php
                    while ($res = $query_project->fetch_assoc()){
                        echo'<option>'.$res['projectname'].'</option>';
                    }
                    ?>
                </select>
                <input class="input_01" id="navigation" type="text" name="description" placeholder="Description">
                <button class="button_01" id="navigation" name="save">save</button>
            </form>

        </div>
    </div>
</body>

<footer>
    <p class="font_footer"> Angemeldet als: <?php  echo $_SESSION['user_name']; ?>  </p>
</footer>

</html>
