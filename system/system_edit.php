<?php
require_once '../class/class_database.php';
require_once '../class/class_time.php';
require_once '../class/functions.php';
session_start();

//Zeit löschen
if (isset($_POST['entf'])) {
    delet_time($_POST['timeid']);
    $error_message = 'Zeit erfolgreich Gelöscht.';
}

/// projekte abfragen
$query_project1 = pick_project($_SESSION['user_id']);

//Zeit holen
$query_time = pick_time($_GET['projectname']);


