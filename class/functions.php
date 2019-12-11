<?php

function time_drawing($userid, $date, $description)
{
    $db = new class_database();
    $t = new class_time();
    $project = $db->mysql->query("SELECT * FROM project WHERE projectname = '" . $_POST['projectname'] . "'")->fetch_assoc();
    $projectid = $project['id'];
    $start = $_POST['start'];
    $stop = $_POST['stop'];
    $time = $t->work_time($start, $stop);
    $db->mysql->query("INSERT INTO time (projectid, userid, date, time, task, start, stop) VALUE ( $projectid , $userid, '$date', '$time', '$description', '$start', '$stop')");
    $db->close_connection();
}

function pick_project($userid){
    $db = new class_database();
    $query_project = $db->mysql->query("SELECT * FROM project LEFT JOIN authorization ON project.id = authorization.projectid WHERE archive = 'false' AND userid = '$userid'");
    $db->close_connection();
    return $query_project;
}
function pick_all_user(){
    $db = new class_database();
    $query_all_user = $db->mysql->query("SELECT * FROM user");
    $db->close_connection();
    return $query_all_user;
}
function pick_all_project(){
    $db = new class_database();
    $query_all_project = $db->mysql->query("SELECT * FROM project");
    $db->close_connection();
    return $query_all_project;
}
function pick_one_project($projectname){
    $db = new class_database();
    $query_one_project = $db->mysql->query("SELECT * FROM project WHERE projectname = '$projectname'")->fetch_assoc();
    $db->close_connection();
    return $query_one_project;
}

function pick_time($projectname){
    $db = new class_database();
    $query_time = $db->mysql->query("SELECT time.id, time.time, task, time.date FROM time LEFT JOIN project ON project.id = time.projectid WHERE projectname = '$projectname'");
    $db->close_connection();
    return $query_time;
}

function delet_time($id){
    $db = new class_database();
    $db->mysql->query("DELETE FROM time WHERE id = $id");
    $db->close_connection();
}
function add_project($projectname, $description, $budget){
    $db = new class_database();
    $db->mysql->query("INSERT INTO project (projectname, description, budget) VALUE ('$projectname','$description','$budget')");
    $db->close_connection();
}

function chart_project($projectname){
    $total_time = 0;
    $db = new class_database();
    $query_project_chart = $db->mysql->query("SELECT * from time LEFT JOIN project ON project.id = time.projectid WHERE projectname = '$projectname' ");
    $db->close_connection();
        while ($res = $query_project_chart->fetch_assoc()){
            $total_time += $res['time'];
        }
    return $total_time;
}
