<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
	include "../../config/server.php"; 
	
?>

<!DOCTYPE html>
<html lang="en">

<head><link href='../../images/icon.png' rel='icon' type='image/png'/>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $skull; ?>-CBT | Administrator</title>
<script language="JavaScript">
var txt="<?php echo $skull; ?>-CBT| Administrator.....";
var kecepatan=100;var segarkan=null;function bergerak() { document.title=txt;
txt=txt.substring(1,txt.length)+txt.charAt(0);
segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
</script>

</head>
		<script src="js/jquery-excel.min.js"></script>
		<script src="../src/jquery.table2excel.js"></script>
<body>
<?php 
$soal = $_REQUEST['soal'];
$sql0 = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_soal where XKodeSoal = '$soal' and XJenisSoal = '1' order by XNomerSoal"));
$jumkol = $sql0+7;
$sqlsoalan = mysqli_query($sqlconn,"select * from cbt_soal s left join cbt_mapel m on s.XKodeMapel = m.XKodeMapel 
						where s.XKodeSoal = '$soal'");
						$ss = mysqli_fetch_array($sqlsoalan);
						$mapelz = $ss['XNamaMapel']; 
						?>

<table class="table2excel" data-tableName="Test Table 1">
<tr align=center height=50px >
<td width='50px' bgcolor='#999' colspan=" <?php echo $jumkol; ?>">Analisa Butir Soal <?php echo "$soal Mapel : $mapelz"; ?></td>
</td>
<tr align=center height=50px >
<td width='50px' bgcolor='#999' style='border-left:thin solid #000; border-right:thin solid #000; border-top:thin solid #000;  border-bottom:thin solid #000'>NO</td>
<td bgcolor='#999' style='border-right:thin solid #000; border-top:thin solid #000;  border-bottom:thin solid #000'  width='100px'>NIS</td><td bgcolor='#999' style='border-right:thin solid #000; border-top:thin solid #000;  border-bottom:thin solid #000'  width='550px'>Nama Siswa </td>
<?php 
$sql = mysqli_query($sqlconn,"select * from cbt_soal where XKodeSoal = '$soal' and XJenisSoal = '1' order by XNomerSoal");
$no =1;
while($s = mysqli_fetch_array($sql)){ 
echo "<td bgcolor='#999'  style='border-right:thin solid #000; border-top:thin solid #000;  border-bottom:thin solid #000' width='50px'>$s[XNomerSoal]</td>
";
$no++;
}						
/*echo "<td bgcolor='#999' style='border-right:thin solid #000; border-top:thin solid #000;  border-bottom:thin solid #000' width='80px'>BENAR</td><td bgcolor='#999' style='border-right:thin solid #000; border-top:thin solid #000;  border-bottom:thin solid #000' width='80px'>SALAH</td><td bgcolor='#999' style='border-right:thin solid #000; border-top:thin solid #000;  border-bottom:thin solid #000' width='100px'>SKOR TOTAL</td><td bgcolor='#999'  style='border-right:thin solid #000;  border-bottom:thin solid #000; border-top:thin solid #000;' width:'100px'>KETERANGAN</td></tr>";
*/
//jawaban siswa
$sqljwb = mysqli_query($sqlconn,"select * from cbt_jawaban j left join cbt_siswa s on s.XNomerUjian = j.XUserJawab where XKodeSoal = '$soal' 
and j.XJenisSoal = '1' group by XUserJawab order by XUserJawab");
$nom =1;
					$sqlujian = mysqli_query($sqlconn,"select * from cbt_ujian where XKodeSoal = '$soal' ");
					$su = mysqli_fetch_array($sqlujian); 
					$jumsoal = $su['XPilGanda'];
					$mapel = $su['XKodeMapel'];


while($sj = mysqli_fetch_array($sqljwb)){ 

echo "<tr height=30px style='border-bottom:thin solid #000; '><td style='border-right:thin solid #000; border-left:thin solid #000;  border-bottom:thin solid #000' align=right>$nom &nbsp;</td>
<td style='border-right:thin solid #000;  border-bottom:thin solid #000 '>&nbsp; $sj[XNIK]</td>
<td style='border-right:thin solid #000;  border-bottom:thin solid #000 '>&nbsp; $sj[XNamaSiswa]</td>";
		$sql0 = mysqli_query($sqlconn,"select * from cbt_soal where XKodeSoal ='$soal'  and XJenisSoal = '1' order by XNomerSoal");
		while($s0 = mysqli_fetch_array($sql0)){ 
				if($s0['XKategori']==1){$bg = "#20bc10";}
				elseif($s0['XKategori']==2){$bg = "#f8c207";}
				elseif($s0['XKategori']==3){$bg = "#f80723";}
												
		echo "<td align=center width=50px style='border-right:thin solid #000;color:$bg;  border-bottom:thin solid #000' >";
						
	$sql1 = mysqli_query($sqlconn,"select * from cbt_jawaban where XUserJawab = '$sj[XUserJawab]' and XNomerSoal = '$s0[XNomerSoal]' and XKodeSoal = '$soal' ");
					while($s1 = mysqli_fetch_array($sql1)){ 
					echo "<b>$s1[XNilai]</b>";
					}				
			
					echo "</td>";			

					$sql2 = mysqli_query($sqlconn,"select sum(XNilai) as skor2 from cbt_jawaban where XUserJawab = '$sj[XUserJawab]' and XKodeSoal = '$soal' and XJenisSoal = '1'");
					$s2 = mysqli_fetch_array($sql2);
					$skor = $s2['skor2'];

					$nilai = ($skor/$jumsoal)*100;
					$nilaine = number_format($nilai,2,',','.');
					$salah = $jumsoal-$skor;

					$sqlkkm = mysqli_query($sqlconn,"select * from cbt_mapel where XKodeMapel = '$mapel'");
					$sk = mysqli_fetch_array($sqlkkm); 
					$kkm = $sk['XKKM'];
					
					if($nilai>=$kkm){$sta = "TUNTAS";} else {$sta = "BELUM TUNTAS";}

$kolom = 6+$jumsoal;
		}			
echo "<td align=center style='border-right:thin solid #000;  border-bottom:thin solid #000 '>$skor</td>
<td align=center style='border-right:thin solid #000;  border-bottom:thin solid #000 '>$salah</td><td align=center style='border-right:thin solid #000;  border-bottom:thin solid #000'>$nilaine</td><td align=center style='border-right:thin solid #000;  border-bottom:thin solid #000 '>$sta</td></tr>";
$nom++;
}						
echo "</tr></table>";
		
?>
                                   
                                </tbody >
                            </table>

		<script>
			$(function() {
				$(".table2excel").table2excel({
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: "<?php echo "Analisa $soal $mapelz"; ?>",
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
				});
			});
		</script>
</body>

</html>
