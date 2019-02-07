<?php
include "../../config/server.php";
include "kopstatus.php";



echo "

<table border=2><tr bgcolor=orange>
<td><b><center>No</td>
<td><b><center>MAPEL</td>
<td><b><center>KODE BANK SOAL</td>
<td><b><center>KELAS</td>
<td><b><center>TGL UJIAN</td>
<td><b><center>MULAI</td>
<td><b><center>TUTUP</td>
<td><b><center>DURASI</td>

<td><b><center>TOKEN</td>
<td><b><center>STATUS</td>
<td><b><center>UJIAN</td>
<td><b><center>DELETE</td>

</tr>";
$query=mysqli_query($sqlconn,"SELECT * FROM cbt_ujian ORDER BY Urut");
$no=1;
while($var=mysqli_fetch_array($query)){
echo "<tr>
<td><center>$no</td>
<td><center>$var[XKodeMapel]</td>
<td><center>$var[XKodeSoal]</td>
<td><center>$var[XKodeKelas]-$var[XKodeJurusan]</td>
<td><center>$var[XTglUjian]</td>
<td><center>$var[XJamUjian]</td>
<td><center>$var[XBatasMasuk]</td>
<td><center>$var[XLamaUjian]</td>

<td><center>$var[XTokenUjian]</td>
<td><center>$var[XStatusToken]</td>
<td><center>$var[XStatusUjian]</td>
<td><center><a href='deletedatabase.php?urut=$var[Urut]'>Hapus</a></td>


</tr>";
$no++;
}


echo "</table><br><b></b>";
include "kakistatus.php";
