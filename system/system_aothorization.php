<?php
require_once '../class/class_database.php';
require_once '../class/class_time.php';
require_once '../class/functions.php';
session_start();

$query = pick_all_project();
$query_all_user = pick_all_user();

if (isset($_POST['ident'])) {
 $userid = $_POST['ident'];
}

