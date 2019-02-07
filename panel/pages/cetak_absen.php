<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<html>
<head>
<title><?php echo $skull; ?>-CBT | Administrator</title>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="./js/jquery-1.4.js"></script>
<script src="date/jquery.js"></script>
<script src="./js/jquery.datetimepicker.full.js"></script>
<script type="text/javascript" src="./js/jquery.gdocsviewer.min.js"></script> 
<!--
<script type="text/javascript"> 
/*<![CDATA[*/
$(document).ready(function() {
	$('a.embed').gdocsViewer({width: 600, height: 750});
	$('#embedURL').gdocsViewer();
});
/*]]>*/
</script>
--> 
</head>
<body>
<iframe src="<?php echo "cetakabsen.php?kelas=$_REQUEST[iki1]&jur=$_REQUEST[jur1]&sesi=$_REQUEST[sesi1]&ruang=$_REQUEST[ruang1]&mapel=$_REQUEST[mapel1]&tanggal=$_REQUEST[tanggal1]&mulai=$_REQUEST[mulai1]&akhir=$_REQUEST[akhir1]"; ?>" style="display:none;" name="frame"></iframe>
	<button type="button" class="btn btn-default btn-sm" onClick="frames['frame'].print()" style="margin-top:4px; margin-bottom:5px"><i class="glyphicon glyphicon-print"></i> Print </button>
	<a href="#" data-toggle="modal" data-target="#myDaftarHadir">
			<button type="button" class="btn btn-success btn-sm" style="margin-top:5px; margin-bottom:5px">
				<i class="fa fa-search"></i> Print Daftar Hadir  Kelas Lain</i>
			</button>
	</a>	
	<a href="?">
			<button type="button" class="btn btn-success btn-sm" style="margin-top:5px; margin-bottom:5px">
				<i class="fa fa-home fa-fw"></i> Dashboard</i>
			</button>
	</a>	

<?php
//koneksi database
include "../../config/server.php";
$BatasAwal = 50;
 if(isset($_REQUEST['iki1'])){ 
$cekQuery = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa where XKodeKelas = '$_REQUEST[iki1]' and  XKodeJurusan = '$_REQUEST[jur1]'  and  XSesi = '$_REQUEST[sesi1]' and  XRuang = '$_REQUEST[ruang1]'  ");
}else{
$cekQuery = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa ");
}
$sqlad = mysqli_query($sqlconn,"select * from cbt_admin");
$ad = mysqli_fetch_array($sqlad);
$namsek = strtoupper($ad['XSekolah']);
$kepsek = $ad['XKepSek'];
$logsek = $ad['XLogo'];
								
								$tanggal = date('m/d/y', strtotime($_REQUEST['tanggal1']));		
															
								$timestamp = strtotime($tanggal);								
								$hari = date('l', $timestamp);
								$tgl = date('d', $timestamp);
								$bln = date('F', $timestamp);
								$thn = date('Y', $timestamp);
								
$jumlahData = mysqli_num_rows($cekQuery);
$jumlahn = 22;
$n = ceil($jumlahData/$jumlahn);
$nomz = 1;
for($i=1;$i<=$n;$i++){ ?>
	<div style="background:#999; height:1275px;" ><br>
	<div style="background:#fff; width:70%; margin:0 auto; padding:30px; height:90%;">
    <table border="0" width="100%">
        	 <tr>
			 <?php
							
								//Our DD-MM-YYYY date string.
								if($hari=='Sunday'){$hari = "Minggu";}
								elseif($hari=='Monday'){$hari = "Senin";}
								elseif($hari=='Tuesday'){$hari = "Selasa";}
								elseif($hari=='Wednesday'){$hari = "Rabu";}
								elseif($hari=='Thursday'){$hari = "Kamis";}
								elseif($hari=='Friday'){$hari = "Jum'at";}
								elseif($hari=='Saturday'){$hari = "Sabtu";}
								
								if($bln=='January'){$bln = "Januari";}
								elseif($bln=='February'){$bln = "Pebruari";}
								elseif($bln=='March'){$bln = "Maret";}
								elseif($bln=='April'){$bln = "April";}
								elseif($bln=='May'){$bln = "Mei";}
								elseif($bln=='June'){$bln = "Juni";}
								elseif($bln=='July'){$bln = "Juli";}
								elseif($bln=='August'){$bln = "Agustus";}
								elseif($bln=='September'){$bln = "September";}
								elseif($bln=='October'){$bln = "Oktober";}
								elseif($bln=='November'){$bln = "Nopember";}
								elseif($bln=='December'){$bln = "Desember";}
								
																?>    
    <td rowspan="1" width="100" align="left"><img src="../../images/<?php echo "$logsek"; ?>" width="100"></td>
    <td>
	<b><center><font size="3">DAFTAR HADIR PESERTA </font>
    <br><font size="3">UJAIAN SEKOLAH  BERBASIS KOMPUTER (USBK)</font>
	<br><font size="4"><?php echo $namsek; ?></font>
    <br><font size="2"><b>TAHUN PELAJARAN : <?php echo $_COOKIE['beetahun']; ?></b></font>
	</b>
	</center>
	<br>
 </td> 
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  </table><br>
    <table border="0" width="100%" style="margin-left:0px">
  <tr height="30">
  <td height="30" width="20%">Mata Pelajaran</td>
  <td height="30" width="2%">:</td>
  <td height="30" width="45%" ><?php echo "$_REQUEST[mapel1]"; ?> </td>
  <td height="30" width="1%"></td>
  
  <td height="30" width="15%" style="margin-left:10px"> Sesi / Ruang</td>
    <td height="30" width="2%"> : </td>
  <td height="30" width="15%"><?php echo "$_REQUEST[sesi1]"; ?> / <?php echo "$_REQUEST[ruang1]"; ?></td>
  </tr>
  </table>
  <table>
    <tr height="30">
  <td height="30" width="21%">Hari</td>
  <td height="30" width="2%">:</td>
  <td height="30" width="10%" ><?php echo $hari; ?> </td>
    <td height="30" width="5%">Tanggal </td>
  <td height="30" width="1%"> :</td>
  <td height="30" width="28%" ><?php echo $tgl; ?> <?php echo $bln; ?> <?php echo $thn; ?> </td>
  <td height="30" width="1%"></td>
  <td height="30" width="15%" style="margin-left:10px"> Pukul </td>
    <td height="30" width="2%">:</td>
  <td height="30" width="20%" ><?php echo "$_REQUEST[mulai1]"; ?> - <?php echo "$_REQUEST[akhir1]"; ?></td>
  </tr>
  
</table>
  	<br>
  <table border="1" width="100%">
  <tr bgcolor="#CCCCCC" height="40"><th width="5%" style="text-align: center;">No.</th><th width="13%" style="text-align: center;">No. Ujian</th><th width="30%" style="text-align: center;">Nama Siswa</th><th width="24%"style="text-align: center;">Tanda Tangan</th><th colspan="2" width="13%" style="text-align: center;">Ket</th></tr>
<?php
$mulai = $i-1;
$batas = ($mulai*$jumlahn);
$startawal = $batas;
$batasakhir = $batas+$jumlahn;

$s = $i-1;

?>
<?php
 if(isset($_REQUEST['iki1'])){ 
$cekQuery1 = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa where XKodeKelas = '$_REQUEST[iki1]' and  XKodeJurusan = '$_REQUEST[jur1]'  and  XSesi = '$_REQUEST[sesi1]' and  XRuang = '$_REQUEST[ruang1]' limit $batas,$jumlahn");
}else{
$cekQuery1 = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa limit $batas,$jumlahn");
}
while($f= mysqli_fetch_array($cekQuery1)){
 if ($nomz % 2 == 0) {
	  echo "<tr height=30px><td align='center'>&nbsp;$nomz.</td><td align='center'>$f[XNomerUjian]</td><td>&nbsp;$f[XNamaSiswa]</td><td align='center'>&nbsp;$nomz.</td><td align='center'>&nbsp;</td></tr>";
	  } else {
	  echo "<tr height=30px><td align='center'>&nbsp;$nomz.</td><td align='center'>$f[XNomerUjian]</td></center><td>&nbsp;$f[XNamaSiswa]</td><td align='left'>&nbsp;$nomz.</td><td align='center'>&nbsp;</td></tr>";
	  }
  $nomz++;
?>
<?php } ?>        
        </table>
		<br>
1. Daftar hadir di buat rangkap 2 (dua).<br>
2. Pengawas ruang menyilang Nama Peserta yang tidak hadir.
  <br>
  <br>
    <table width="100%">
    <tr><td width="60%" style="font-size: small;text-align: center;"></td>
    <td width="20%" style="font-size: small;text-align: center;"> Pengawas</td>
  <td width="20%" style="font-size: small;text-align: center;">Proktor</td></tr>
    </table>
  <table border="0" width="100%">
  <td width="30%" style="text-align: left;font-size: small; border-top:thin solid #000000;border-left: thin solid #000000;">&nbsp; Jumlah Peserta yang Seharusnya Hadir</td>
  <td width="2%" style="text-align: left;font-size: small; border-top:thin solid #000000"> : </td>
  <td width="10%" style="text-align: left;font-size: small; border-top:thin solid #000000; border-right: thin solid #000000;"> ______ orang</td></tr>
  <td width="30%" style="text-align: left;font-size: small;border-bottom:thin solid #000000;border-left: thin solid #000000;">&nbsp; Jumlah Peserta yang Tidak Hadir</td>
  <td width="2%" style="text-align: left;font-size: small;border-bottom:thin solid #000000"> : </td>
  <td width="10%" style="text-align: left;font-size: small;border-bottom:thin solid #000000; border-right: thin solid #000000;"> ______ orang</td>
  <td colspan="2" width="15%" style="text-align: left;font-size: small;text-align: center;"> </td>
  <td width="15%" style="text-align: left;font-size: small;text-align: center;"></td></tr>
    <td width="30%" style="text-align: left;font-size: small;border-bottom:thin solid #000000;border-left: thin solid #000000;">&nbsp; Jumlah Peserta yang Tidak Hadir</td>
  <td width="2%" style="text-align: left;font-size: small;border-bottom:thin solid #000000"> : </td>
  <td width="10%" style="text-align: left;font-size: small;border-bottom:thin solid #000000; border-right: thin solid #000000;"> ______ orang</td>
  </table>
      <table width="100%">
    <tr><td width="60%" style="font-size: small;text-align: center;"></td>
    <td width="20%" style="font-size: small;text-align: center;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
  <td width="20%" style="font-size: small;text-align: center;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td></tr>
    </table>
	    <table width="100%">
    <tr><td width="60%" style="font-size: small;text-align: center;"></td>
    <td width="20%" style="font-size: small;text-align: left;"> NIP.</td>
  <td width="20%" style="font-size: small;text-align: left;">NIP.</td></tr>
    </table>
</table>
    </div>
    </div>
<?php } ?>            
</body>
</html>