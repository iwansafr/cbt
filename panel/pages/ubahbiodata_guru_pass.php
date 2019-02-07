<?php
include "../../config/server.php";
$pass=$_POST['passbaru'];
$passlama = md5($_POST['passlama']);
$passbaru = md5($_POST['passbaru']);
$konfirmasi = $_POST['konfirmasi'];
$username = $_POST['username'];
$cekuser = "select * from cbt_user where Username = '$username' and Password = '$passlama' and '$konfirmasi' = '$pass'";
$querycekuser = mysqli_query($sqlconn,$cekuser);
$password=$querycekuser['Password'];
$count = mysqli_num_rows($querycekuser);
if ($count > 0){
$updatepassword = "update cbt_user set Password = '$passbaru' where Username = '$username'";
$updatequery = mysqli_query($sqlconn,$updatepassword);
if($updatequery)
{
echo "Password telah diganti menjadi <b>$pass</b>";
}}else{echo "Variable tidak Sama Perubahan <b>Tidak Berhasil</b>";}


?>