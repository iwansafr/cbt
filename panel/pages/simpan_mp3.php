<?php
include "config/server.php";
//if($_REQUEST['anu']==0){
$sql = mysqli_query($sqlconn,"update cbt_audio set XMulai = '34', XPutar = '2'");
//} else {
//$sql = mysqli_query($sqlconn,"update cbt_audio set XMulai = '$_REQUEST[anu]'");
//}
?>
