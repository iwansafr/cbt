<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
	include "../../config/server.php";
?>
<html>
<head>
<title><?php echo "$skull";?>-CBT | Cetak Kartu</title>

</head>
<body>
<style>@media print {
    footer {page-break-after: always;}
}
</style>
<?php

function kartu($am,$kokel,$kojur) {
$sqlam = mysqli_query($sqlconn,"
select * from (select * from cbt_siswa where XKodeKelas = '$kokel' and XKodeJurusan='$kojur' order by Urut  limit $am) as ambil order by Urut Desc limit 1");
$a = mysqli_fetch_array($sqlam);

$sqlad = mysqli_query($sqlconn,"select * from cbt_admin");
$ad = mysqli_fetch_array($sqlad);
$namsek = $ad['XSekolah'];
$kepsek = $ad['XKepSek'];
$logsek = $ad['XLogo'];
$skul_tkt= $ad['XTingkat']; 
if ($skul_tkt=="SMA" || $skul_tkt=="MA"||$skul_tkt=="STM"){$rombel="Jurusan";}else{$rombel="Rombel";}

if(str_replace(" ","",$a['XFoto'])==""){$pic = "nouser.png";}else{$pic="$a[XFoto]";}
?>
<table style="width:10.2cm;border:1px solid black; padding-top:6px; font-family:Arial, Helvetica, sans-serif; font-size:12px" class="kartu" border="0">
					<tbody>
                    <tr>
						<td colspan="4" style="padding:1px" align="center">
							<table width="98%" class="kartu" cellpadding="0px">
							<tbody><tr>
								<td><img src="../../images/<?php echo $logsek; ?>" height="48"></td>
								<td align="center" style="font-weight:bold;"><font size="3">
									KARTU PESERTA USBK <?php echo $_COOKIE['beetahun']; ?></font> 
																
									<br><font size="2">(UJIAN SEKOLAH BERBASIS KOMPUTER) </font></br>
							  </td></td>
							</tr>
							</tbody></table>
						</td>
					</tr>
			<tr height="10px"><td width="90">&nbsp;Nama Peserta</td><td width="8">:</td><td width="226" style="font-size:12px;font-weight:bold;"><?php echo $a['XNamaSiswa']; ?></td></tr>
			<tr height="10px"><td>&nbsp;Kelas - <?php echo $rombel;?></td><td>:</td><td style="font-size:12px;font-weight:bold;"><?php echo "$a[XKodeKelas] - $kojur"; ?></td></tr>    
			<tr height="10px"><td>&nbsp;Sesi - Ruang</td><td>:</td><td style="font-size:12px;font-weight:bold;">
			<?php echo "$a[XSesi] - $a[XRuang]"; ?></td></tr>                      
			<tr height="10px"><td >&nbsp;Username</td><td>:</td><td style="font-size:12px;font-weight:bold;"><?php echo $a['XNomerUjian']; ?></td></tr>
			<tr height="10px"><td>&nbsp;Password</td><td>:</td><td style="font-size:12px;font-weight:bold;"><?php echo $a['XPassword']; ?></td></tr>
			<tr height="10px"><td rowspan="3" align="center"><img src="../../fotosiswa/<?php echo $pic; ?>" height="60px" border="thin solid red"></td>

            <td colspan="2" valign="top" align="center">KEPALA<br><?php echo $namsek; ?></td></tr>                   
			<td style="font-size:12px;font-weight:bold;" colspan="2" align="center">Ttd ,</td></tr>
					<tr><td colspan="2" align="center"><?php echo $kepsek; ?></td></tr>
                    
				</tbody></table>
<?php        
}
?>

<?php
//koneksi database
include "../../config/server.php";
$BatasAwal = 20;

if(isset($_REQUEST['kelas'])&&isset($_REQUEST['jur'])){ 
$cekQuery = mysqli_query($sqlconn,"
SELECT * FROM cbt_siswa where XKodeKelas = '$_REQUEST[kelas]' and  XKodeJurusan = '$_REQUEST[jur]' ");
} else {
$cekQuery = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa"); 
}

$jumlahData = mysqli_num_rows($cekQuery);
$jumlahn = 10;
$n = ceil($jumlahData/$jumlahn);

for($i=1;$i<=$n;$i++){ ?>
<?php
$mulai = $i-1;
$batas = ($mulai*$jumlahn);
$startawal = $batas;
$batasakhir = $batas+$jumlahn;
$kokelz = "$_REQUEST[kelas]";
$kojurz = "$_REQUEST[jur]";

?>
		<table width="100%" border="0" style="margin-top:8px;">
        <tr><td><?php if($startawal+1<=$jumlahData){kartu($startawal+1,$kokelz,$kojurz);} ?></td>
        <td><?php if($startawal+6<=$jumlahData){kartu($startawal+6,$kokelz,$kojurz);} ?></td></tr>
        <tr><td><?php if($startawal+2<=$jumlahData){kartu($startawal+2,$kokelz,$kojurz);} ?></td>
        <td><?php if($startawal+7<=$jumlahData){kartu($startawal+7,$kokelz,$kojurz);} ?></td></tr>
        <tr><td><?php if($startawal+3<=$jumlahData){kartu($startawal+3,$kokelz,$kojurz);} ?></td>
        <td><?php if($startawal+8<=$jumlahData){kartu($startawal+8,$kokelz,$kojurz);} ?></td></tr>
        <tr><td><?php if($startawal+4<=$jumlahData){kartu($startawal+4,$kokelz,$kojurz);} ?></td>
        <td><?php if($startawal+9<=$jumlahData){kartu($startawal+9,$kokelz,$kojurz);} ?></td></tr>
        <tr><td><?php if($startawal+5<=$jumlahData){kartu($startawal+5,$kokelz,$kojurz);} ?></td>
        <td><?php if($startawal+10<=$jumlahData){kartu($startawal+10,$kokelz,$kojurz);} ?></td></tr>        
        </table>
<?php } ?>
</body>
</html>