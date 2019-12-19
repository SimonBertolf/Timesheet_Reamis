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
$query_time = pick_time($_GET['projectname'],$_SESSION['user_id']);


if(isset($_POST['ferientag'])){
    ferien($_SESSION['user_id'], $_POST['date_full'], $_SESSION['user_quote'] );
}

if(isset($_POST['feiertag'])){
    feiertag($_SESSION['user_id'], $_POST['date_full'], $_SESSION['user_quote'] );
}

if(isset($_POST['krank'])){
    krank($_SESSION['user_id'], $_POST['date_full'], $_SESSION['user_quote'] );
}
