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

function pick_one_user($username){
    $db = new class_database();
    $query_one_user = $db->mysql->query("SELECT * FROM user LEFT JOIN time ON time.userid = user.id WHERE user.name = '$username'");
    $db->close_connection();
    return $query_one_user;
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

function authorization($project_name, $user_id)
{
    $db = new class_database();
    $query_authorization = $db->mysql->query("SELECT * FROM authorization LEFT JOIN  project ON project.id = authorization.projectid WHERE projectname = '$project_name' AND authorization.userid = '$user_id'")->fetch_assoc();
    $db->close_connection();
    return $query_authorization;
}

function make_authorization($query_authorization,$project_name, $user_id){
    $db = new class_database();
    if (isset($query_authorization)){
        $project_id = $db->mysql->query("SELECT id FROM project WHERE projectname = '$project_name'")->fetch_assoc();
        $db->mysql->query("DELETE FROM authorization WHERE userid = $user_id AND projectid = '".$project_id['id']."'");
    }
    else{
       $project_id = $db->mysql->query("SELECT id FROM project WHERE projectname = '$project_name'")->fetch_assoc();
        $db->mysql->query("INSERT INTO authorization (projectid,userid) VALUES ('".$project_id['id']."','$user_id')");
    }
    $db->close_connection();
}

function insert_user($username,$password,$name,$quote,$typ,$status){
    $db = new class_database();
    $db->mysql->query("INSERT INTO user (username, password, name, quote, typ ,status) VALUES('$username','$password','$name','$quote','$typ','$status')");
    $db->close_connection();
}

function set_status($user_name){
    $db = new class_database();
    $status_change = $db->mysql->query("SELECT * FROM user WHERE name = '$user_name'")->fetch_assoc();
    if ($status_change['status'] == 'active'){
        $db->mysql->query("UPDATE user SET status = 'passive' WHERE name = '$user_name'");
        echo 111;
    }
    else{
        $db->mysql->query("UPDATE user SET status = 'active' WHERE name = '$user_name'");
    }
    $db->close_connection();
}

function report_time($projectid,$userid){
    $db = new class_database();
    $query_report_time = $db->mysql->query("SELECT * FROM time WHERE projectid = '$projectid' AND userid = '$userid'");
    $db->close_connection();
    return $query_report_time;
}
