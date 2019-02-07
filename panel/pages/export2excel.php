<?php
session_start();
?>
<?php

error_reporting(E_ALL);

require_once '../plugins/excel/PHPExcel.php';
//require_once '../inc/config.php';
include "..\config/conn.php"; 

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$perz = "$_REQUEST[bul]$_REQUEST[tah]";

//$query="select * from umr2013 ";
$query = "select * from XHRDCETAK where Periode = $perz";

$hasil = mssql_query($query);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Sigit Hariono")
      ->setLastModifiedBy("Sigit Hariono")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Salary Report")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Salary Report : 082014");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       	->setCellValue('A1', 'NO')
       	->setCellValue('B1', 'DEPTARTMENT')
       	->setCellValue('C1', 'POSITION')
       	->setCellValue('D1', 'MODULE')
       	->setCellValue('E1', 'NAME')
       	->setCellValue('F1', 'ABSENCE')
       	->setCellValue('G1', 'PENALTY')
       	->setCellValue('H1', 'LATE')
       	->setCellValue('I1', 'SALARY')
      	->setCellValue('J1', 'DEDUCTION')
       	->setCellValue('K1', 'PAYBACK')
       	->setCellValue('L1', 'FINANCE')
       	->setCellValue('M1', 'JAMSOSTEK')
       	->setCellValue('N1', 'BPJS')
     	->setCellValue('O1', 'THP')
     	->setCellValue('P1', 'TOTAL');
 
$baris = 2;
$no = 0;		
$tah = "$_REQUEST[tah]";
$bulus = "$_REQUEST[bul]";
//while($row=mssql_fetch_array($hasil)){

$tot = 0;
while($p = mssql_fetch_array($hasil)){

//----- php excel 

$no = $no +1;
$tot = $tot+$p['THP'];
$tote = number_format($tot, 2, ',', '.');

$objPHPExcel->setActiveSheetIndex(0)
     	->setCellValue("A$baris", $p['Urut'])
     	->setCellValue("B$baris", $p['Dept'])
     	->setCellValue("C$baris", $p['Pos'])
     	->setCellValue("D$baris", $p['Mod'])
     	->setCellValue("E$baris", $p['Name'])
     	->setCellValue("F$baris", $p['Abs'])
     	->setCellValue("G$baris", $p['Pen'])
     	->setCellValue("H$baris", $p['Late'])
     	->setCellValue("I$baris", $p['Salary'])
     	->setCellValue("J$baris", $p['Deduction'])
     	->setCellValue("K$baris", $p['Payback'])
     	->setCellValue("L$baris", $p['Finance'])
     	->setCellValue("M$baris", $p['Jams'])
     	->setCellValue("N$baris", $p['BPJS'])	 
	->setCellValue("O$baris", $p['THP'])
	->setCellValue("P$baris", $tote);

$baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('transaksi');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="SNA_Payroll_Calculation.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>