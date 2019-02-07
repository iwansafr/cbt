<?php include "../../config/server.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $skull; ?>-CBT | Administrator</title>
<script language="JavaScript">
var txt="<?php echo $skull; ?>-CBT | Administrator.....";
var kecepatan=100;var segarkan=null;function bergerak() { document.title=txt;
txt=txt.substring(1,txt.length)+txt.charAt(0);
segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
</script>
 <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='images/icon.png' rel='icon' type='image/png'/>
   

</head><body bgcolor=#F8FFBF >
<center><h1><span style="color: #0A09B8 ;">DELETE DATABASE UJIAN</h1></span>
<br><center> <span style="color: #ff0000;"><b>UJIAN tidak terpakai/selesai = 9, aktif = 1</span>
<br>
<br><span style="color: #ff0000 ;">PERINGATAN: </b></span>
<br>
<br><span style="color: #7D4E06 ;"> Hati-hati melakukan <b>PENGHAPUSAN/DELETE</b> database karena hasil ujian akan hilang dan tidak bisa dikembalikan
<br> Penghapusan dilakukan hanya bila data ujian benar-benar sudah tidak dipakai lagi
<br>Lakukan BACKUP sebelum melakukan Penghapusan Database</center></span>
<br>
<br>
</body></html>