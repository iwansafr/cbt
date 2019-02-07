<?php
include "config/server.php";
$urut = $_GET['urut'];
$query=mysqli_query($sqlconn,"select * from cbt_ujian where Urut='$urut'");
?>
<html><head><title>Halaman Edit Status Token</title><head><body>
<form action="simpan_edit_status.php" method="post">
<table border="0">
<?php
while($row=mysqli_fetch_array($query)){
?>
<input type="Hidden" name="no" value="<?php echo $no;?>" />
<h2>Data Barang</h2>
<table><tr>
<td>Token</td>
<td>: <input type="text" name="tokenujian" value="<?php echo $row['XTokenUjian'];?>" size="10"></td>
</tr>
<tr>
<td>Status Token (0 / 1)</td>
<td>: <input type="text" name="statustoken" value="<?php echo $row['XStatusToken'];?>"size="1"></td> 
</tr>
<tr>
<td colspan=2><input type="submit" value="Update"></td>
</tr>

</table></form>
Fungsi kode ini adalah untuk menampilkan data yang kita klik ke dalam form yang akan kita edit nanti
value="<?php echo $row['XKodeSoal'];?>"
<?php } ?>
</body></html>
