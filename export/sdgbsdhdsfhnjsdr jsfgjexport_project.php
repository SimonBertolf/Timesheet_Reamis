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
    $ist =0;
    $time_user = array();
    $pr = pick_one_project($_GET['export_project']);
    $user = pick_all_user();
    while ($res = $user->fetch_assoc()) {
        $query_char_data = char_data($pr['projectname'], $res['name']);
        while ($res = $query_char_data->fetch_assoc()) {
            $time_user[$res['name']] += $res['time'];
            $ist += $res['time'];
        }
    }
#region/// ----- Variablen ----- ///
    $project_name = $pr['projectname'];
    $project_nr = $pr['projectnr'];
    $project_description = $pr['description'];
    $project_budget = $pr['budget'];
    $project_ist = $ist;
    $project_diff = ($project_budget - $project_ist);
    $row = 16;
#endregion

#region/// ----- Functionen ----- ///
    //////b13-f29 chart
#endregion

    $spreadsheet = new Spreadsheet();
    $worksheet = $spreadsheet->getActiveSheet();


    foreach ($time_user as $name => $time){
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B' . $row . '',$name );
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C' . $row . '',$time );
        $row ++;
    }
    $row -=1;
#region/// ----- Code Alle ----- ///
/// ----- Chart ----- ///
    $colors = [
        // user1 //user2 //  user3  // user4   //  user5
        'C2B8CF', '564C64', '2E2934', 'FED82F', 'FD9D2A',
    ];

    $dataSeriesLabels1 = [
        new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$C$5', null, 1), // 2011
    ];
    $xAxisTickValues1 = [
        new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$B$16:$B$'.$row.'', null, 4), // Legende
    ];
    $dataSeriesValues1 = [
        new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$C$16:$C$'.$row.'', null, 4, [], null, $colors), //Daten herholen
    ];

    $series1 = new DataSeries(
        DataSeries::TYPE_PIECHART, // plotType
        null, // plotGrouping (Pie charts don't have any grouping)
        range(0, count($dataSeriesValues1) - 1), // plotOrder
        $dataSeriesLabels1, // plotLabel
        $xAxisTickValues1, // plotCategory
        $dataSeriesValues1         // plotValues
    );

    $layout1 = new Layout();
    $layout1->setShowVal(true);
    $layout1->setShowPercent(true);
    $layout1->setShowLeaderLines(true);
    $plotArea1 = new PlotArea($layout1, [$series1]);
    $legend1 = new Legend(Legend::POSITION_TOP, null, false);
    $title1 = new Title('');

    $chart1 = new Chart(
        'chart1', // name
        $title1, // title
        $legend1, // legend
        $plotArea1, // plotArea
        true, // plotVisibleOnly
        0, // displayBlanksAs
        null, // xAxisLabel
        null   // yAxisLabel - Pie charts don't have a Y-Axis
    );

    $chart1->setTopLeftPosition('B13');
    $chart1->setBottomRightPosition('G27');
    $worksheet->addChart($chart1);

#endregion

#region/// ----- Styles Default----- ///
/// ----- Styles Default----- ///
    $spreadsheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(12);

    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(14);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(14);
    $spreadsheet->getActiveSheet()->getStyle('B3')->getFont()->setSize(28);
    $spreadsheet->getActiveSheet()->getStyle('B3')->getFont()->getColor()->setARGB('a3182e');

/// ----- Style Border ----- ///
    $spreadsheet->getActiveSheet()->getStyle('B3:F3')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
/// ----- Text ----- ///
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('B3', $project_name)
        ->setCellValue('B5', 'Projektnummer: ')
        ->setCellValue('B7', 'Zeitbudget: ')
        ->setCellValue('B8', 'Stunden: ')
        ->setCellValue('B9', 'Verbleiben: ')
        ->setCellValue('B11', 'Beschreibung: ')

        ->setCellValue('C5', $project_nr)
        ->setCellValue('C7', $project_budget)
        ->setCellValue('C8', $project_ist)
        ->setCellValue('C9', $project_diff)
        ->setCellValue('C11', $project_description);





#endregion
#region/// ----- Save ----- ///
    $filename = 'Export_'.$project_name.'.Xlsx';
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->setIncludeCharts(true);
    $callStartTime = microtime(true);
    $writer->save($filename);
#endregion
}


if (file_exists('Export_'.$project_name.'.Xlsx') && isset($_GET['export_project'])) {

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename('Export_'.$project_name.'.Xlsx'));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize('Export_'.$project_name.'.Xlsx'));

    ob_clean();
    flush();
    readfile('Export_'.$project_name.'.Xlsx');
    exit;
}
