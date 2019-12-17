<?php
require_once '../class/class_database.php';
require_once '../class/class_time.php';
require_once '../class/functions.php';
session_start();

//Alle Projeckte holen
$query = pick_all_project();

//Alle user holen
$query_all_user = pick_all_user();

// Authenzifitation
if (isset($_GET['ident'])){
    $user_id = $_GET['ident'];
    $project_name = $_SESSION['project_name'];
    $query_authorization = authorization($project_name, $user_id);
    make_authorization($query_authorization,$project_name,$user_id);
}
