<?php
include "../../config/server.php";
$sql = mysqli_query($sqlconn,"update server_pusat set 
XIPSekolah = '$_REQUEST[txt_ip]',
XUsername = '$_REQUEST[txt_user]',
XPass = '$_REQUEST[txt_pas]',
XDbName = '$_REQUEST[txt_db]'");

$sqlf = mysqli_query($sqlconn,"update cbt_admin set 
XFolderPusat = '$_REQUEST[folderpusat]'
");
echo "Ubah data berhasil !"; 
?>