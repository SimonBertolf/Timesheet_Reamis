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


function pick_time($projectname){
    $db = new class_database();
    $query_time = $db->mysql->query("SELECT time.id, time.time, task FROM time LEFT JOIN project ON project.id = time.projectid WHERE projectname = '$projectname'");
    $db->close_connection();
    return $query_time;
}

function delet_time($id){
    $db = new class_database();
    $db->mysql->query("DELETE FROM time WHERE id = $id");
    $db->close_connection();
}
