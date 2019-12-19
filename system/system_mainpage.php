<?php
require_once '../class/class_database.php';
require_once '../class/class_time.php';
require_once '../class/functions.php';
require_once '../export/export_time_user.php';
date_default_timezone_set("Europe/Berlin");
session_start();
$today = time();
$datum = date("Y.m.d",$today);
$monates = array('Januar' => '01', 'Februar' => '02', 'März' => '03', 'April' => '04', 'Mai' => '05', 'Juni' => '06', 'Juli' => '07', 'August' => '08', 'September' => '09', 'Oktober' => '10', 'November' => '11', 'Dezember' => '12');

/// projekte abfragen
$query_project = pick_project($_SESSION['user_id']);

if (isset($_POST['save'])){
    today_time_drawing($_SESSION['user_id'],$datum,$_POST['description'],$_POST['projectname']);
}
