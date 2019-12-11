<?php
session_start();

//standard
if (isset($_POST['logout'])){
    header('Location: ../page/page_login.php');
}
if (isset($_POST['main'])){
    header('Location: ../page/page_mainpage.php');
}
if (isset($_POST['record'])){
    header('Location: ../page/page_recording.php');
}
if (isset($_POST['edit'])){
    header('Location: ../page/page_edit.php');
}

//Controller
if (isset($_POST['project'])){
    header('Location: ../page/page_project.php');
}
if (isset($_POST['auto'])){
    header('Location: ../page/page_authorization.php');
}
if (isset($_POST['report'])){
    header('Location: ../page/page_report.php');
}

//Admin



function navigation($usertyp){
// Navigations-Buttons ausgeben
    if ($usertyp == 'standard'){
        echo('
        <button class="button_01" id="navigation" name="record">Time Recording</button>
        <button class="button_01" id="navigation" name="edit">Edit</button>
        <button class="button_01" id="navigation" name="main">Mainpage</button>
        <button class="button_01" id="navigation" name="logout">Logout</button>
        ');
    }
    elseif ($usertyp == 'controller'){
        echo('
        <button class="button_01" id="navigation" name="record">Time Recording</button>
        <button class="button_01" id="navigation" name="edit">Edit</button>
        <button class="button_01" id="navigation" name="project">Project</button>
        <button class="button_01" id="navigation" name="auto">Authorization</button>
        <button class="button_01" id="navigation" name="report">Report</button>
        <button class="button_01" id="navigation" name="main">Mainpage</button>
        <button class="button_01" id="navigation" name="logout">Logout</button>
        ');
    }
    elseif ($usertyp == 'admin'){
        echo('
        <button class="button_01" id="navigation" name="record">Time Recording</button>
        <button class="button_01" id="navigation" name="edit">Edit</button>
        <button class="button_01" id="navigation" name="project">Project</button>
        <button class="button_01" id="navigation" name="auto">Authorization</button>
        <button class="button_01" id="navigation" name="report">Report</button>
        <button class="button_01" id="navigation" name="main">Mainpage</button>
        <button class="button_01" id="navigation" name="logout">Logout</button>
        ');
    }
}
