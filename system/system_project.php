<?php
require_once '../class/class_database.php';
require_once '../class/class_time.php';
require_once '../class/functions.php';
session_start();
///Navigator
if (isset($_POST['logout'])){
    header('Location: ../page/page_login.php');
}
if (isset($_POST['main'])){
    header('Location: ../page/page_mainpage.php');
}
if (isset($_POST['record'])){
    header('Location: ../page/page_recording.php');
}
if (isset($_POST['report'])){
    header('Location: ../page/page_report.php');
}

$query = pick_all_project();
if (isset($_POST['add'])){
    add_project($_POST['projectname'],$_POST['description'],$_POST['budget']);
}

