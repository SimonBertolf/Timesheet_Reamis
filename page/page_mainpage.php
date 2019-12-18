<?php
require_once '../system/system_mainpage.php';
require_once '../class/navigation.php';
session_start();
if (isset($_SESSION['user_typ'])) {
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
            <img id="image_main" src="../image/fimesheet_font.svg">
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
        <div class="div_flex_row">
            <div class="div_left">
                <form method="post" class="div_flex_colum">
                    <?php
                    echo '<p class="font_01" id="center">Wilkommen '.$_SESSION['user_name'].'</p>';
                    echo '<p class="font_03" id="center">Dein username ist: '.$_SESSION['user_username'].'</p>';
                    echo '<p class="font_03" id="center">Dein Tagessoll beträgt '.$_SESSION['user_quote'].'</p>';
                    ?>
                    <select name="monat" class="button_01" id="button_project">
                        <?php
                        foreach ($monates as $item => $d){
                            echo '<option>'.$item.'</option>';
                        }
                        ?>
                    </select>
                    <button class="button_01" id="button_project" name="exp">Export</button>
                </form>
            </div>
            <div class="div_right">

            </div>
        </div>
    </div>
</body>
<footer>
        <p class="font_footer"> Angemeldet als: <?php echo $_SESSION['user_name']; ?></p>
</footer>

</html>
<?php
} else {
    header('Location:../page/page_login.php');
}
?>
