<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */
include "../../config/server.php";
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once 'PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
							 
function cellColor($cells,$color){
    global $objPHPExcel;

    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
             'rgb' => $color
        )
    ));
}


$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:N1');
$objPHPExcel->getActiveSheet()->getStyle("A1:N1")->getFont()->setSize(18);
   $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

    $objPHPExcel->getActiveSheet()->getStyle("A1:N1")->applyFromArray($style);


cellColor('A3:N3', 'e7e7e7');
//cellColor('A30:Z30', 'F28A8C');							 
				 
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
// Add some data
$objPHPExcel->setActiveSheetIndex(0)

			->setCellValue('A1', 'HASIL UJIAN CBT')
			->setCellValue('A3', 'No.')
			->setCellValue('B3', 'Nomer Ujian')
			->setCellValue('C3', 'Nama Peserta')
			->setCellValue('D3', 'Kelas')
			->setCellValue('E3', 'Jurusan')	
			->setCellValue('F3', 'Sesi Ujian')						
			->setCellValue('G3', 'Mata Pelajaran')
			->setCellValue('H3', 'Menjawab')
			->setCellValue('I3', 'Benar')
			->setCellValue('J3', 'Jawaban Esai')			
			->setCellValue('K3', 'Nilai Pilihan Ganda')
			->setCellValue('L3', 'Nilai Soal Esai')		
			->setCellValue('M3', 'Total Nilai')
			->setCellValue('N3', 'TOKEN');			
						
$sqlujian = mysqli_query($sqlconn,"SELECT * from cbt_ujian WHERE XKodeSoal = '$_REQUEST[soal]'");
$uj = mysqli_fetch_array($sqlujian);
$txt_kelas = $uj['XKodeKelas'];
$txt_jurusan = $uj['XKodeJurusan'];
$var_mapel = $uj['XKodeMapel'];
$var_soal = $uj['XKodeSoal'];
$var_jumsoal = $uj['XJumSoal'];
$var_token = $uj['XTokenUjian'];

if($txt_kelas == 'ALL' && $txt_jurusan == 'ALL'){
$hasil = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa "); }
elseif($txt_kelas == 'ALL' && $txt_jurusan !== 'ALL'){
$hasil = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa where XKodeJurusan = '$txt_jurusan'"); }
elseif( $txt_kelas !== 'ALL' && $txt_jurusan == 'ALL'){
$hasil = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa where XKodeKelas = '$txt_kelas'"); 
} else {
$hasil = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa where XKodeKelas = '$txt_kelas'");
}


$baris = 4;
$no = 1;	
while($p = mysqli_fetch_array($hasil)){

    $var_siswa = "$p[XNomerUjian]";
	$var_nama = "$p[XNamaSiswa]";
	$var_sesi = "$p[XSesi]";
    $var_kelas = "$p[XKodeKelas]";
	$var_jurusan = "$p[XKodeJurusan]";
	$grup = "$p[XKodeKelas] - $p[XKodeJurusan]";
	
	$sqlpaket = mysqli_query($sqlconn,"select * from cbt_paketsoal p LEFT JOIN cbt_mapel m on m.XKodeMapel=p.XKodeMapel where p.XKodeSoal = '$var_soal'"); 	
	$p1 = mysqli_fetch_array($sqlpaket);
	$per_pil = $p1['XPersenPil'];
	$per_esai = $p1['XPersenEsai'];	
	$var_pil = $p1['XPilGanda'];	
	$var_esai = $p1['XEsai'];		
	$namamapel = $p1['XNamaMapel'];	
	

$var_siswa = $p['XNomerUjian'];
$var_sesi = $p['XSesi'];

//ambil nilai esai masing2 siswa
$sqljumlah = mysqli_query($sqlconn,"select sum(XNilaiEsai) as hasil from cbt_jawaban where XKodeSoal = '$var_soal' and XUserJawab = '$var_siswa' and XTokenUjian = '$var_token'");
$o = mysqli_fetch_array($sqljumlah);
$nilai_esai = $o['hasil'];


$sqldijawab = mysqli_num_rows(mysqli_query($sqlconn,"SELECT * FROM `cbt_jawaban` WHERE XKodeSoal = '$var_soal' and XUserJawab = '$var_siswa' and XJawaban != ''"));
	$sqljawaban = mysqli_query($sqlconn," SELECT count( XNilai ) AS HasilUjian,XTokenUjian FROM `cbt_jawaban` WHERE XKodeSoal = '$var_soal' and XUserJawab = '$var_siswa' and XNilai = 
	'1' ");
	$sqj = mysqli_fetch_array($sqljawaban);
	$tokenujian = $sqj['XTokenUjian'];
	$jumbenar = $sqj['HasilUjian'];
	$nilai_pil = ($jumbenar/$var_pil)*100;	
	$total_pil = $nilai_pil*($per_pil/100);	
	$total_esai = $nilai_esai*($per_esai/100);	
	$total_nilai = $total_pil+$total_esai;	

	
// Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)
            //->setCellValue('A4', 'Miscellaneous glyphs')
            //->setCellValue('A5', 'sfdsdf');
			->setCellValue("A$baris", $no)
			->setCellValue("B$baris", "$var_siswa")
			->setCellValue("C$baris", "$var_nama")
			->setCellValue("D$baris", "$var_kelas")
			->setCellValue("E$baris", "$var_jurusan")
			->setCellValue("F$baris", "$var_sesi")
			->setCellValue("G$baris", "$namamapel")
			->setCellValue("H$baris", "$sqldijawab")
			->setCellValue("I$baris", "$jumbenar")
			->setCellValue("J$baris", "$nilai_esai")			
			->setCellValue("K$baris", "$total_pil")			
			->setCellValue("L$baris", "$total_esai")			
			->setCellValue("M$baris", "$total_nilai")
			->setCellValue("N$baris", "$tokenujian");			
			
			$no = $no +1;			
					
	$baris = $baris + 1;
}
 
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($namamapel);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client�s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Hasil_USBK.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>