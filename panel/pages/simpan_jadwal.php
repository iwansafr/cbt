<?php 
include "../../config/server.php";	
				  	
// $sqlubah2 = mysqli_query($sqlconn,"update cbt_ujian set XStatusUjian = '0'");
 
							  $tgl = substr($_REQUEST['txt_waktu'],0,10);
							  $jam = substr($_REQUEST['txt_waktu'],11,5);
							  $jam = "$jam:00";
							  $mjam = substr($_REQUEST['mulai2'],0,2);
							  $mmen = substr($_REQUEST['mulai2'],3,2);

//=========================
// Tentukan Durasi Ujian
//=========================

$minutes = $_REQUEST['txt_durasi'];
$d = floor ($minutes / 1440);
$h = floor (($minutes - $d * 1440) / 60);
$m = $minutes - ($d * 1440) - ($h * 60);

$hi = strlen($h);
$mi = strlen($m);
if($hi<2){$hi = "0".$h;}else{$hi=$h;}
if($mi<2){$mi = "0".$m;}else{$mi=$m;}
$jame = "$hi:$mi:00";
//


//=========================
// Tentukan Batas Keterlambatan Masuk Ujian
//=========================
$xlambat = $_REQUEST['mulai2'];

$minutest = $_REQUEST['txt_durasi'];
$dt = floor ($minutest / 1440);
$ht = floor (($minutest - $dt * 1440) / 60);
$mt = $minutest - ($dt * 1440) - ($ht * 60);

$hit = strlen($ht);
$mit = strlen($mt);
if($hit<2){$hit = "0".$ht;}else{$hit=$ht;}
if($mit<2){$mit = "0".$mt;}else{$mit=$mt;}
$jamet = "$mjam:$mmen:00";

//$telatujian = date('H:i:s',strtotime('+$hit hour +$mit minutes +00 seconds',strtotime($jamujiane)));
  $xjumlahjam = $jamet;
  $xjam = substr($xjumlahjam,0,2);
  $xmnt = substr($xjumlahjam,3,2);
  $xdtk = substr($xjumlahjam,6,2);
  
$jatahjam = $xjam;
$jatahmnt = $xmnt;
$menit = $jatahmnt+($jatahjam*60);
$timestamp = strtotime($jam) + $menit*60;
$tjam = date('H', $timestamp);
$tmnt = date('i', $timestamp);
$tdtk = date('s', $timestamp);

$jamlam = $_REQUEST['mulai2'];
$telatujian = "$tjam:$tmnt:$tdtk";


//=========================
// Ambil Paket Soal
//=========================
$loop = mysqli_query($sqlconn,"select * from cbt_paketsoal where XStatusSoal ='Y' and XKodeSoal = '$_REQUEST[txt_kodesoal]'");
while($s = mysqli_fetch_array($loop)){
$val_jumsoal = $s['XJumSoal'];
$val_pilganda = $s['XPilGanda'];
$val_esai = $s['XEsai'];

	$sqlubah = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_ujian where XKodeSoal = '$_REQUEST[txt_kodesoal]' and  XKodeUjian = '$_REQUEST[txt_ujian]' and 
	XSemester = '$_REQUEST[txt_semester]' and XKodeKelas = '$s[XKodeKelas]' and XKodeJurusan = '$s[XKodeJurusan]' and 
	XKodeMapel = '$s[XKodeMapel]' and XSetId = '$_COOKIE[beetahun]' "));
	
	/*
	if($sqlubah>0){
	$sqlubah2 = mysqli_query($sqlconn,"update cbt_ujian set XStatusUjian = '0' where XKodeSoal = '$_REQUEST[txt_kodesoal]' and  XKodeUjian = '$_REQUEST[txt_ujian]' and XSemester =  
	'$_REQUEST[txt_semester]' and XKodeKelas = '$s[XKodeKelas]' and XKodeJurusan = '$s[XKodeJurusan]' and XKodeMapel = '$s[XKodeMapel]' and XSetId = '$_COOKIE[beetahun]'");
	}
	*/
	
//=========================
// Ambil Bank Soal
//=========================

$jumsoal = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_soal where  XKodeSoal = '$_REQUEST[txt_kodesoal]'"));
$val_banksoal =  "$jumsoal"; 


if($val_jumsoal==0){$ambilsoal = $val_banksoal;} 
elseif($val_jumsoal>$val_banksoal){$ambilsoal = $val_banksoal;} 
else {$ambilsoal = $val_jumsoal;}
//  $sqlubah = mysqli_query($sqlconn,"insert into cbt_sampah (anu) values ('$_REQUEST[txt_ujian]')");
//================================
//
//=================================
$sqls = mysqli_query($sqlconn,"select u.*,m.*,u.Urut as Urutan,u.XKodeKelas as kokel from cbt_ujian u left join cbt_mapel m on m.XKodeMapel = u.XKodeMapel 
left join cbt_paketsoal p on p.XKodeSoal = u.XKodeSoal where u.XStatusUjian='1'");
								while($ss = mysqli_fetch_array($sqls)){ 
$time1 = "$ss[XJamUjian]";
$time2 = "$ss[XLamaUjian]";

$secs = strtotime($time2)-strtotime("00:00:00");
$jamhabis = date("H:i:s",strtotime($time1)+$secs);	
$sekarang = date("H:i:s");	
$tglsekarang = date("Y-m-d");	
$tglujian = "$ss[XTglUjian]";	
		}
	
$sqlcek = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_ujian where XTokenUjian = '$_REQUEST[txt_token]'"));
	if($sqlcek>0){echo "<div class='alert alert-danger alert-dismissable' id='ndelik'>Simpan Data Gagal Token Sudah ada.</div>     ";
	} else {
				$sqlinsert = mysqli_query($sqlconn,"insert into cbt_ujian 						  
				(XKodeKelas,XKodeUjian,XSemester,XKodeJurusan,XJumPilihan,XAcakSoal,XKodeMapel,XTampil,
				 XTokenUjian,XTglUjian,XJamUjian,XLamaUjian,XBatasMasuk,XJumSoal
				,XKodeSoal,XStatusUjian,XGuru,XSetId,XSesi,XPilGanda,XEsai,XLambat,XStatusToken,XPdf,XFilePdf,XListening) values 		
				('$s[XKodeKelas]','$_REQUEST[txt_ujian]','$_REQUEST[txt_semester]','$s[XKodeJurusan]','$s[XJumPilihan]',
				'$s[XAcakSoal]','$s[XKodeMapel]','$_REQUEST[txt_hasil]','$_REQUEST[txt_token]','$tgl','$jam','$jame','$jamet','$ambilsoal',
				'$s[XKodeSoal]','1','$s[XGuru]','$_COOKIE[beetahun]','$_REQUEST[txt_sesi]','$val_pilganda','$val_esai','$xlambat',
				'$_REQUEST[txt_statustoken]','$_REQUEST[txt_pdf]','$_REQUEST[txt_filepdf]','$_REQUEST[txt_listen]')");
				echo "<div class='alert alert-success alert-dismissable' id='ndelik'>
                               Data Berhasil Disimpan 
                            </div>     ";

	}
}

?>
                              
