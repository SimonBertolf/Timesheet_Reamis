<?php
require_once '../class/class_database.php';
require_once '../class/class_time.php';
require_once '../class/functions.php';
session_start();

/// projekte abfragen
$query_project = pick_project($_SESSION['user_id']);

/// Einschreiben
if (isset($_POST['save'])) {
    time_drawing($_SESSION['user_id'], $_POST['date'], $_POST['description'],$_POST['projectname']);
    $error_message = 'Zeit erfolgreich Gespeichert.';
}
