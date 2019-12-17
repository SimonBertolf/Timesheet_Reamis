<?php
require_once '../system/system_user.php';
require_once '../class/navigation.php';
if ($_SESSION['user_typ'] == 'admin'){
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
        <div class="button_03_slider" id='3' >Add New User</div>
            <div class="div_slider" id="4">
                <form method="post" class="div_flex_colum">
                    <input class="input_01" id="navigation" type="text" name="username" placeholder="Username" required>
                    <input class="input_01" id="navigation" type="text" name="password" placeholder="Password" required>
                    <input class="input_01" id="navigation" type="text" name="fullname" placeholder="Full Name" required>
                    <input class="input_01" id="navigation" type="number" name="quote" placeholder="Quote" required>
                    <select class="button_01" id="navigation" name="typ" required>
                        <option>standard</option>
                        <option>controller</option>
                        <option>admin</option>
                    </select>
                    <select class="button_01" id="navigation" name="status" required>
                        <option>active</option>
                        <option>passive</option>
                    </select>
                    <button class="input_01" id="navigation" name="add">Add</button>
                </form>
            </div>
        <div class="div_flex_row">
                <form method="get" class="div_left">
                <?php
                while ($usr = $user->fetch_assoc()){
                    echo '<button class="button_01" id="button_project" name="user" value="'.$usr['name'].'">'.$usr['name'].'</button>';
                }
                ?>
                </form>
            <div class="div_right" id="left">
                <?php
                echo '<p class="font_01">'.$user_name.'</p>';
                echo '<p class="font_03">Username: '.$user_username.'</p>';
                echo '<p class="font_03">Daily Qupte: '.$user_quote.'</p>';
                echo '<p class="font_03">Usertyp: '.$user_typ.'</p>';
                echo '<p class="font_03">Userstatus: '.$user_status.'</p>';

                echo '<form method="post" class="div_flex_colum"><button class="button_01" id="button_project" name="status">Status</button>';
                echo '<button class="button_01" id="button_project" name="delete">Delete</button></form>';
                ?>
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
