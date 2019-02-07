<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}

	require_once 'PHPExcel.php';
	include "../../config/server.php"; 
if ($log['XTingkat']=="SMA" || $log['XTingkat']=="MA"||$log['XTingkat']=="STM"){
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	//$var_soal = "$_REQUEST[ujian]";

	$hasil = mysqli_query($sqlconn,"SELECT * FROM cbt_kelas");

	// Set properties
	$objPHPExcel->getProperties()->setCreator("UBK/CBT")
		  ->setLastModifiedBy("UBK/CBT")
		  ->setTitle("Office 2007 XLSX Test Document")
		  ->setSubject("Office 2007 XLSX Test Document")
		   ->setDescription("Soal Export")
		   ->setKeywords("office 2007 openxml php")
		   ->setCategory("Daftar Kelas :");
	 
	// Add some data
	$objPHPExcel->setActiveSheetIndex(0)
				
					
			->setCellValue('A1', 'KODE KELAS')
			->setCellValue('B1', 'KODE LEVEL')
			->setCellValue('C1', 'NAMA KELAS')
			->setCellValue('D1', 'KODE JURUSAN')
			->setCellValue('E1', 'KODE SEKOLAH')
		   
			 
			;
		   
	$baris = 2;
	$no = 0;		

	while($p = mysqli_fetch_array($hasil)){
	//----- php excel 

	$no = $no +1;
	$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue("A$baris", $p['XKodeKelas'])
			->setCellValue("B$baris", $p['XKodeLevel'])
			->setCellValue("C$baris", $p['XNamaKelas'])
			->setCellValue("D$baris", $p['XKodeJurusan'])
			->setCellValue("E$baris", $p['XKodeSekolah'])
			
			;
				

	$baris = $baris + 1;
	}
	 
	// Rename sheet
	$objPHPExcel->getActiveSheet()->setTitle('transaksi');
	 
	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);

	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Excel-Kelas.xls"');
	header('Cache-Control: max-age=0');
	 
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
exit;}
else{
		// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	//$var_soal = "$_REQUEST[ujian]";

	$hasil = mysqli_query($sqlconn,"SELECT * FROM cbt_kelas");

	// Set properties
	$objPHPExcel->getProperties()->setCreator("UBK/CBT")
		  ->setLastModifiedBy("UBK/CBT")
		  ->setTitle("Office 2007 XLSX Test Document")
		  ->setSubject("Office 2007 XLSX Test Document")
		   ->setDescription("Soal Export")
		   ->setKeywords("office 2007 openxml php")
		   ->setCategory("Daftar Kelas :");
	 
	// Add some data
	$objPHPExcel->setActiveSheetIndex(0)
				
					
			->setCellValue('A1', 'KODE KELAS')
			->setCellValue('B1', 'KODE LEVEL')
			->setCellValue('C1', 'NAMA KELAS')
			->setCellValue('D1', 'KODE ROMBEL')
			->setCellValue('E1', 'KODE SEKOLAH')
		   
			 
			;
		   
	$baris = 2;
	$no = 0;		

	while($p = mysqli_fetch_array($hasil)){
	//----- php excel 

	$no = $no +1;
	$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue("A$baris", $p['XKodeKelas'])
			->setCellValue("B$baris", $p['XKodeLevel'])
			->setCellValue("C$baris", $p['XNamaKelas'])
			->setCellValue("D$baris", $p['XKodeJurusan'])
			->setCellValue("E$baris", $p['XKodeSekolah'])
			
			;
				

	$baris = $baris + 1;
	}
	 
	// Rename sheet
	$objPHPExcel->getActiveSheet()->setTitle('transaksi');
	 
	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);

	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Excel-Kelas.xls"');
	header('Cache-Control: max-age=0');
	 
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
}