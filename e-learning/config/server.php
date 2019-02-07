<?php
include "db_server.php";
$teks3="madipo_cbt";
// 0. Tentukan/Buat Database yang akan digunakan
if ($db_server==""){$teks1="<?php ";$teks2="\$db_server=\"";$teks4="\";";
	$buat_db_server =$teks1.$teks2.$teks3.$teks4; $file = fopen("../../config/db_server.php","w");    
	if($file){fputs($file,$buat_db_server);}
	fclose($file); 
	$db=$teks3;
}else{$db=$db_server;}

$db_host = "localhost:3306";
$db_user="root";
$db_pass="";

// 1. Connect ke database
$sqlconn=@mysqli_connect($db_host,$db_user,$db_pass, $teks3);

// 2. Pilih database
// $db_selected=mysqli_select_db($db, $sqlconn);

// 3. Periksa database jika telah siap
$val = mysqli_query($sqlconn, 'select * from cbt_admin LIMIT 1');
if($val == TRUE){
	$log = mysqli_fetch_array($val);
	$skull= $log['XSekolah'];
	if ($log['XTingkat']=="SMA" || $log['XTingkat']=="MA"||$log['XTingkat']=="STM"){$rombel="Jurusan";}else{$rombel="Rombel";}
	
	if (mysqli_query($sqlconn, "select * from cbt_zona LIMIT 1")==TRUE){
	$xadmz = mysqli_fetch_array(mysqli_query($sqlconn, "select * from cbt_zona LIMIT 1"));
	$zo= $xadmz['XZona'];
	}
	else {	$zo="Asia/Jakarta";}
	date_default_timezone_set($zo);
	$xadm = mysqli_fetch_array(mysqli_query($sqlconn, "select * from cbt_server LIMIT 1"));
	$xserver= $xadm['XServer'];
	$mode = $xserver; 
}else{$skull="UBK/CBT"; date_default_timezone_set("Asia/Jakarta");}