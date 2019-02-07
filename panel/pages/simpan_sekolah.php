
<?php 
include "../../config/server.php";
if($_REQUEST['aksi']=="simpan1"){
$sqlcek = mysqli_query($sqlconn,"select * from server_sekolah where Urut = '$_REQUEST[Urut]'");
$sta = mysqli_fetch_array($sqlcek);
$status= $sta['XStatus'];

if($status=="1"){ $ubah = "0"; } 
	elseif($status=="0"){ $ubah = "1"; } 
	
$sqlpasaif = mysqli_query($sqlconn,"update server_sekolah set XStatus = '$ubah' where Urut = '$_REQUEST[Urut]'");

	
	?>