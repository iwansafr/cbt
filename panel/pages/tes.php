<?php 
include "config/server.php";
$sql = mysqli_query($sqlconn,"CREATE TEMPORARY TABLE cbt_ujian_baru AS SELECT * FROM cbt_jawaban where XTokenUjian = 'QWVUW'");
$sql1 = mysqli_query($sqlconn,"select * from cbt_ujian_baru where XUserJawab = 'U003'"); 
while($r = mysqli_fetch_array($sql1)){
echo "$r[XTokenUjian]-$r[XJawabanEsai]-$r[XJawaban]<br>";
}

