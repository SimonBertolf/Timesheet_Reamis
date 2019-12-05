<?php

/// Zeit reinschreiben
function time_drawing($userid, $date, $description)
{
    $db = new class_database();
    $t = new class_time();
    $project = $db->mysql->query("SELECT * FROM project WHERE projectname = '" . $_POST['projectname'] . "'")->fetch_assoc();
    $projectid = $project['id'];
    $time = $t->work_time($_POST['start'], $_POST['stop']);
    $db->mysql->query("INSERT INTO time (projectid, userid, date, time, description) VALUE ( '$projectid' , '$userid', '$date', '$time', '$description')");
    $db->close_connection();
}

///Projekte auslesen
function pick_project($userid){
    $db = new class_database();
    $query_project = $db->mysql->query("SELECT * FROM project LEFT JOIN authorization ON project.id = authorization.projectid WHERE archive = 'false' AND userid = '$userid'");
    $db->close_connection();
    return $query_project;
}
