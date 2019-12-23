<?php
#region/// ----- include ----- ///
session_start();
require_once '../class/class_database.php';
require_once '../vendor/autoload.php';
setlocale(LC_TIME, "de_DE.utf8");
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
#endregion

if(isset($_POST['exp'])){

#region/// ----- Variablen ----- ///
    $monate = array('01' => 'Januar', '02' => 'Februar', '03' => 'März', '04' => 'April', '05' => 'Mai', '06' => 'Juni', '07' => 'Juli', '08' => 'August', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Dezember');
    $monates = array('Januar' => '01', 'Februar' => '02', 'März' => '03', 'April' => '04', 'Mai' => '05', 'Juni' => '06', 'Juli' => '07', 'August' => '08', 'September' => '09', 'Oktober' => '10', 'November' => '11', 'Dezember' => '12');
    $woche = array('', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag');
    $monat = $monates[$_POST['monat']];
    $name = $_SESSION['user_username'];
    $jahr = 2019;
    $row = 9;
    $savedata = 'g';
    $savetime = 0;
    $savetimeFerien = 0;
    $savetimeKrankheit = 0;
    $savetimeFeiertage = 0;


#endregion

#region/// ----- Functionen ----- ///
    function AbfrageAll($name, $monat)
    {
        $db = new class_database();
        $comm = ('SELECT * FROM time LEFT JOIN user ON time.userid = user.id LEFT JOIN project ON time.projectid = project.id  WHERE user.username = "'.$name.'" and date LIKE "%-' . $monat . '-%"  AND NOT project.projectname = "Feiertage" AND NOT project.projectname = "Ferien" AND NOT project.projectname = "Krankheit" ORDER BY date ');
        $rows = array();
        $query = $db->mysql->query($comm);
        while ($res = $query->fetch_assoc()) {
            $rows[] = $res;
        }
        return $rows;
    }
    function StartDatum($jahr, $monat)
    {
        $startdate = new DateTime($jahr.'-'.$monat.'-01');
        $startdate->modify('first day of this month');
        $startdate->modify('last monday');
        $enddate = new DateTime($jahr.'-'.$monat.'-01');
        $enddate->modify('last day of this month');
        $enddate->modify('next monday');
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($startdate, $interval, $enddate);
        return $daterange;
    }

    function AbfrageProjekte($name, $monat, $projekt)
    {
        $db = new class_database();
        $comm = ('SELECT * FROM time LEFT JOIN user ON time.userid = user.id LEFT JOIN project ON time.projectid = project.id  WHERE user.username = "'.$name.'" and date LIKE "%-' . $monat . '-%"  AND project.projectname = "'.$projekt.'" ORDER BY date ');
        $rows = array();
        $query = $db->mysql->query($comm);
        while ($res = $query->fetch_assoc()) {
            $rows[] = $res;
        }
        return $rows;
    }
    function userdaten ($name){
        $db = new class_database();
        $query = $db->mysql->query("SELECT * FROM user WHERE username = '$name'")->fetch_assoc();
        return $query;
    }

    $rows = AbfrageAll($name, $monat);
    $z = 0;
    $rowsFerien = AbfrageProjekte($name, $monat,'Ferien');
    $zFerien = 0;
    $rowsFeiertage = AbfrageProjekte($name, $monat,'Feiertage');
    $zFeiertage = 0;
    $rowsKrankheit = AbfrageProjekte($name, $monat,'Krankheit');
    $zKrankheit = 0;
    $daterange = StartDatum($jahr, $monat);
    $userdaten = userdaten($name);
    $soll = ($userdaten['quote']*20);
#endregion

    $spreadsheet = new Spreadsheet();
    $worksheet = $spreadsheet->getActiveSheet();

#region/// ----- Code Alle ----- ///

    foreach($daterange  as $date) {
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A' . $row . '', $woche[$date->format('N')]);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C' . $row . '', $date->format('Y-m-d'));
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('H' . $row . '', '=SUM(D' . $row . ':G' . $row . ')');

        while ($date->format('Y-m-d') == $rows[$z]['date']) {
            $total =($rows[$z]['time']);
            $savetime += $total;
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('D' . $row . '', $savetime);
            $z++;
        }
        while ($date->format('Y-m-d') == $rowsFerien[$zFerien]['date']) {
            $total =($rowsFerien[$zFerien]['time']);
            $savetimeFerien += $total;
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('G' . $row . '', $savetimeFerien);
            $zFerien++;
        }
        $savetimeFerien = 0;
        while ($date->format('Y-m-d') == $rowsFeiertage[$zFeiertage]['date']) {
            $total =($rowsFeiertage[$zFeiertage]['time']);
            $savetimeFeiertage += $total;
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('G' . $row . '', $savetimeFeiertage);
            $zFeiertage++;
        }
        $savetimeFeiertage = 0;
        while ($date->format('Y-m-d') == $rowsKrankheit[$zKrankheit]['date']) {
            $total =($rowsKrankheit[$zKrankheit]['time']);
            $savetimeKrankheit += $total;
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('G' . $row . '', $savetimeKrankheit);
            $zKrankheit++;
            $savetimeKrankheit = 0;
        }
        if ($date->format('N') == 7) {
            $row++;
            $summrow = $row;
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':J' . $row . '')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':I' . $row . '')->getFont()->setSize(13);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('I' . $row . '', '=sum(H' . ($summrow -= 1) . ':H' . ($summrow -= 6) . ')');
        }
        $savedata = 'h';
        $savetime = 'h';
        $row++;
    }
#endregion
#region/// ----- Styles Default----- ///
/// ----- Styles Default----- ///
    $spreadsheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(12);
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(11);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(11);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(11);
    $spreadsheet->getActiveSheet()->getStyle('A6')->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getStyle('C6')->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getStyle('J6')->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getStyle('H6')->getFont()->setSize(9);
/// ----- Style Titel ----- ///
    $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(22);
    $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->getColor()->setARGB('a3182e');
/// ----- Style Border ----- ///
    $spreadsheet->getActiveSheet()->getStyle('A1:J1')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
    $spreadsheet->getActiveSheet()->getStyle('A4:J4')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $spreadsheet->getActiveSheet()->getStyle('A5:J5')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $spreadsheet->getActiveSheet()->getStyle('A6:J6')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $spreadsheet->getActiveSheet()->getStyle('A8:J'.$row.'')->getBorders()->getVertical()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $spreadsheet->getActiveSheet()->getStyle('A8:J'.$row.'')->getBorders()->getVertical()->getColor()->setARGB('FFFFFF');  // Weiss
    $spreadsheet->getActiveSheet()->getStyle('A8:J8')->getFont()->getColor()->setARGB('FFFFFF');    // Weiss
/// ----- Style BG Color----- ///
    $spreadsheet->getActiveSheet()->getStyle('A8:J8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('615351'); // Braun hell
    $a = 9;
    for ($a = 9; $a < $row; $a ++){
        if($a % 2 !== 0){
            $spreadsheet->getActiveSheet()->getStyle('A'.$a.':J'.$a.'')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('E5F0FC'); // Hell
        }
        else{
            $spreadsheet->getActiveSheet()->getStyle('A'.$a.':J'.$a.'')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('AED2FB'); // Dunkel
        }
    }
    $spreadsheet->getActiveSheet()->getStyle('A'.$row.':J'.$row.'')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('615351'); // Braun hell
    $spreadsheet->getActiveSheet()->getStyle('A'.$row.':J'.$row.'')->getFont()->getColor()->setARGB('FFFFFF');    // Weiss
/// ----- Text ----- ///
    $spreadsheet->setActiveSheetIndex(0)  /// Kopfzeile
    ->setCellValue('A1', 'REAM AG / reamis ag')
        ->setCellValue('A2', 'Zugerstrasse 50, 6340 Baar')
        ->setCellValue('A5', 'Mitarbeiter/In:')
        ->setCellValue('C5', $userdaten['name'])
//        ->setCellValue('A6', 'Monat:')
//        ->setCellValue('C6',  $monat)
        ->setCellValue('E6', 'Dokumentationsperiode')
        ->setCellValue('H6', $monate[$monat].' '.$jahr)
        ->setCellValue('E5', 'Arbeitspensum pro Tag')
        ->setCellValue('H5', $userdaten['quote'])
        ->setCellValue('A'.$row.'', 'Soll')
        ->setCellValue('B'.$row.'', $soll)
        ->setCellValue('E'.$row.'', 'Stunden')
        ->setCellValue('F'.$row.'', '=(J'.$row.'-B'.$row.')')           //überstunden
        ->setCellValue('J'.$row.'', '=sum(I8:I'.$row.')')
        ->setCellValue('I'.$row.'', 'Total Monat');
    $spreadsheet->setActiveSheetIndex(0)  /// Tabellonkopf
    ->setCellValue('A8', 'Tag')
        ->setCellValue('B8', 'Woche')
        ->setCellValue('C8', 'Datum')
        ->setCellValue('D8', 'Arbeitszeit')
        ->setCellValue('E8', 'Feiertag')
        ->setCellValue('F8', 'Krank')
        ->setCellValue('G8', 'Ferien')
        ->setCellValue('H8', 'Total Tag')
        ->setCellValue('I8', 'Total Woche')
        ->setCellValue('J8', 'Total Monat');
#endregion
#region/// ----- Save ----- ///
    $filename = 'Export-'.$_SESSION['user_username'].'-'.$monat.'-'.$jahr.'.Xlsx';
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->setIncludeCharts(true);
    $callStartTime = microtime(true);
    $writer->save($filename);
#endregion
}


if (file_exists('Export-'.$_SESSION['user_username'].'-'.$monat.'-'.$jahr.'.Xlsx') && isset($_POST['exp'])) {

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename('Export-'.$_SESSION['user_username'].'-'.$monat.'-'.$jahr.'.Xlsx'));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize('Export-'.$_SESSION['user_username'].'-'.$monat.'-'.$jahr.'.Xlsx'));

    ob_clean();
    flush();
    readfile('Export-'.$_SESSION['user_username'].'-'.$monat.'-'.$jahr.'.Xlsx');
    exit;
}
