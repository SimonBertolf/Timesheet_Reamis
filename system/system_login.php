<?php

require_once('../class/Class_database.php');
session_start();

if (isset($_POST['login']))
{

    $db = new class_database();

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $user = $db->mysql->query("SELECT * FROM user WHERE username = '$username'");
    $res = $user->fetch_assoc();
var_dump($res['password']);
    if ($res !== false && $res !== null && $res['password'] == $password) {
        $_SESSION['user_typ'] = $res['typ'];
        $_SESSION['user_id'] = $res['userId'];
        $_SESSION['user_name'] = $res['name'];
        $_SESSION['user_quote'] = $res['quote'];
        $_SESSION['user_status'] = $res['status'];
        $_SESSION['user_username'] = $res['username'];
        header('Location: ../page/page_mainpage.php');
    } else {
        $errorMessage = " E-Mail oder Passwort ist Ungültig !!";
    }
    $db->close_connection();
}

