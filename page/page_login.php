<?php
require_once '../system/system_login.php';
require_once '../class/navigation.php';
?>
<html>
    <head>
        <link href="../CSS/timesheet_font.css" rel="stylesheet" type="text/css">
        <link href="../CSS/timesheet_style.css" rel="stylesheet" type="text/css">
        <title>TimeSheet</title>
    </head>
    <body id="around">
        <div>
            <div>
                <img id="image_login" src="../image/timesheet_login_logo.svg">
            </div>
            <div>
                <form method="post" class="div_flex_colum">
                    <input class="input_01" id="login" type="text" name="username" placeholder="Username" required>
                    <input class="input_01" id="login" type="password" name="password" placeholder="Password" required>
                    <button class="button_01" id="login" name="login">Login</button>
                    <p class="font_error"><?php if (isset($errorMessage)){ echo$errorMessage;}?></p>
                </form>
            </div>
        </div>
    </body>
    <footer>
    </footer>
</html>
