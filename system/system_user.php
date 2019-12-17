<?php
require_once '../class/class_database.php';
require_once '../class/class_time.php';
require_once '../class/functions.php';
session_start();

// user holen
$user = pick_all_user();

//user hinzufügen
if (isset( $_POST['add'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $name = $_POST['fullname'];
    $quote = $_POST['quote'];
    $typ = $_POST['typ'];
    $status = $_POST['status'];
    insert_user($username,$password,$name,$quote,$typ,$status);
}

//abfrage welcher user

if (isset($_GET['user'])) {
    $query_one_user = pick_one_user($_GET['user'])->fetch_assoc();
    $user_name = $query_one_user['name'];
    $user_username = $query_one_user['username'];
    $user_quote = $query_one_user['quote'];
    $user_typ = $query_one_user['typ'];
    $user_status = $query_one_user['status'];
}

// Setze status
if (isset($_POST['status'])){
    set_status($user_name);
    header('Location:page_user.php?user='.$user_name);
}
