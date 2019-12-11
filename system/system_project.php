<?php
require_once '../class/class_database.php';
require_once '../class/class_time.php';
require_once '../class/functions.php';
session_start();

$query = pick_all_project();
if (isset($_POST['add'])){
    add_project($_POST['projectname'],$_POST['description'],$_POST['budget']);
}

if (isset($_POST['project'])) {

    $db = new class_database();
    $projectname = $_POST['project'];
    $query_info = $db->mysql->query("SELECT * FROM project LEFT JOIN time ON time.projectid = project.id WHERE projectname = '$projectname'")->fetch_assoc();
    $_SESSION['projectname'] = $project_name = $query_info['projectname'];
    $project_description = $query_info['description'];
    $project_budget = $query_info['budget'];
    $project_archive = $query_info['archive'];
    $_SESSION['projectnr'] = $project_nr = $query_info['projectnr'];
    $db->close_connection();
}

$ist_time = chart_project($project_name);

if (isset($_POST['archive'])){
    $db = new class_database();
    $project_name = $_SESSION['projectname'];
    $query_archive = $db->mysql->query("SELECT * FROM project WHERE projectname = '$project_name'")->fetch_assoc();
    $archive = $query_archive['archive'];


    if ($archive == 'false') {
        $query_info = $db->mysql->query("UPDATE project SET archive = 'true' WHERE projectname = '$project_name'");

    }
    elseif ($archive == 'true') {
        $query_info = $db->mysql->query("UPDATE project SET archive = 'false' WHERE projectname = '$project_name'");

    }
    $db->close_connection();
}
