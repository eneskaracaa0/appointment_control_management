<?php
require_once '../includes/dbconnection.php';
require_once '../excel/PHPExcel.php';
$myExcel = new PHPExcel();
$myExcel->getActiveSheet()->setTitle("RandevuDetay");
$myExcel->getActiveSheet()->setCellValue('A1','Randevu No');
$myExcel->getActiveSheet()->setCellValue('B1','Hasta Adı');
$myExcel->getActiveSheet()->setCellValue('C1','Telefon Numarası');
$myExcel->getActiveSheet()->setCellValue('D1','Email');
$myExcel->getActiveSheet()->setCellValue('E1','Randevu Tarihi');


$sql="SELECT * from tblappointment";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$i=2;


foreach($results as $row)
{ 
    $myExcel->getActiveSheet()->setCellValue('A'.$i,$row->AppointmentNumber);
    $myExcel->getActiveSheet()->setCellValue('B'.$i,$row->Name);
    $myExcel->getActiveSheet()->setCellValue('C'.$i,$row->MobileNumber);
    $myExcel->getActiveSheet()->setCellValue('D'.$i,$row->Email);
     $myExcel->getActiveSheet()->setCellValue('E'.$i,$row->AppointmentDate);
    $i++;

 }
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;




?>