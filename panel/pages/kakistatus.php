<?php include "../../config/server.php"; ?>
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
   

</head>
<center><body  bgcolor=#F8FFBF>
<br>
<br>
<br>
<center><h4><span style="color: #0A09B8 ;"><?php echo $skull; ?>-CBT | Administrator</h4></span>
<br><span style="color: #ff0000 ;">PENTING: </b></span>
Dilarang keras menghapus database kecuali sudah tidak ada lagi ujian untuk hari selanjutnya dan hasil ujian sudah dicetak/download
<br>
<br></center>
</body></html>