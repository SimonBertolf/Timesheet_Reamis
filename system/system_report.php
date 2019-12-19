<?php
require_once '../class/class_database.php';
require_once '../class/class_time.php';
require_once '../class/functions.php';
require_once '../export/export_project.php';
session_start();
$time_user = array();
$monates = array('Januar' => '01', 'Februar' => '02', 'März' => '03', 'April' => '04', 'Mai' => '05', 'Juni' => '06', 'Juli' => '07', 'August' => '08', 'September' => '09', 'Oktober' => '10', 'November' => '11', 'Dezember' => '12');
$all_user = pick_all_user();
$all_Projects = pick_all_project();
$soll ='';
$ist ='';

if(isset($_GET['projects'])) {
    $project = pick_one_project($_GET['projects']);
    $soll = $project['budget'];
    $user = pick_all_user();
    while ($res = $user->fetch_assoc()) {
        $query_char_data = char_data($_GET['projects'], $res['name']);
        while ($res = $query_char_data->fetch_assoc()) {
            $time_user[$res['name']] += $res['time'];
            $ist += $res['time'];
        }
    }
}
if($_GET['projects'] == 'Ferien' ||$_GET['projects'] == 'Krankheit' ||$_GET['projects'] == 'Feiertage'){
    $stunden ='';
}else{
    $stunden = differenz($soll,$ist);
}




