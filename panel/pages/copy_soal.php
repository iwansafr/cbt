<?php
include "../../config/server.php";
$id=$_POST['txt_mapel'];
$sql = mysqli_query($sqlconn,"select * from cbt_soal where Urut='$id'");
$s = mysqli_fetch_array($sql);


$sql1 = "delete from cbt_soal where XKodeSoal = '$soal'";
mysqli_query($sqlconn, $sql1);

$sql2 = "delete from cbt_paketsoal where Urut='$id'";
mysqli_query($sqlconn, $sql2);
