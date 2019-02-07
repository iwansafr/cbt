<?php
include "../../config/server.php";
$urut = $_GET['urut'];
$query=mysqli_query($sqlconn,"select * from cbt_ujian where Urut='$urut'");

 								
?>
<html><head>
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
   
</head><body bgcolor=#F8FFBF>

<form action="status_simpanedit.php" method="post">
<center><table border="0">
<?php
while($row=mysqli_fetch_array($query)){
?>
<input type="Hidden" name="no" value="<?php echo $no;?>" />
<br>
<br>
<h1>Halaman Edit Status Token</h1>
<table border="4"><tr bgcolor=orange>
<td>Token</td>
<td >: <input type="text"  name="tokenujian" value="<?php echo $row['XTokenUjian'];?>" size="6"></td>
</tr>

<tr bgcolor=orange>
<td>Status Token harus antara (0 / 1)</td><td>:
 <select name="statustoken" class="form-control">
								<?php 
								echo "<option value='$row[XStatusToken]' selected>$row[XStatusToken]</option>";
								?>
								<option value='0'>0</option>
								<option value='1'>1</option>
								
                                </select>  
 </td> 
</tr>
<tr bgcolor=orange>
<td colspan=2><input type="submit" value="Update"></td>
</tr>
 
								
</table>

</form>
<div> 
<br>
</div>

<div><td><br>
Ubah value (isian) Status Token menjadi 1 untuk menampilkan Token pada layar monitor Siswa, kosong atau 
</center>
<?php } ?>
</body></html>