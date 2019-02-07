<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $skull; ?>-CBT | Form Berita Acara</title>
</head>
<style>
.left {
    float: left;
    width: 75%;
}
.right {
    float: right;
    width: 23%;
}
.group:after {
    content:"";
    display: table;
    clear: both;
}
img {
    max-width: 100%;
    height: auto;
}
@media screen and (max-width: 480px) {
    .left, 
    .right {
        float: none;
        width: auto;
		margin-top:10px;		
    }
	
}
</style>
<script type="text/javascript" src="./js/jquery.gdocsviewer.min.js"></script> 
<!--
<script type="text/javascript"> 
/*<![CDATA[*/
$(document).ready(function() {
	$('a.embed').gdocsViewer({width: 800, height: 750});
	$('#embedURL').gdocsViewer();
});
/*]]>*/
</script> 
-->
    <link href="css/nedna.css" rel="stylesheet">

<body style="width:100%; margin:0 auto;margin-top:0px; ">
<?php

//koneksi database
include "../../config/server.php";
$sqlad = mysqli_query($sqlconn,"select * from cbt_admin");

$ad = mysqli_fetch_array($sqlad);
$namsek = strtoupper($ad['XSekolah']);
$kepsek = $ad['XKepSek'];
$kab = $ad['XKab'];
$prop = $ad['XProp'];
$kec = $ad['XKec'];
$nipadmin = $ad['XNIPAdmin'];
$nipkepsek = $ad['XNIPKepsek'];
$logsek = $ad['XLogo'];

$BatasAwal = 50;
$sql1 = mysqli_query($sqlconn,"select * from inf_lokasi where lokasi_kabupatenkota='$kab' and lokasi_propinsi='$prop' and lokasi_kecamatan='0000' and lokasi_kelurahan='0000'");
$xadm1 = mysqli_fetch_array($sql1);
$xkab= $xadm1['lokasi_nama'];


								$sqk = mysqli_query($sqlconn,"select * from cbt_ujian where XTokenUjian = '$_REQUEST[token]' ");
								$rs = mysqli_fetch_array($sqk);
								$tanggal = "$rs[XTglUjian]";
								$kelas = "$rs[XKodeKelas]";
								$jurus = "$rs[XKodeJurusan]";
								$proktor = "$rs[XProktor]";
								$nipp = "$rs[XNIPProktor]";
								$pengawas = "$rs[XPengawas]";
								$nip = "$rs[XNIPPengawas]";
								$cat = "$rs[XCatatan]";
								$sesi = "$rs[XSesi]";
								
								$timestamp = strtotime($tanggal);								
								$hari = date('l', $timestamp);
								$tgl = date('d', $timestamp);
								$bln = date('F', $timestamp);
								$bln2 = date('m', $timestamp);
								$thn = date('Y', $timestamp);
								$jamawal = $rs['XJamUjian'];
								$j1 = substr($jamawal,0,2);
								$m1 = substr($jamawal,3,2);
								$d1 = substr($jamawal,6,2); // pecah xmulaiujian ambil dari jamsekarang
								$jam1 = "$j1:$m1";								
	
	
$j2 = substr($rs['XLamaUjian'],0,2);
$m2 = substr($rs['XLamaUjian'],3,2);
$d2 = substr($rs['XLamaUjian'],6,2);
$selectedTime = "$j1:$m1:$d1";

$j3 = $j2*60;
$m3 = $m2;
$jummenit = $j3+$m3;
$jum_menit = "+$j2 hour +$m2 minutes";

$minutes_to_add = $jum_menit;

//set timezone
//date_default_timezone_set('GMT');

//set an date and time to work with
$start = "$thn-$bln2-$tgl $j1:$m1:$d1";
//display the converted time
$habis = date('H:i',strtotime($jum_menit,strtotime($start)));

if(!$kelas=="ALL"&&!$jurus=="ALL"){ 
$kondisi = "1";
$cekQuery = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa where XKodeKelas = '$kelas' and XKodeJurusan = '$jurus'");
}elseif(!$kelas=="ALL"&&$jurus=="ALL"){ 
$kondisi = "2";
$cekQuery = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa where  XKodeKelas = '$kelas'");
}elseif($kelas=="ALL"&&!$jurus=="ALL"){ 
$kondisi = "3";
$cekQuery = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa where  XKodeJurusan = '$jurus'");
}elseif($kelas=="ALL"&&$jurus=="ALL"){ 
$kondisi = "4";
$cekQuery = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa");
} else {
$kondisi = "5";
$cekQuery = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa where XKodeKelas = '$kelas' and XKodeJurusan = '$jurus'");
}

$ikutSiswa = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa_ujian where XTokenUjian = '$rs[XTokenUjian]'");


$jumlahSiswaSemua = mysqli_num_rows($cekQuery);
$jumlahSiswaUjian = mysqli_num_rows($ikutSiswa);
$jumlahSiswaAbsen = $jumlahSiswaSemua-$jumlahSiswaUjian;
?>

	<div style="background:#fff; width:100%; margin:0 auto; height:90%;">
    <table border="0" width="95%">
    <tr>
    <br>
							<?php
							
								//Our YYYY-MM-DD date string.
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
								elseif($bln=='Octocber'){$bln = "Oktober";}
								elseif($bln=='November'){$bln = "Nopember";}
								elseif($bln=='December'){$bln = "Desember";}
								
																?>                                

    <td rowspan="4" width="150" align="right"><img src="../../images/<?php echo "$logsek"; ?>" width="100"></td>
    <td colspan="2"  align="center"><font size="3"><b>BERITA ACARA PELAKSANAAN</b></font></td>
    <td rowspan="6" width="60" align="center"></td>
    </tr>
    <tr>
    <td colspan="2" align="center"><font size="3"><b>UJIAN SEKOLAH BERBASIS KOMPUTER (USBK)</b></font></td>
    </tr>
    <tr>
    <td colspan="2" align="center"><font size="5"><b><?php echo "$namsek"; ?></b></font></td>
    </tr>    
    <tr>
    <td colspan="2" align="center"><font size="2"><b>TAHUN PELAJARAN : <?php echo $_COOKIE['beetahun']; ?></b></font></td>
    </tr>    
  <tr>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td >&nbsp;</td>
  </tr>
   
   <!-- <tr>

   								 <?php 
								$sqk2 = mysqli_query($sqlconn,"select * from cbt_mapel where XKodeMapel = '$rs[XKodeMapel]'");
								$rs1 = mysqli_fetch_array($sqk2);
                             	$rs2 = strtoupper("$rs1[XNamaMapel]");
								$NilaiKKM2 = $rs1['XKKM'];
								?>   
    <td width="20%">Mata Pelajaran</td><td>: <b><?php echo $rs2; ?> (Nilai KKM : <?php echo $NilaiKKM2; ?>)</b></td>
    </tr>
    <tr>
    <td>Kelas | Jurusan</td><td>: <b><?php echo $rs['XKodeKelas']; ?> | <?php echo $rs['XKodeJurusan']; ?></b></td>
    </tr>

  <tr>
    <td>Tahun Akademik </td><td>: <?php echo $_COOKIE['beetahun']; ?></td>
  </tr>
  
  !-->
  <tr>
    <td colspan="4"></td>
  </tr>
  <tr>
    <td colspan="4"></td>
  </tr>
  </table>
  
  <table border="0" width="95%" align="center" >
  <tr height="30">
  <td height="30" colspan="4">Pada hari ini <?php echo $hari; ?> tanggal <?php echo $tgl; ?> bulan <?php echo $bln; ?> tahun <?php echo $thn; ?>, di <?php echo "$namsek"; ?> 
  <?php echo "$xkab"; ?> telah diselenggarakan Ujian Sekolah Berbasis Komputer (USBK) untuk mata pelajaran <?php echo $rs2; ?> dari pukul 
  <?php echo $jam1; ?> sampai dengan pukul <?php echo $habis; ?></td>
	</tr>
  </table>
  <br>
  <table border="0" width="95%" align="center">
  <tr height="30">
  <td height="30" width="5%">1.</td>
  <td height="30" width="30%">Username</td>
  <td height="30" width="60%" style="border-bottom:thin solid #000000"><?php echo "$ad[XKodeSekolah]"; ?></td>
  </tr>
  <tr height="30">
  <td height="30" width="10px"></td>
  <td height="30">Sekolah/Madrasah</td>
  <td height="30" width="60%" style="border-bottom:thin solid #000000"><?php echo "$namsek"; ?></td>  
  </tr>
  <tr height="30">
  <td height="30" width="10px"></td>
  <td height="30">Sesi</td>
  <td height="30" width="60%" style="border-bottom:thin solid #000000"><?php echo "$rs[XSesi]"; ?></td>  
  </tr>
  <tr height="30">
  <td height="30" width="10px"></td>
  <td height="30">Jumlah Peserta Seharusnya</td>
  <td height="30" width="60%" style="border-bottom:thin solid #000000"><?php echo "$jumlahSiswaSemua"; ?></td>  
  </tr>
  <tr height="30">
  <td height="30" width="10px"></td>
  <td height="30">Jumlah Hadir (ikut ujian)</td>
  <td height="30" width="60%" style="border-bottom:thin solid #000000"><?php echo "$jumlahSiswaUjian"; ?></td>  
  </tr>
  <tr height="30">
  <td height="30" width="10px"></td>
  <td height="30">Jumlah Tidak Hadir</td>
  <td height="30" width="60%" style="border-bottom:thin solid #000000"><?php echo "$jumlahSiswaAbsen"; ?></td>  
  </tr>
  <tr height="30">
  <td height="30" width="10px"></td>
  <td height="30">Nomer</td>
  <td height="30" width="60%" style="border-bottom:thin solid #000000"></td>  
  </tr>
   <tr height="30">
  <td height="30" width="10px"></td></tr>    
  <tr height="30">
  <td height="30" width="5%">2.</td>
  <td colspan="2" height="30" width="30%">Catatan selama Ujian Sekolah Berbasis Komputer (USBK) </td>
  </tr>
  <tr height="30">
  <td height="30" width="10px"></td>
  <td colspan="2" height="30" width="60%" style="border-bottom:thin solid #000000"><?php echo "$rs[XCatatan]"; ?></td>  
  </tr>
  <tr height="30">
  <td height="30" width="10px"></td>
  <td colspan="2" height="30" width="60%" style="border-bottom:thin solid #000000"></td>   
  </tr>
  <tr height="30">
  <td height="30" width="10px"></td>
  <td colspan="2" height="30" width="60%" style="border-bottom:thin solid #000000"></td>    
  </tr>
  <tr height="30">
  <td height="30" width="10px"></td>
  <td colspan="2" height="30" width="60%" style="border-bottom:thin solid #000000"></td>   
  </tr>
  <tr height="30">
  <td height="30" width="10px"></td>
  <td colspan="2" height="30" width="60%" style="border-bottom:thin solid #000000"></td>   
  </tr>
  <tr height="30">
  <td height="30" width="10px"></td></tr>    
  <tr height="30">
  <td height="30" colspan="2" width="5%">Yang membuat berita acara : </td></tr>
  </table>
  
  <table border="0" width="80%" style="margin-left:50px">  
  <tr><td colspan="4" ></td>
  <td height="30" width="30%">TTD</td>
  </tr>
  <tr><td width="10%">1. </td><td width="20%">Proktor</td><td width="30%" style="border-bottom:thin solid #000000"><?php echo $proktor; ?></td>
  <td height="30" width="5%"></td><td height="30" width="35%"></td>
  </tr>
  <tr><td width="10%">   </td><td width="20%">NIP. </td><td width="30%" style="border-bottom:thin solid #000000"><?php echo $nipp; ?></td>
  <td height="30" width="5%"></td><td height="30" width="35%" style="border-bottom:thin solid #000000">  1. </td>
  </tr>
  <tr><td width="10%">2. </td><td width="20%">Pengawas</td><td width="30%" style="border-bottom:thin solid #000000"><?php echo $pengawas; ?></td>
  <td height="30" width="5%"></td><td height="30" width="35%"></td>
  </tr>
  <tr><td width="10%">   </td><td width="20%">NIP. </td><td width="30%" style="border-bottom:thin solid #000000"><?php echo $nip; ?></td>
  <td height="30" width="5%"></td><td height="30" width="35%" style="border-bottom:thin solid #000000">  2. </td>
  </tr>
  <tr><td width="10%">3. </td><td width="20%">Kepala Sekolah</td><td width="30%" style="border-bottom:thin solid #000000"><?php echo $ad['XKepSek']; ?></td>
  <td height="30" width="5%"></td><td height="30" width="35%"></td>
  </tr>
  <tr><td width="10%">   </td><td width="20%">NIP. </td><td width="30%" style="border-bottom:thin solid #000000"><?php echo $ad['XNIPKepsek']; ?></td>
  <td height="30" width="5%"></td><td height="30" width="35%" style="border-bottom:thin solid #000000">  3. </td>
  </tr>
  
  </table> 
</body>
</html>