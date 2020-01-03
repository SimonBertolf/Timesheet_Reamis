<?php
#region/// ----- include ----- ///
session_start();
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



if (isset($_GET['export_project'])) {

    $spreadsheet = new Spreadsheet();

    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('B5', 'Projektnummer: ')
        ->setCellValue('B7', 'Zeitbudget: ')
        ->setCellValue('B8', 'Stunden: ')
        ->setCellValue('B9', 'Verbleiben: ')
        ->setCellValue('B11', 'Beschreibung: ');

#endregion
#region/// ----- Save ----- ///
    $filename = 'Export.Xlsx';
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->setIncludeCharts(true);
    $callStartTime = microtime(true);
    $writer->save($filename);
#endregion
}

//
//if (file_exists('Export.Xlsx') && isset($_GET['export_project'])) {
//
//    header('Content-Description: File Transfer');
//    header('Content-Type: application/octet-stream');
//    header('Content-Disposition: attachment; filename='.basename('Export.Xlsx'));
//    header('Content-Transfer-Encoding: binary');
//    header('Expires: 0');
//    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
//    header('Pragma: public');
//    header('Content-Length: ' . filesize('Export.Xlsx'));
//
//    ob_clean();
//    flush();
//    readfile('Export.Xlsx');
//    exit;
//}
