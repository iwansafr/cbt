<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<?php
require_once 'PHPExcel.php';
include "../../config/server.php"; 

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

//$var_soal = "$_REQUEST[ujian]";

$hasil = mysqli_query($sqlconn,"SELECT * FROM cbt_mapel");

// Set properties
$objPHPExcel->getProperties()->setCreator("UBK/CBT")
      ->setLastModifiedBy("UBK/CBT")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Soal Export")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Daftar Mapel :");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
          	
				
       	->setCellValue('A1', 'KODE')
       	->setCellValue('B1', 'NAMA MAPEL')
       	->setCellValue('C1', 'PERSEN UH')
       	->setCellValue('D1', 'PERSEN UTS')
       	->setCellValue('E1', 'PERSEN UAS')
       	->setCellValue('F1', 'KKM')
       	->setCellValue('G1', 'JENIS MAPEL')
       	->setCellValue('H1', 'KODE SEKOLAH')
       	 
		;
       
$baris = 2;
$no = 0;		

while($p = mysqli_fetch_array($hasil)){
//----- php excel 

$no = $no +1;
$objPHPExcel->setActiveSheetIndex(0)
     	->setCellValue("A$baris", $p['XKodeMapel'])
     	->setCellValue("B$baris", $p['XNamaMapel'])
     	->setCellValue("C$baris", $p['XPersenUH'])
     	->setCellValue("D$baris", $p['XPersenUTS'])
     	->setCellValue("E$baris", $p['XPersenUAS'])
     	->setCellValue("F$baris", $p['XKKM'])
     	->setCellValue("G$baris", $p['XMapelAgama'])
     	->setCellValue("H$baris", $p['XKodeSekolah'])
		;
     		

$baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('transaksi');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Excel-Mapel.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>