<?php
require_once '../class/class_database.php';
require_once '../class/class_time.php';
require_once '../class/functions.php';
session_start();

//variablen devinieren
$project = array();

// Prijekt Archivieren
if (isset($_POST['archive'])){
    $db = new class_database();
    $project_name = $_SESSION['name'];
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



//Projekt hinzufügen
if (isset($_POST['add'])){
    add_project($_POST['projectname'],$_POST['description'],$_POST['budget'],$_POST['projectnumber']);
    $error_message = 'Projekt erfolgreich Hinzugefügt.';
}

//Alle projekte holen
$query = pick_all_project();


if (isset($_GET['Test'])) {
    $db = new class_database();
    $projectname = $_GET['Test'];
    $query_info = $db->mysql->query("SELECT * FROM project LEFT JOIN time ON time.projectid = project.id WHERE projectname = '$projectname'")->fetch_assoc();
    $_SESSION['name'] = $project['projectname'] = $query_info['projectname'];
    $project['description'] = $query_info['description'];
    $soll_time = $project['budget'] = $query_info['budget'];
    $project['archive'] = $query_info['archive'];
    $project['nr'] = $query_info['projectnr'];
    $ist_time = chart_project($project['projectname']);
    $db->close_connection();
}

