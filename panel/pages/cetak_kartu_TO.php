<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<html>
<head>
<title><?php echo $skull; ?>-CBT | Administrator</title>
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
</head>
<body>
<!-- <iframe src="print_kartu.php" style="display:none;" name="frame"></iframe> !-->
<?php echo "Cetak Kartu Try Out Kelas : $_REQUEST[iki2] - $_REQUEST[jur2] "; ?>&nbsp;&nbsp;&nbsp;&nbsp;
<iframe src="<?php echo "print_kartu_to.php?kelas=$_REQUEST[iki2]&jur=$_REQUEST[jur2]"; ?>" style="display:none;" name="frame"></iframe>
<button type="button" class="btn btn-default btn-sm" onClick="frames['frame'].print()" style="margin-top:3px; margin-bottom:4px">
<i class="glyphicon glyphicon-print"></i> Print
</button>

		<a href="#" data-toggle="modal" data-target="#myCetakKartuTO">
			<button type="button" class="btn btn-success btn-sm" style="margin-top:5px; margin-bottom:5px">
				<i class="fa fa-search"></i> Print Kartu Try Out Lain</i>
			</button>
		</a>	
		
		<a href="?">
			<button type="button" class="btn btn-success btn-sm" style="margin-top:5px; margin-bottom:5px">
				<i class="fa fa-home fa-fw"></i> Dashboard</i>
			</button>
		</a>	
		
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
<table style="width:100%;border:1px solid black; padding:55px; font-family:Arial, Helvetica, sans-serif; font-size:12px" class="kartu" border="0">
					<tbody>
                    <tr>
						<td colspan="3" style="border-bottom:1px solid black; padding:2px" align="center">
							<table width="98%" class="kartu" cellpadding="10px">
							<tbody><tr>
								<td><img src="../../images/<?php echo $logsek; ?>" height="50"></td>
								<td align="center" style="font-weight:bold">
									<font size="2">KARTU PESERTA UTBK <?php echo $_COOKIE['beetahun']; ?></font> 
									<br><font size="1">(UJIAN TRY-OUT BERBASIS KOMPUTER) </font></br>
							  </td>
							</tr>
							</tbody></table>
						</td>
					</tr>
			<tr height="20px"><td width="90">&nbsp;Nama Peserta </td><td width="8">:</td><td width="226" style="font-size:12px;font-weight:bold;">
			<?php echo "$a[XNamaSiswa] "; ?></td></tr>
			<tr height="20px"><td>&nbsp;Kelas-<?php echo $rombel;?> </td><td>:</td><td style="font-size:12px;font-weight:bold;">
			<?php echo "$a[XKodeKelas] - $kojur"; ?></td></tr>            
			<tr height="20px"><td>&nbsp;Sesi - Ruang</td><td>:</td><td style="font-size:12px;font-weight:bold;">
			<?php echo "$a[XSesi] - $a[XRuang]"; ?></td></tr>            
			<tr height="20px"><td height="25px">&nbsp;Username</td><td>:</td><td style="font-size:12px;font-weight:bold;">
			<?php echo "$a[XNomerUjian]"; ?></td></tr>
			<tr height="20px"><td>&nbsp;Password</td><td>:</td><td style="font-size:12px;font-weight:bold;"><?php echo $a['XPassword']; ?></td></tr>
			<tr height="76px"><td rowspan="3" align="center"><img src="../../fotosiswa/<?php echo $pic; ?>" height="76px" border="thin solid red"></td>

            <td colspan="2" valign="top" align="center">KEPALA<br><?php echo $namsek; ?></td></tr>                   
			<td style="font-size:12px;font-weight:bold;" colspan="2" align="center">Ttd ,</td></tr>
					<tr><td colspan="2" align="center"><?php echo $kepsek; ?></td></tr>
                    
				</tbody></table>
<?php        
}

//koneksi database
include "../../config/server.php";
$BatasAwal = 50;

if(isset($_REQUEST['iki2'])&&isset($_REQUEST['jur2'])){ 
$cekQuery = mysqli_query($sqlconn,"
SELECT * FROM cbt_siswa where XKodeKelas = '$_REQUEST[iki2]' and  XKodeJurusan = '$_REQUEST[jur2]' ");
} else {
$cekQuery = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa"); 
}
//$cekQuery = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa");
$jumlahData = mysqli_num_rows($cekQuery);
$jumlahn = 10;
$n = ceil($jumlahData/$jumlahn);

for($i=1;$i<=$n;$i++){ ?>
	<div style="background:#999; height:1450px;" ><br>
	<div style="background:#fff; width:70%; margin:0 auto; padding:30px; height:98%;">
<?php
$mulai = $i-1;
$batas = ($mulai*$jumlahn);
$startawal = $batas;
$batasakhir = $batas+$jumlahn;
$kokelz = "$_REQUEST[iki2]";
$kojurz = "$_REQUEST[jur2]";
?>
		<table width="100%" border="0">
			<tr><td width="50%"><?php if($startawal+1<=$jumlahData){kartu($startawal+1,$kokelz,$kojurz);} ?></td>
			<td width="50%"><?php if($startawal+6<=$jumlahData){kartu($startawal+6,$kokelz,$kojurz);} ?></td></tr>
			<tr><td width="50%"><?php if($startawal+2<=$jumlahData){kartu($startawal+2,$kokelz,$kojurz);} ?></td>
			<td width="50%"><?php if($startawal+7<=$jumlahData){kartu($startawal+7,$kokelz,$kojurz);} ?></td></tr>
			<tr><td width="50%"><?php if($startawal+3<=$jumlahData){kartu($startawal+3,$kokelz,$kojurz);} ?></td>
			<td width="50%"><?php if($startawal+8<=$jumlahData){kartu($startawal+8,$kokelz,$kojurz);} ?></td></tr>
			<tr><td width="50%"><?php if($startawal+4<=$jumlahData){kartu($startawal+4,$kokelz,$kojurz);} ?></td>
			<td width="50%"><?php if($startawal+9<=$jumlahData){kartu($startawal+9,$kokelz,$kojurz);} ?></td></tr>
			<tr><td width="50%"><?php if($startawal+5<=$jumlahData){kartu($startawal+5,$kokelz,$kojurz);} ?></td>
			<td width="50%"><?php if($startawal+10<=$jumlahData){kartu($startawal+10,$kokelz,$kojurz);} ?></td></tr>        
        </table>
    </div>
    </div>
<?php } ?>
</body>
</html>