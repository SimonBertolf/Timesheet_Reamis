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
if (isset($_POST['record'])){
    header('Location: ../page/page_recording.php');
}
