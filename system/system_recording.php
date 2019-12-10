<?php
require_once '../class/class_database.php';
require_once '../class/class_time.php';
require_once '../class/functions.php';

session_start();
///Navigator
if (isset($_POST['logout'])){
header('Location: ../page/page_login.php');
}
if (isset($_POST['edit'])){
    header('Location: ../page/page_edit.php');
}
if (isset($_POST['main'])){
    header('Location: ../page/page_mainpage.php');
}

/// projekte abfragen
$query_project = pick_project($_SESSION['user_id']);

/// Einschreiben
if (isset($_POST['save'])) {
    time_drawing($_SESSION['user_id'], $_POST['date'], $_POST['description'],$_POST['start'],$_POST['stop']);
}
