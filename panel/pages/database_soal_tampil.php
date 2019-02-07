<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}

include "../../config/server.php";
if($_REQUEST['aksi']=="tampil"){
$sql0 = mysqli_query($sqlconn,"select p.*,m.*,p.Urut as Urutan from cbt_paketsoal p left join cbt_mapel m on m.XKodeMapel = p.XKodeMapel where p.XGuru = '$_COOKIE[beelogin]' order by p.Urut desc");
?>

<table width="100%">
<tr>
<th>No.</th>
<th>Bank Soal</th>
<th>Mata Pelajaran</th>
<th>Level</th>
<th>Jum.Soal</th>
<th align="center">Pil.Jawab</th>
<th>Acak</th>
</tr>

<?Php
$no=1;

while($xadm = mysqli_fetch_array($sql0)){
$sqlsoal = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_soal where XKodeSoal = '$xadm[XKodeSoal]'"));
if($sqlsoal<1){$kata="disabled";}  else {$kata="";}
echo "<tr height=40 style='border=0; border-bottom:thin solid #dcddde'><td>$no</td><td>$xadm[XKodeSoal]</td><td>$xadm[XNamaMapel]</td><td>$xadm[XLevel]</td>
<td align=center>$sqlsoal</td><td>$xadm[XJumPilihan]</td><td>$xadm[XAcakSoal]</td></tr>";

$no++;

}?>

</table>

<?php } ?>

<style>.tombol  
/* Or better yet try giving an ID or class if possible*/
{
 border: 0;
 background: #66bda8;
 box-shadow:none;
 color:#FFF;
 text-decoration:none;
 padding:5px;
 width:80px;
 border-radius: 0px;
}</style>
