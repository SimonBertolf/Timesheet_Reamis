<?php
session_start();
//standard
if (isset($_POST['logout'])){
    header('Location: ../page/page_login.php');
}
if (isset($_POST['main'])){
    header('Location: ../page/page_mainpage.php');
}
if (isset($_POST['record'])){
    header('Location: ../page/page_recording.php');
}
if (isset($_POST['edit'])){
    header('Location: ../page/page_edit.php');
}

//Controler
if (isset($_POST['project'])){
    header('Location: ../page/page_project.php');
}
if (isset($_POST['auto'])){
    header('Location: ../page/page_authorization.php');
}
if (isset($_POST['report'])){
    header('Location: ../page/page_report.php');
}


