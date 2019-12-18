<?php
require_once '../class/class_database.php';
require_once '../class/class_time.php';
require_once '../class/functions.php';
session_start();

$monates = array('Januar' => '01', 'Februar' => '02', 'März' => '03', 'April' => '04', 'Mai' => '05', 'Juni' => '06', 'Juli' => '07', 'August' => '08', 'September' => '09', 'Oktober' => '10', 'November' => '11', 'Dezember' => '12');

$all_user = pick_all_user();
