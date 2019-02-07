<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}

require_once 'PHPExcel.php';
include "../../config/server.php"; 

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

//$var_soal = "$_REQUEST[ujian]";

$hasil = mysqli_query($sqlconn,"SELECT * FROM cbt_jawaban where XJenisSoal='2'");

// Set properties
$objPHPExcel->getProperties()->setCreator("BEESMART-CBT")
      ->setLastModifiedBy("BEESMART-CBT")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Soal Export")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Daftar Jawaban Esai :")
	   ;
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
      
       
		
       	->setCellValue('A1', 'Nomor')
       	->setCellValue('B1', 'NOMOR SOAL')
       	->setCellValue('C1', 'USER/SISWA')
       	->setCellValue('D1', 'KELAS')
       	->setCellValue('E1', 'JURUSAN/ROMBEL')
       	->setCellValue('F1', 'TOKEN')
       	->setCellValue('G1', 'KODE SOAL ')
		->setCellValue('H1', 'KODE MAPEL')
       	->setCellValue('I1', 'JAWABAN ESAI')
   
		;
       
$baris = 2;
$no = 0;		

while($p = mysqli_fetch_array($hasil)){
//----- php excel 

$no = $no +1;
$objPHPExcel->setActiveSheetIndex(0)
     	->setCellValue("A$baris", $no)
     	->setCellValue("B$baris", $p['XNomerSoal'])
     	->setCellValue("C$baris", $p['XUserJawab'])
     	->setCellValue("D$baris", $p['XKodeKelas'])
     	->setCellValue("E$baris", $p['XKodeJurusan'])
     	->setCellValue("F$baris", $p['XTokenUjian'])
     	->setCellValue("G$baris", $p['XKodeSoal'])
     	->setCellValue("H$baris", $p['XKodeMapel'])
     	->setCellValue("I$baris", $p['XJawabanEsai'])
    
		;

$baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('transaksi');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Excel-Siswa.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
