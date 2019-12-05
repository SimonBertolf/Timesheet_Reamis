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
if (isset($_POST['delete'])){
    delet_time($_POST['timeid']);
}

$query_project = pick_project($_SESSION['user_id']);
$query_time = pick_time($_POST['projectname']);
