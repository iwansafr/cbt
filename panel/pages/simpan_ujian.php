							  <?php 
include "../../config/server.php";					  	
 //$sqlubah = mysqli_query($sqlconn,"insert into cbt_tes (tes) values ('$_REQUEST[txt_waktu]')");
 $sqlubah2 = mysqli_query($sqlconn,"update cbt_ujian set XStatusUjian = '0'");
 
							  $tgl = substr($_REQUEST['txt_waktu'],0,10);
							  $jam = substr($_REQUEST['txt_waktu'],11,5);
							  $jam = "$jam:00";


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
$minutest = $_REQUEST['txt_telat'];
$dt = floor ($minutest / 1440);
$ht = floor (($minutest - $dt * 1440) / 60);
$mt = $minutest - ($dt * 1440) - ($ht * 60);

$hit = strlen($ht);
$mit = strlen($mt);
if($hit<2){$hit = "0".$ht;}else{$hit=$ht;}
if($mit<2){$mit = "0".$mt;}else{$mit=$mt;}
$jamet = "$hit:$mit:00";

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
$telatujian = "$tjam:$tmnt:$tdtk";

//=========================
// Ambil Paket Soal
//=========================
$loop = mysqli_query($sqlconn,"select * from cbt_paketsoal where XStatusSoal ='Y'");
while($s = mysqli_fetch_array($loop)){
$val_jumsoal = $s['XJumSoal'];

//=========================
// Ambil Bank Soal
//=========================

$jumsoal = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_paketsoal where  XKodeSoal = '$s[txt_ujian]'"));
$val_banksoal =  "$jumsoal"; 


if($val_jumsoal>$val_banksoal){$ambilsoal = $val_banksoal;} else {$ambilsoal = $val_jumsoal;}
if($val_jumsoal==0){$ambilsoal = $val_banksoal;} else {$ambilsoal = $val_jumsoal;}
						  
							//  $sqlubah = mysqli_query($sqlconn,"insert into cbt_sampah (anu) values ('$_REQUEST[txt_ujian]')");
							 
							  $sqlinsert = mysqli_query($sqlconn,"insert into cbt_ujian 
							  (XKodeKelas,XKodeJurusan,XJumPilihan,XAcakSoal,XKodeMapel,XTokenUjian,XTglUjian,XJamUjian,XLamaUjian,XBatasMasuk,XJumSoal,XKodeSoal,XStatusUjian)
							  values 
							  ('$s[XKodeKelas]','$s[XKodeJurusan]','$s[XJumPilihan]','$s[XAcakSoal]','$s[XKodeMapel]','$_REQUEST[txt_token]','$tgl','$jam','$jame','$telatujian','$ambilsoal',
							  '$s[XKodeSoal]','1')");


}


							  ?>
                              
