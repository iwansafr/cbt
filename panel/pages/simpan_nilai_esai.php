<?php include "../../config/server.php";
	
if(isset($_REQUEST['nomere'])){$nomer= $_REQUEST['nomere'];}
if(isset($_REQUEST['siswae'])){$siswa= $_REQUEST['siswae'];}
if(isset($_REQUEST['tokene'])){$token= $_REQUEST['tokene'];}
if(isset($_REQUEST['soale'])){$soal= $_REQUEST['soale'];}
$tgl = date("Y-m-d");
$jam = date("H:i:s");

if(isset($_REQUEST['jawabe'])){
$nilai = str_replace(" ","",$_REQUEST['jawabe']);
}
$sqljenis = mysqli_query($sqlconn,"select * from cbt_jawaban where XNomerSoal='$nomer' and XKodeSoal = '$soal' and XUserJawab = '$siswa' and XTokenUjian = '$token'");
$uji = mysqli_fetch_array($sqljenis);
$jenis = $uji['XJenisSoal'];
if($jenis==2){
	if($nilai==""||$nilai=="0"){$nilai = 0 ;}	
	$sql = mysqli_query($sqlconn,"update cbt_jawaban set XNilaiEsai = '$nilai' where XNomerSoal='$nomer' and XKodeSoal = '$soal' and XUserJawab = '$siswa' and XTokenUjian = '$token'");

} 

$sqljumlah = mysqli_query($sqlconn,"select sum(XNilaiEsai) as hasil from cbt_jawaban where XKodeSoal = '$soal' and XUserJawab = '$siswa' and XTokenUjian = '$token'");
$o = mysqli_fetch_array($sqljumlah);
$tampil = round($o['hasil'],2);

$sqlnilai = mysqli_query($sqlconn,"select * from cbt_nilai where XKodeSoal = '$soal' and XNomerUjian = '$siswa' and XTokenUjian = '$token'");
$on = mysqli_fetch_array($sqlnilai);
$NilP = $on['XNilai'];


$sqlpaket = mysqli_query($sqlconn,"select * from cbt_paketsoal where XKodeSoal = '$soal'");
$oj = mysqli_fetch_array($sqlpaket);
$pakP = round($oj['XPersenPil'],2);
$pakE = round($oj['XPersenEsai'],2);

$subP = ($NilP*($pakP/100));
$subE = ($tampil*($pakE/100));
$Total = $subP+$subE;

$sqljo = mysqli_query($sqlconn,"update cbt_nilai set XEsai = '$tampil',XPersenPil = '$pakP',XPersenEsai = '$pakE',XTotalNilai = '$Total' where XKodeSoal = '$soal' and XNomerUjian = '$siswa' and XTokenUjian = '$token'");

echo $tampil;
?>