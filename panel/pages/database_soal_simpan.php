<?php
include "../../config/server.php";
$tgl = date("Y-m-d");

if(str_replace(" ","",$_REQUEST['txt_nama'])!=='')	{
	$sqlcek = mysqli_query($sqlconn,"select * from cbt_paketsoal where XKodeSoal = '$_REQUEST[txt_nama]'");
	$jumcek = mysqli_num_rows($sqlcek);
	if($jumcek<1){
		if(str_replace(" ","",$_REQUEST['txt_jawab'])==""){ $jum = 5; } else { $jum = $_REQUEST['txt_jawab'];}
		$jumsemuasoal = $_REQUEST['txt_jumsoal1']+$_REQUEST['txt_jumsoal2'];
		
		$sql = mysqli_query($sqlconn,"insert into cbt_paketsoal 
		(XKodeMapel,XLevel,XKodeSoal,XJumPilihan,XAcakSoal,XTglBuat,XGuru,XKodeKelas,XKodeJurusan,XJumSoal,XPilGanda,XEsai,XPersenPil,XPersenEsai,XKodeSekolah) values 
		('$_REQUEST[txt_mapel]','$_REQUEST[txt_level]','$_REQUEST[txt_nama]','$jum','$_REQUEST[txt_acak]','$tgl','$_COOKIE[beeuser]',
		'$_REQUEST[txt_kelas]','$_REQUEST[txt_jurusan]','$jumsemuasoal','$_REQUEST[txt_jumsoal1]','$_REQUEST[txt_jumsoal2]',
		'$_REQUEST[txt_bobotsoal1]','$_REQUEST[txt_bobotsoal2]','$_REQUEST[txt_kodesek]')");
	
	}
}