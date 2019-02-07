<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php 

include "config/server.php";
mysqli_query($sqlconn,"SET NAMES utf8");
if(isset($_COOKIE['PESERTA'])){
$user = $_COOKIE['PESERTA'];}
//  setcookie('PESERTA',$user);
  $sqluser = mysqli_query($sqlconn,"SELECT * FROM  `cbt_siswa` s LEFT JOIN cbt_ujian u ON (s.XKodeKelas = u.XKodeKelas or u.XKodeKelas = 'ALL') 
  and (s.XKodeJurusan = u.XKodeJurusan or u.XKodeJurusan = 'ALL') WHERE XNomerUjian = 
  '$user' and u.XStatusUjian = '1'");
  $s = mysqli_fetch_array($sqluser);
//  $xkodesoal = "BAS1";//$s['XKodeSoal'];
//  $xtokenujian = "ZQIFG"; // $s['XTokenUjian'];
    $xkodesoal = $s['XKodeSoal'];
    $xtokenujian = $s['XTokenUjian'];
	$xnamkel = $s['XNamaKelas'];

  
  
if(isset($_REQUEST['soale'])){
$soalnja = $_REQUEST['soale'];
}
 $cek = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_jawaban where Urut='$soalnja' and XKodeSoal = '$xkodesoal' and XUserJawab = '$user'"));
 if($cek>0){
// $sql = mysqli_query($sqlconn,"update cbt_jawaban set XJawaban = '$_REQUEST[nama]' where XNomerSoal='$_REQUEST[soale]' and XKodeSoal = '$xkodesoal' and XUserJawab = '$user'");
$tgl = date("Y-m-d");
$jam = date("H:i:s");

if(isset($_REQUEST['nama'])){
$nomber = str_replace(" ","",$_REQUEST['nama']);
$jawab_esai = str_replace("  ","",mysqli_real_escape_string($_REQUEST['nama']));
}
$ambiljawaban = "X$nomber";

$sqljwb = mysqli_query($sqlconn,"select *,$ambiljawaban as hasile from cbt_jawaban where Urut='$soalnja' and XKodeSoal = '$xkodesoal' and XUserJawab = '$user' and XTokenUjian = '$xtokenujian'");
$uj = mysqli_fetch_array($sqljwb);
$jwb = $uj['hasile'];
$tkn = $uj['XTokenUjian'];
$knc = $uj['XKunciJawaban'];

$sqljenis = mysqli_query($sqlconn,"select * from cbt_jawaban where Urut='$soalnja' and XKodeSoal = '$xkodesoal' and XUserJawab = '$user' and XTokenUjian = '$xtokenujian'");
$uji = mysqli_fetch_array($sqljenis);
$jenis = $uji['XJenisSoal'];


if($jenis==2){
	if(!$jawab_esai==""){
	$sql = mysqli_query($sqlconn,"update cbt_jawaban set XJawabanEsai = '$jawab_esai', XTglJawab = '$tgl',XJamJawab = '$jam',Campur = '$tkn',XTemp = '$soalnja' , XNamaKelas = '$xnamkel'
	where Urut='$soalnja' and XKodeSoal = '$xkodesoal' and XUserJawab = '$user'  and XTokenUjian = '$xtokenujian'");
	}
} elseif($jenis==1){
	if($jwb==$knc){$nil = 1;} else {$nil=0;}
	$sql = mysqli_query($sqlconn,"update cbt_jawaban set XJawaban = '$nomber',XKodeJawab = '$ambiljawaban',XNilaiJawab = '$jwb', XNilai='$nil', XTglJawab = '$tgl',XJamJawab = '$jam', 
	Campur = '$tkn', XNamaKelas = '$xnamkel'
	where Urut='$soalnja' and XKodeSoal = '$xkodesoal' and XUserJawab = '$user'  and XTokenUjian = '$xtokenujian'");
}

if(isset($jam)){
$sql2 = mysqli_query($sqlconn,"Update cbt_siswa_ujian set XLastUpdate = '$jam' where XNomerUjian = '$user' and XStatusUjian = '1'");
}

 
 } 

    if(mysqli_query($sqlconn,$sql)){
     return "success!";
   	} else {
    return "failed!";
  	}
 
?>  
</body>
</html>