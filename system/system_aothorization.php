<?php
require_once '../class/class_database.php';
require_once '../class/class_time.php';
require_once '../class/functions.php';
session_start();

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
if (isset($_POST['project'])){
    header('Location: ../page/page_project.php');
}

$query = pick_all_project();
$query_all_user = pick_all_user();




if (isset($_POST['ident'])) {
 $userid = $_POST['ident'];
}

