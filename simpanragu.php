<?php include "config/server.php";
 //update cbt_jawaban set XRagu = '1' where XNomerSoal='$_REQUEST[who]'
// $sql = mysqli_query($sqlconn,"update cbt_jawaban set XRagu = '$_REQUEST[chk]' where XNomerSoal='$_REQUEST[who]'");
$user = $_COOKIE['PESERTA'];
if(isset($_REQUEST['chk'],$_REQUEST['who'])){
 $sql = mysqli_query($sqlconn,"update cbt_jawaban set XRagu = '$_REQUEST[chk]' where Urut='$_REQUEST[who]' AND XUserJawab = '$user'");
 }
 
if($_REQUEST['anu']==0){
$sql = mysqli_query($sqlconn,"update cbt_audio set XMulai = '$_REQUEST[anu]', XPutar = '2'");
} else {
$sql = mysqli_query($sqlconn,"update cbt_audio set XMulai = '$_REQUEST[anu]'");
}

