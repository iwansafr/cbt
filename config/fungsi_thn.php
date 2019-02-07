<?php
include "server.php";
$tahun = date("Y");
$bulan = date("m");
//echo "$bulan";
// ambil Yearstart = Tahun sekarang untuk bulan > Juni, untuk Bulan < Juni set tahun = Tahun sekarang-1
if($bulan<13){
	if($bulan>6){
	$tahun=$tahun;}
	else {
    $tahun=$tahun-1;}
}	
$tahun1 = $tahun+1;
$tahune = substr($tahun1,2,2);
//$ay = "BEE$tahun/$tahune";
$ay = "$tahun/$tahun1";
$nama = "Tahun Pelajaran $tahun/$tahun1";
$sql=mysqli_num_rows(mysqli_query($sqlconn, "select * from cbt_setid where XKodeAY = '$ay'"));
//echo "select * from cbt_setid where XKodeAY = '$ay'";
if($sql<1){
	$sql1 = mysqli_query($sqlconn, "update cbt_setid set XStatus = '0'");
	$sql1 = mysqli_query($sqlconn, "insert into cbt_setid (XKodeAY,XNamaAY,XStatus) values ('$ay','$nama','1')");
}
