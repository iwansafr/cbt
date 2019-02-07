<?php include "../../config/server.php";

//$sql = mysqli_query($sqlconn,"insert into tes (nilai) values ('$_REQUEST[token]')");
$array =  explode(',', $_REQUEST['nama']);

foreach ($array as $item) {
	$sql0 = mysqli_query($sqlconn,"select * from cbt_siswa_ujian where Urut = '$item' and XTokenUjian = '$_REQUEST[token]'");
	$s = mysqli_fetch_array($sql0);
	$status = $s['XStatusUjian'];
	$nomer = $s['XNomerUjian'];
	$sql = mysqli_query($sqlconn,"update cbt_siswa_ujian set XGetIP = '' where  Urut = '$item' and XTokenUjian = '$_REQUEST[token]' and XNomerUjian = '$nomer'");

}