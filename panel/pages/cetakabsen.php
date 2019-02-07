<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<?php
ob_start ();
require('fpdf/fpdf.php'); 
include "../../config/server.php";
// pendefinisian folder font pada FPDF
// seperti sebelunya, kita membuat class anakan dari class FPDF
 class PDF extends FPDF{

function Header(){

$sqlad = mysqli_query($sqlconn,"select * from cbt_admin");

$ad = mysqli_fetch_array($sqlad);
$namsek = strtoupper($ad['XSekolah']);
$kepsek = $ad['XKepSek'];
$logsek = $ad['XLogo'];
								$tanggal = date('m/d/y', strtotime($_REQUEST['tanggal']));		
															
								$timestamp = strtotime($tanggal);								
								$hari = date('l', $timestamp);
								$tgl = date('d', $timestamp);
								$bln = date('F', $timestamp);
								$thn = date('Y', $timestamp);
								
								//Our DD-MM-YYYY date string.
								if($hari=='Sunday'){$hari = "Minggu";}
								elseif($hari=='Monday'){$hari = "Senin";}
								elseif($hari=='Tuesday'){$hari = "Selasa";}
								elseif($hari=='Wednesday'){$hari = "Rabu";}
								elseif($hari=='Thursday'){$hari = "Kamis";}
								elseif($hari=='Friday'){$hari = "Jum'at";}
								elseif($hari=='Saturday'){$hari = "Sabtu";}
								
								if($bln=='January'){$bln = "Januari";}
								elseif($bln=='February'){$bln = "Pebruari";}
								elseif($bln=='March'){$bln = "Maret";}
								elseif($bln=='April'){$bln = "April";}
								elseif($bln=='May'){$bln = "Mei";}
								elseif($bln=='June'){$bln = "Juni";}
								elseif($bln=='July'){$bln = "Juli";}
								elseif($bln=='August'){$bln = "Agustus";}
								elseif($bln=='September'){$bln = "September";}
								elseif($bln=='October'){$bln = "Oktober";}
								elseif($bln=='November'){$bln = "Nopember";}
								elseif($bln=='December'){$bln = "Desember";}

   $this->Image('../../images/'.$logsek,1,1,2.5); // logo
   $this->SetTextColor(0,0,0); // warna tulisan
   $this->SetFont('arial','B','12'); // font yang digunakan
   // membuat cell dg panjang 19 dan align center 'C'
   $this->Cell(3,1,''); // cell dengan panjang 1
   $this->Cell(13,1,'DAFTAR HADIR PESERTA  ',0,0,'C');
   $this->Ln(0.5);
      $this->SetTextColor(0,0,0); // warna tulisan
   $this->SetFont('Arial','B','12'); // font yang digunakan
   // membuat cell dg panjang 19 dan align center 'C'
   $this->Cell(3,1,''); // cell dengan panjang 1
   $this->Cell(13,1,'UJIAN SEKOLAH BERBASIS KOMPUTER (USBK)',0,0,'C');
      $this->Ln(0.5);
      $this->SetTextColor(0,0,0); // warna tulisan
   $this->SetFont('Arial','B','13'); // font yang digunakan
   // membuat cell dg panjang 19 dan align center 'C'
   $this->Cell(3,1,''); // cell dengan panjang 1
   $this->Cell(13,1,''. $namsek. '',0,0,'C');
   $this->Ln(0.5);
   $this->SetFont('Arial','B','10');
   $this->SetFillColor(192,192,192); // warna isi   
   $this->Cell(3,1,''); // cell dengan panjang 1 
   $this->Cell(13,1,' TAHUN PELAJARAN ' . $_COOKIE['beetahun'],0,0,'C');
   $this->Ln(1.5);
   $this->SetFont('Arial','','10');
   $this->Cell(3.8,0.7,'MATA PELAJARAN','',0,'L');
   $this->Cell(9,0.7,': '.$_REQUEST['mapel'],'',0,'L');
   $this->Cell(3,0.7,'SESI / RUANG ','',0,'L');
   $this->Cell(4,0.7,': '.$_REQUEST['sesi'].' / ' . $_REQUEST['ruang'],'',0,'L');
   $this->Ln();
   $this->Cell(3.8,0.7,'HARI','',0,'L');

   $this->SetFont('Arial','','10');
   $this->Cell(9,0.7,': '.$hari.'    TANGGAL     : '.$tgl.' '.$bln.' '.$thn.' ',0,'L');
   $this->SetFont('Arial','','10');
   $this->Cell(3,0.7,'PUKUL','',0,'L');
   $this->Cell(4,0.7,': '.$_REQUEST['mulai'].' - ' . $_REQUEST['akhir'],'',0,'L');
   $this->Ln(0.5);
   $this->SetFont('Arial','B','9');
   $this->SetFillColor(192,192,192); // warna isi
   $this->Ln(0.5);
   $this->SetTextColor(0,0,0); // warna teks untuk th
   $this->Cell(1,1,'No','LTB',0,'C',1); // cell dengan panjang 1
   $this->Cell(3,1,'Username','LTB',0,'C',1); // cell dengan panjang 1
   $this->Cell(7,1,'Nama Peserta','LTB',0,'C',1); // cell dengan panjang 3
   $this->Cell(5,1,'Tanda Tangan','LTBR',0,'C',1); // cell dengan panjang 2
   $this->Cell(3,1,'Ket','LTBR',0,'C',1); // cell dengan panjang 2
   
   // panjang cell bisa disesuaikan
   $this->Ln();
  }

  function Footer(){
   $this->SetY(-2,5);
   $this->Cell(0,1,'UBK/CBT Page-'. $this->PageNo(),0,0,'C');
  } 
 }
 


if(isset($_REQUEST['kelas'])){ 
 $q = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa where XKodeKelas = '$_REQUEST[kelas]' and  XKodeJurusan = '$_REQUEST[jur]'  and  XSesi = '$_REQUEST[sesi]' and  XRuang = '$_REQUEST[ruang]'");
 } else {
 $q = mysqli_query($sqlconn,"select * from cbt_siswa  ");
 } 
 $i = 0;
 
 while($d=mysqli_fetch_array($q)){
  $cell[$i][0]=$d[0];
  $cell[$i][1]=$d[1];
  $cell[$i][2]=$d[2];
  $cell[$i][3]=$d[3];  
  $cell[$i][4]=$d[4];    
  $i++;
 }
 // orientasi Potrait
 // ukuran cm
 // kertas A4
 $pdf = new PDF('P','cm','A4');
 $pdf->Open();
 $pdf->AliasNbPages();
 $pdf->AddPage();

 $pdf->SetFont('arial','','9');
 //perulangan untuk membuat tabel
 for($j=0;$j<$i;$j++){
  $joz=$j+1;
  $pdf->Cell(1,1, " $joz.",'LB',0,'C'); //No
  $pdf->Cell(3,1,$cell[$j][1],'LB',0,'C');   //Username
  $pdf->Cell(7,1,' '.$cell[$j][4],'LBR',0,'L');
	if ($j % 2 == 0) {
	$joz=$j+1;
  	$pdf->Cell(2.5,1," $joz.",'B',0,'L'); // No Tanda Tangan Ganjil
	$pdf->Cell(2.5,1," ",'BR',0,'L');     
	$pdf->Cell(3,1,"",'BR',0,'C');	//Ket
  	} else {
	$joz=$j+1;	
  	$pdf->Cell(2.5,1," ",'B',0,'L'); 	
	$pdf->Cell(2.5,1," $joz.",'BR',0,'L'); // No Tanda Tangan Genap
	$pdf->Cell(3,1,"",'LBR',0,'L');	//Ket
	}	
  $pdf->Ln();
 }
 //A Keterangan
 $pdf->SetFont('arial','BI','8');
	$pdf->Cell(5,1,"Keterangan :",0,0,'L');
	  $pdf->Ln(0.5);
	   $pdf->SetFont('arial','','8');
		$pdf->Cell(8,1,"1. Daftar hadir di buat rangkap 2 (dua).",0,'L');
		$pdf->Ln(0.5);
		$pdf->Cell(7.5,1,"2. Pengawas ruang menyilang Nama Peserta yang tidak hadir.",0,'L');
		$pdf->Ln(0.1);
		$pdf->Cell(10,1,"",0,0,'C');
		$pdf->Cell(4,1,"Proktor",0,0,'C');
		$pdf->Cell(6,1,"Pengawas",0,0,'C');
		$pdf->Ln(1);//Akhir Keterangan
	//Jumlah Hadir
  	$pdf->Cell(5.3,0.5,"Jumlah Peserta yang Seharusnya Hadir",'TL',0,'L');
	$pdf->Cell(2.2,0.5," : ______ orang",'TR',0,'L');
	$pdf->Ln(0.5);
	$pdf->Cell(5.3,0.5,"Jumlah Peserta yang Tidak Hadir",'LB',0,'L');
	$pdf->Cell(2.2,0.5," : ______ orang",'BR',0,'L');
	$pdf->Ln();
	$pdf->Cell(5.3,0.5,"Jumlah Peserta Hadir",'LB',0,'L');
	$pdf->Cell(2.2,0.5," : ______ orang",'BR',0,'L');
	$pdf->Ln(0.1);
	$pdf->Cell(10,1,"",0,0,'C');
	$pdf->Cell(4,1,"(                                               )",0,0,'C');
	$pdf->Cell(6,1,"(                                               )",0,0,'C');
		$pdf->Ln(0.5);
	$pdf->Cell(10,1,"",0,0,'C');
	$pdf->Cell(4,1,"NIP. ",0,0,'L');
	$pdf->Cell(6,1,"              NIP. ",0,0,'L');
 $pdf->Output(); // ditampilkan
ob_end_flush();
?>