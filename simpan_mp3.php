<?php
include "config/server.php";
if($_REQUEST['aksi']=="pause"){
$sql = mysqli_query($sqlconn,"update cbt_jawaban set XMulai = '$_REQUEST[waktu]' where XUserJawab ='$_COOKIE[PESERTA]' and XKodeSoal = '$_REQUEST[soal]' and urut = '$_REQUEST[nomer]'  and XTokenUjian = '$_REQUEST[token]'");
}
elseif($_REQUEST['aksi']=="habis"){
$sql = mysqli_query($sqlconn,"update cbt_jawaban set XMulai = '$_REQUEST[waktu]', XPutar='1' where XUserJawab ='$_COOKIE[PESERTA]' and XKodeSoal = '$_REQUEST[soal]' and urut = '$_REQUEST[nomer]' and XTokenUjian = '$_REQUEST[token]'");
}
