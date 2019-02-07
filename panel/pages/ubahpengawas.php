<?php
include "../../config/server.php";
$sql = mysqli_query($sqlconn,"update cbt_ujian set 
XProktor = '$_REQUEST[txt_proktor]',
XNIPProktor = '$_REQUEST[txt_nipproktor]',
XPengawas = '$_REQUEST[txt_pengawas]',
XNIPPengawas = '$_REQUEST[txt_nippengawas]',
Xcatatan = '$_REQUEST[txt_catatan]'
where XTokenUjian = '$_REQUEST[txt_tokenx]'");


echo "Ubah data berhasil !"; 
?>