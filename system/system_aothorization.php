<?php
require_once '../class/class_database.php';
require_once '../class/class_time.php';
require_once '../class/functions.php';
session_start();

//Alle Projeckte holen
$query = pick_all_project();

//Alle user holen
$query_all_user = pick_all_user();
