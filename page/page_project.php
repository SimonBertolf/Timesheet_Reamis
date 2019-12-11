<?php
require_once '../system/system_project.php';
require_once '../class/navigation.php';

if ($_SESSION['user_typ'] == 'controller' || $_SESSION['user_typ'] == 'admin'){
?>
<html>
<head>
    <link href="../CSS/timesheet_font.css" rel="stylesheet" type="text/css">
    <link href="../CSS/timesheet_style.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="../CSS/java.js"></script>
    <title>TimeSheet</title>
</head>
<body id="start">
    <div class="div_flex_colum" id="start">
        <div>
            <img id="image_main" src="../image/fimesheet_font.svg" >
        </div>
        <div class="button_02_slider" id='1' >Menue</div>
        <div class="div_slider" id="2">
            <form method="post" class="div_flex_colum">
                <?php
                navigation($_SESSION['user_typ']);
                ?>
            </form>
        </div>
        <!--     Content       -->
        <div class="button_03_slider" id='3' >Add new project</div>
        <div class="div_slider" id="4">
            <form method="post" class="div_flex_colum">
                <input class="input_01" id="navigation" type="text" name="projectname" placeholder="Projectname">
                <input class="input_01" id="navigation"  type="text" name="desription" placeholder="description">
                <input class="input_01" id="navigation"  type="number" name="budget" placeholder="Budget">
                <button class="button_01" id="navigation" name="add" >Add</button>
            </form>
        </div>
        <div class="div_flex_row">
            <div class="div_left">
                <form method="post" class="div_flex_colum">
                <?php
                while ($res = $query->fetch_assoc()){
                    echo ('<button class="button_01" id="button_project" name="project" value='.$res['projectname'].'>'.$res['projectname'].'</button>');
                }
                ?>
                </form>
            </div>
            <div class="div_right" >
                <div>
                 <?php
                 if (isset($_POST['project'])) {
                     echo '<p class="font_01">'.$project_name.'<p>';
                     echo '<p class="font_02">'.$project_description.'<p>';
                     echo '<p class="font_02">Projectnumber: '.$project_nr.'<p>';
                     echo '<p class="font_02">Timebudget: '.$project_budget.' Stunden<p>';
                 ?>
                 </div>
                <div id="columnchart_material"></div>
                     <form method="post" id="delete">
                         <button class="button_01" id="button_project" name="archive">Archive <?php echo $project_archive ?></button>
                     </form>
                 </div>
                 <?php
                 }
                 ?>
            </div>
        </div>
</body>

<footer>
     <p class="font_footer"> Angemeldet als: <?php  echo $_SESSION['user_name']; ?>  </p>
</footer>
</html>
<?php
} else{
    header('Location:../page/page_login.php');
}
?>
