<?php
if(!isset($_COOKIE['beeuser'])){header("Location: login.php");}
include "../../config/server.php";

		$skul_pic= $log['XLogo'];
		$admpic= $log['XPicAdmin']; 
		$skul_ban= $log['XBanner']; 
		$skul_tkt= $log['XTingkat']; 
		$skul_warna= $log['XWarna']; 
		$skul_adm= strtoupper($log['XAdmin']); 
		$status_server = 1;
		
if ($zo == "Asia/Jakarta"){$w ="WIB";} elseif($zo == "Asia/Makassar"){$w ="WITA";} else{$w ="WIT";}
		
if(isset($_REQUEST['simpan5'])){
		$sql = mysqli_query($sqlconn,"update cbt_server set XServer='$_REQUEST[server1]' where id = '1'");
		$sqlzona = mysqli_query($sqlconn,"update cbt_zona set XZona='$_REQUEST[zona1]'");
		$sqlheader = mysqli_query($sqlconn,"update cbt_header set Header='$_REQUEST[header]', HeaderUjian='$_REQUEST[headerujian]', XNilaiKelas='$_REQUEST[nilaikelas]', HakAkses='$_REQUEST[hakakses]'");
}
	
if(isset($_REQUEST['simpan_bd'])){
	$teks0=$_REQUEST["db_server"];
	$teks1="<?php ";
	$teks2="\$db_server=\"";
	$teks3="\";";
	$db_server =$teks1.$teks2.$teks0.$teks3;
	$file = fopen("../../config/db_server.php","w");    
			if($file){fputs($file,$db_server);}
			fclose($file); 
header("Location: logout.php");
	}		

	$xadm5 = mysqli_fetch_array(mysqli_query($sqlconn,"select * from cbt_server"));
		$xserver= $xadm5['XServer'];
	
		
	$hdr = mysqli_fetch_array(mysqli_query($sqlconn,"select * from cbt_header"));
		$header= $hdr['Header'];	
		$headerujian =$hdr['HeaderUjian'];
		$nilaikelas =$hdr['XNilaiKelas'];
		$hakakses =$hdr['HakAkses'];
											
	$serv = php_uname('n');
	if (!$sqlconn) {$status_server='0'; die('Could not connect: ' . mysqli_error());}
		$a = mysqli_get_server_info();
		$b = substr($a, 0, strpos($a, "-"));
		$b = str_replace(".","",$b);
				
	if ($_COOKIE['beelogin']=="siswa"){
		$res = mysqli_fetch_array(mysqli_query($sqlconn,"select * from cbt_siswa WHERE XNomerUjian='$_COOKIE[beeuser]'"));
		$poto  = $res['XFoto']; 
		$nama = $res['XNamaSiswa'];
		$loginx="3";
	}else{
		$re = mysqli_fetch_array(mysqli_query($sqlconn,"select * from cbt_user WHERE Username='$_COOKIE[beeuser]'"));
		$poto  = $re['XPoto'];
		$loginx = $re['login'];
		$nama  =$re['Nama'];
	}

	if($poto==''){$gambar="avatar.gif";} else {$gambar=$poto;} 
	if($loginx=='1'){$ucap="Admin"; $ucap2 ="Administrator" ;} else  if($loginx=='2'){$ucap="Guru"; $ucap2 ="Guru Mapel" ;}  else {$ucap="Siswa"; $ucap2="Nama Siswa";}
	
	if(!isset($_REQUEST['modul'])||$_REQUEST['modul']==''){$bread = "<font color=#F70505>Beranda</font>";}		
	elseif($_REQUEST['modul']=="info_skul"){$bread = "<font color=#F70505>Identitan Sekolah </font>| Update Data Sekolah";}		
	elseif($_REQUEST['modul']=="upl_kelas"||$_REQUEST['modul']=="uploadkelas"){$bread = "<a href=?modul=daftar_kelas>Daftar Kelas</a> &#8226; <font color=#F70505>Upload Data Kelas  </font>| Upload Form Excel Data Kelas";}		
	elseif($_REQUEST['modul']=="upl_mapel"||$_REQUEST['modul']=="uploadmapel"){$bread = "<a href=?modul=daftar_mapel>Mata Pelajaran</a> &#8226; <font color=#F70505>Upload Mata Pelajaran  </font>| Upload Form Excel Data Mapel";}	
	elseif($_REQUEST['modul']=="upl_siswa"||$_REQUEST['modul']=="uploadsiswa"){$bread = "<a href=?modul=daftar_siswa>Daftar Siswa</a> &#8226; <font color=#F70505>Upload Data Siswa </font>| Upload Form Excel Data Siswa";}
	elseif($_REQUEST['modul']=="daftar_siswa"){$bread = "<font color=#F70505>Daftar Siswa/Peserta </font>| Upload, Download, Hapus, Tambah & Edit Data Siswa";}	
	elseif($_REQUEST['modul']=="daftar_kelas"){$bread = "<font color=#F70505>Daftar Kelas </font>| Hapus, & Edit Kelas";}			
	elseif($_REQUEST['modul']=="daftar_mapel"){$bread = "<font color=#F70505>Daftar Mapel </font>| Hapus, & Edit Mapel";}			
	elseif($_REQUEST['modul']=="buat_soal"){$bread = "<font color=#F70505>Buat Bank Soal</font>";}			
	elseif($_REQUEST['modul']=="upl_foto"||$_REQUEST['modul']=="upload_foto"){$bread = "<font color=#F70505>Upload Foto Peserta</font>";}	
	elseif($_REQUEST['modul']=="status_tes"){$bread = "<font color=#F70505>Status Tes</font>";}		
	elseif($_REQUEST['modul']=="daftar_soal"){$bread = "<font color=#F70505>Bank Soal </font>| Aktifasi, Edit & Hapus";}	
	elseif($_REQUEST['modul']=="upl_soal"){$bread = "<a href=?modul=daftar_soal>Bank Soal</a> &#8226; <font color=#F70505>Upload File Template</font>";}			
	elseif($_REQUEST['modul']=="edit_soal"){$bread = "<a href=?modul=daftar_soal>Bank Soal</a> &#8226; <font color=#F70505>Daftar Edit Soal</font>";}		
	elseif($_REQUEST['modul']=="edit_data_soal") {$bread = "<a href=?modul=daftar_soal>Bank Soal</a> &#8226; <a href=?modul=edit_soal&jum=$_REQUEST[jum]&soal=$_REQUEST[soal]>Daftar Soal</a>  &#8226; <font color=#F70505>Edit Soal</font>";}	
	elseif($_REQUEST['modul']=="tambah_soal") {$bread = "<a href=?modul=daftar_soal>Bank Soal</a> &#8226; <a href=?modul=edit_soal&jum=$_REQUEST[jum]&soal=$_REQUEST[soal]>Daftar Soal</a>  &#8226; <font color=#F70505>Tambah Soal</font>";}	
	elseif($_REQUEST['modul']=="data_user"){$bread = "<font color=#F70505>Managemen User </font>| Administrasi Administrator & Guru";}
	elseif($_REQUEST['modul']=="backup"){$bread = "<font color=#F70505>BackUp & Restore</font> | BackUp, Hapus & Restor DataBase";}
	elseif($_REQUEST['modul']=="set_server"){$bread = "<font color=#F70505>Seting Server Pusat</font>";}
	elseif($_REQUEST['modul']=="data_skul"){$bread = "<font color=#F70505>Data Sekolah Klien/Peserta </font>| Edit & Hapus ";}
	elseif($_REQUEST['modul']=="upload_filesoal"){$bread = "<font color=#F70505>Upload File Pendukung</font>";}
	elseif($_REQUEST['modul']=="upl_filesoal"){$bread = "<font color=#F70505>Upload File Pendukung</font>";}
	elseif($_REQUEST['modul']=="upl_tugas"){$bread = "<font color=#F70505>Upload Nilai Tugas</font>";}
	elseif($_REQUEST['modul']=="edit_biodata_siswa"){$bread = "<font color=#F70505>Edit Biodata Siswa</font>";}
	elseif($_REQUEST['modul']=="edit_biodata"){$bread = "<font color=#F70505>Edit Biodata Guru</font>";}
	elseif($_REQUEST['modul']=="cetak_kartu"){$bread = "<font color=#F70505>Cetak Kartu Peserta</font> ";}
	elseif($_REQUEST['modul']=="cetak_kartu_to"){$bread = "<font color=#F70505>Cetak Kartu Try-Out</font> ";}
	elseif($_REQUEST['modul']=="cetak_absensi"){$bread = "<font color=#F70505>Cetak Daftar Hadir</font>";}
	elseif($_REQUEST['modul']=="berita_acara"){$bread = "<font color=#F70505>Cetak Berita Acara </font>";}
	elseif($_REQUEST['modul']=="cetak_hasil"){$bread = "<font color=#F70505>Cetak Daftar Nilai </font>";}
	elseif($_REQUEST['modul']=="cetak_TO"){$bread = "<font color=#F70505>Cetak Daftar Nilai Try Out </font>";}
	elseif($_REQUEST['modul']=="aktifkan_jadwaltes"){$bread = "<font color=#F70505>Status Ujian | Jadwal Ujian </font>| Nonkatifkan Ujian & Reset Login Peserta ";}
	elseif($_REQUEST['modul']=="daftar_waktu"){$bread = "<font color=#F70505>Status Ujian | Edit Setting Ujian </font>";}
	elseif($_REQUEST['modul']=="daftar_tesbaru"){$bread = "<font color=#F70505>Status Ujian | Setting Ujian </font>| Buat Jadwal Ujian & Non Aktifkan Bank Soal";}
	elseif($_REQUEST['modul']=="daftar_peserta"){$bread = "<font color=#F70505>Status Peserta</font>";}
	elseif($_REQUEST['modul']=="analisasoal"){$bread = "<font color=#F70505>Analisa | Soal dan Hasil Jawaban</font>";}
	elseif($_REQUEST['modul']=="analisajawaban"){$bread = "<a href=?modul=analisasoal>Analisa</a> &#8226; <font color=#F70505>Hasil Analisa</font>";}
	elseif($_REQUEST['modul']=="jawabansiswa"){$bread = "<a href=?modul=analisasoal>Analisa</a> &#8226; <a href=?modul=analisajawaban&soal=$_REQUEST[soal]>Hasil Analisa</a> &#8226; <font color=#F70505>Lembar Jawaban Siswa</font>";}
	elseif($_REQUEST['modul']=="lks"){$bread = "<a href=?modul=analisasoal>Analisa</a> &#8226; <a href=?modul=analisajawaban&soal=$_REQUEST[soal]>Hasil Analisa</a> &#8226; <font color=#F70505>Skoring Jawaban ESAI</font>";}
	elseif($_REQUEST['modul']=="analisabutir"){$bread = "<a href=?modul=analisasoal>Analisa</a> &#8226; <font color=#F70505>Analisa Butir Soal</font>";}
	elseif($_REQUEST['modul']=="rekapesai"){$bread = "Analisa Soal dan Hasil Jawaban";}
	elseif($_REQUEST['modul']=="daftar_waktu_db"){$bread = "<font color=#F70505>Status Ujian | DataBase Ujian </font>| Edit & Hapus db";}
	elseif($_REQUEST['modul']=="edit_tes"){$bread = "<a href=?modul=daftar_tesbaru>Status Ujian | Setting Ujian</a> &#8226; <font color=#F70505>Buat Jadwal Ujian dan Rilis TOKEN</font>";}	
	elseif($_REQUEST['modul']=="reset_peserta"){$bread = "<a href=?modul=aktifkan_jadwaltes>Status Ujian | Jadwal Ujian</a> &#8226; <font color=#F70505>Reset Login Peserta</font>";}	
	elseif($_REQUEST['modul']=="upl_user"||$_REQUEST['modul']=="uploaduser"){$bread = "<font color=#F70505>Upload Data User</font>";}
	elseif($_REQUEST['modul']=="edit_biodata"){$bread = "<font color=#F70505>Edit Biodata</font>";}
	elseif($_REQUEST['modul']=="edit_biodata_pass"){$bread = "<font color=#F70505>Ganti Password";}
	elseif($_REQUEST['modul']=="edit_biodata_siswa"){$bread = "<font color=#F70505>Edit Biodata</font>";}
	elseif($_REQUEST['modul']=="edit_biodata_siswa_pass"){$bread = "<font color=#F70505>Ganti Password</font>";}
	elseif($_REQUEST['modul']=="daftar_nilai"){$bread = "<font color=#F70505>Daftar Nilai</font>";}
		

	$tgljam = date("d/m/Y H:i");  
	$tgl = date("d/m/Y"); 
	if ($mode == "lokal" ){$tmode="Mode Server PUSAT";} else {$tmode="Mode Server LOKAL";} 
		
	$Dd= date("D");
	if ($Dd=="Sun"){$hari="Minggu";}
	else if ($Dd=="Mon"){$hari="Senin, ";}
	else if ($Dd=="Tue"){$hari="Selasa, ";}
	else if ($Dd=="Wed"){$hari="Rabu, ";}
	else if ($Dd=="Thu"){$hari="Kamis, ";}
	else if ($Dd=="Fri"){$hari="Jum'at, ";}
	else if ($Dd=="Sat"){$hari="Sabtu, ";}
	else {$hari=$Dd;}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<link href='../../images/icon.png' rel='icon' type='image/gif'/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
    <title><?php echo $skull; ?> | Administrator</title>
	
	<script language="JavaScript">
		var txt="<?php echo $skull; ?> | Administrator.......  ";
		var kecepatan=100;var segarkan=null;function bergerak() { document.title=txt;
		txt=txt.substring(1,txt.length)+txt.charAt(0);
		segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
	</script>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="./js/jquery-1.4.js"></script>
<link rel="stylesheet" type="text/css" href="./css/jquery.datetimepicker.css"/>
<style type="text/css">
	.custom-date-style {background-color: red !important;}
	.input{	}
	.input-wide{width: 500px;}
</style>
<script src="date/jquery.js"></script>
<script src="./js/jquery.datetimepicker.full.js"></script>
<script>
	/* window.onerror = function(errorMsg) {$('#console').html($('#console').html()+'<br>'+errorMsg)}*/
	$.noConflict();
	jQuery( document ).ready(function( $ ) {
		$.datetimepicker.setLocale('en');
		$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
			//console.log($('#datetimepicker_format').datetimepicker('getValue'));
		$("#datetimepicker_format_change").on("click", function(e){$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});});
		$("#datetimepicker_format_locale").on("change", function(e){$.datetimepicker.setLocale($(e.currentTarget).val()); });
		$('#datetimepicker').datetimepicker({dayOfWeekStart : 1, lang:'en', disabledDates:['1986/01/08','1986/01/09','1986/01/10'], startDate:	'1986/01/05' });
		$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});
		$('.some_class').datetimepicker();
		$('#default_datetimepicker').datetimepicker({ formatTime:'H:i',	formatDate:'d.m.Y',	defaultDate:'+03.01.1970', defaultTime:'10:00',	timepickerScrollbar:false });
		$('#tanggal1').datetimepicker({	timepicker:false, format:'m/d/Y', formatDate:'d/m/Y', });
		$('#datetimepicker_mask').datetimepicker({ mask:'9999/19/39 29:59' });
		$('#mulai1').datetimepicker({ datepicker:false, format:'H.i', step:5 });
		$('#akhir1').datetimepicker({ datepicker:false,	format:'H.i', step:5 });
		$('#datetimepicker_dark').datetimepicker({theme:'dark'}) 
	}); 

</script>

<body style="background-color:#F8FFBF;">
 
<?php if  ($header=="0") { ?>
<!-- ////Tampilan HEADER Modern (alternatif)/////-->
<header>
	<nav class="navbar navbar-default" >
			<div class="navbar-header" style="width:40%;  background-color:<?php echo $skul_warna; ?>; >
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"  aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-header" ><img alt="Brand" src="../../images/<?php echo $skul_ban; ?>"></a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style=" background-color:<?php echo $skul_warna; ?>;>
				<ul class="nav navbar-nav">	</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="navbar-toggle collapsed" style="background-color:#e4e4e2;"><a href="#" style="background-color:#F8FFBF;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<?php if ($_COOKIE['beelogin']=="siswa"){?>
						<img src="../../fotosiswa/<?php echo "$gambar"; ?>" style="margin-top:0px; height:30px; overflow:hidden"> &nbsp; <?php echo $ucap." : ".$nama; ?>&nbsp;&nbsp;<span class="caret"></span></a>
					<?php }else{?>
						<img src="photo/<?php echo "$gambar"; ?>" style="margin-top:0px; height:30px; overflow:hidden"> &nbsp; <?php echo $ucap." : ".$nama; ?>&nbsp;&nbsp;<span class="caret"></span></a>
					<?php } ?>
					<ul class="dropdown-menu" style="background-color:#EEE9F5;">
								<?php if ($_COOKIE['beelogin']=="siswa"){?>
								<li style="text-align:center"> <a href="?modul=edit_biodata_siswa" data-toggle='modal' data-target=''>
									<img class="img-circle" src="../../fotosiswa/<?php echo "$gambar"; ?>" style="margin-top:0px; height:80px; overflow:hidden"></a><br/><?php echo "$ucap2 : <br/><b>$nama</b>"; ?><br/>	</li>
								<?php }else{?>
									<li style="text-align:center"> <a href="?modul=edit_biodata" data-toggle='modal' data-target=''>
									<img class="img-circle" src="photo/<?php echo "$gambar"; ?>" style="margin-top:0px; height:80px; overflow:hidden"></a><br/><?php echo "$ucap2 : <br/><b>$nama</b>"; ?><br/>	</li>
								<?php } ?>
								<li role="separator" class="divider"> </li>
								<li style="text-align:center; background:#1ABA09" > <a ><?php if($status_server==1){ ?>  <b>SERVER AKTIF</b> <?php } else { ?>  SERVER OFFLINE  <?php } ?></a></li>
								<li role="separator" class="divider"> </li>								
								<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i>&nbsp;&nbsp;Logout</a></li>
								<li class="navbar-toggle collapsed" style="margin-top:15px;"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-cog"></span> Pengaturan<span class="caret"></span></a>
					</li>
							</ul>
					</li>
				</ul>
			</div>
	</nav>
</header>
<?php }else{ ?>

<!-- ////// Tampilan HEADER  Klasik ///////-->

<header>
    <!-- Navigation !-->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; height:90px; background-color:#ffca01; border-bottom-color:#364145">
       <table width="100%" border="1">
	   <tr>
			<td bgcolor="<?php echo "$skul_warna"; ?>"> <img src="../../images/<?php echo "$skul_ban"; ?>" style="margin-top:0px; height:100px; overflow:hidden">
			</td>
			<td align="right" bgcolor="#000" width="35%">
		        <table width="100%" border="0">
					<tr><td rowspan="2" width="130px" align="center"><img src="photo/<?php echo "$gambar"; ?>" style="margin-top:0px; height:90px; overflow:hidden"></td>
						<td><font color="#cfcdcd">&nbsp;<?php echo "$ucap"; ?> : </label><br>
						<label style="text-align:right; color:#fff; font-size:18px; margin-top:12x; margin-right:20px">&nbsp;<?php echo "$nama"; ?></label></td>
					</tr>
					<tr><td><?php if($status_server==1)
								{ echo "<font color=#cfcdcd> Status Server : AKTIF</font>"   ;} else 
								{ echo "<font color=#cfcdcd> Status Server : OFFLINE</font>"  ;} 	
							?>
						</td>
					</tr>
				</table>
           </td>
		</tr>
        </table>
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                
			</button>
        </div>
	</nav>
</header>
<?php } ?>

<!-- Breadcrumb margin : atas-kiri-bawah-kanan !-->
<div id="headtop"  style="width:98%; margin:15px 15px 1px 15px; height:60px; background-color:#FFEACA; border-bottom-color:#e4e4e2; font-size:20px; padding:15px;">
	<table width="98%" cellspacing="0" border="0" cellpadding="0">
		<tr>
			<td align="left" ><a href="?"><i class="fa fa-home fa-fw"></i></a><a href="?">Dashboard </a>&#8226; <?php	if(isset($bread)){echo $bread;} ?></td>
			<td align="right" ><font color=#280BDE size=3px><div ><?php echo $hari; echo date('d M Y'); echo "&nbsp;&nbsp;[&nbsp;&nbsp;";?><a id="clockDisplay"></a><?php	echo "&nbsp;&nbsp;".$w."&nbsp; ]";?></td></font>
		</tr>
	</table>
</div>
<script>
function renderTime(){
	 var currentTime = new Date();
	 var h = currentTime.getHours();
	 var m = currentTime.getMinutes();
	 var s = currentTime.getSeconds();
	 if (h == 0){h = 24;}
	 if (h < 10){h = "0" + h;}
	 if (m < 10){m = "0" + m;}
	 if (s < 10){s = "0" + s;}
	 var myClock = document.getElementById('clockDisplay');
	 myClock.textContent = h + ":" + m + ":" + s + "";    
	 setTimeout ('renderTime()',1000);}
renderTime();
</script>

<div style="width:98%; margin:1px 15px 15px 15px; background-color:#fff; border-bottom-color:#e4e4e2;">
    <!-- #headtop-->
    <div id="wrapper" style="width:98%; margin-left:15px;height:100%; ">
    <div class="navbar-default sidebar" role="navigation" style="margin-top:15px; border:thin; border-top-color:#CCCCCC">
	<div class="sidebar-nav navbar-collapse">
		<ul class="nav" id="side-menu">
		<li><a href="#" data-toggle='modal' data-target='#myInfo'><i class="fa fa-exclamation-circle fa-fw"></i> &nbsp;Info & Tutorial</a>                        </li> 

		
<!-- /////////////////////// ADMINISTRASI LOGIN //////////////////////////////-->	
	
<!-- //////// ADMIN (1) /////////-->
	<?php if($loginx=="1"){?>
		<li><a href="#"><i class="fa fa-laptop"></i> &nbsp;System Server <span class="fa arrow"></span></a>
			<ul class="nav nav-second-level">
				<li><a href="#" data-toggle="modal" data-target="#myServer"><i class="fa fa-gears fa-fw"></i> &nbsp;Seting Server</a></li>
				<li><?php if ($xserver=="lokal"){?>
						<a href="?modul=data_skul"><i class="fa fa-university fa-fw"></i> &nbsp;Sekolah Klien</a>
					<?php } else { ?>
						<a href="?modul=set_server"><i class="fa fa-server"></i> &nbsp;Setting Server Pusat</span></a>
					<?php }?>
				</li>
				
				<li><a href="#" data-toggle="modal" data-target="#db_server"><i class="fa fa-gear fa-fw"></i> &nbsp;Ubah db/Install Baru</a></li>				
			</ul>
		</li>	
		<li><a href="#"><i class="fa fa-building-o fa-fw"></i> &nbsp;Data Sekolah <span class="fa arrow"></span></a>
			<!-- /.nav-second-level -->
			<ul class="nav nav-second-level">
				<li><a href="?modul=info_skul"><i class="fa fa-credit-card"></i> &nbsp;Identitas Sekolah</a> </li>  
				<li><a href="?modul=data_user"><i class="fa fa-group"></i> &nbsp;Manajemen User</a></li>
				<li><a href="?modul=backup"><i class="fa fa-database fa-fw"></i> &nbsp;Backup & Restore</a> </li>                        
			</ul>
        </li>
		<li><a href="#"><i class="fa fa-list-alt"></i> &nbsp;Administrasi <span class="fa arrow"></span></a>
			<ul class="nav nav-second-level">
				<li><a href="?modul=daftar_kelas"><i class="fa fa-university fa-fw "></i> &nbsp;Daftar Kelas</a></li>
				<li><a href="?modul=daftar_mapel"><i class="fa fa-flask "></i> &nbsp;Mata Pelajaran</a></li>
				<li><a href="?modul=daftar_siswa"><i class="fa fa-group"></i> &nbsp;Daftar Siswa</a></li>
            </ul>
		
        </li>
	
	<!-- /////// GURU (2) //////-->	
	
	<?php } if( $loginx=="2" ){?>
		<li><a href="?modul=edit_biodata"><i class="fa fa-user fa-fw"></i> &nbsp;Edit Biodata</a></li> 
		<li><a href="?modul=edit_biodata_pass"><i class="fa fa-key fa-fw"></i> &nbsp;Ganti Password</a></li>
	
	<!-- /////// SISWA (3) //////-->	
	
	<?php } if( $loginx=="3"  ){?>
		<li><a href="?modul=edit_biodata_siswa"><i class="fa fa-user fa-fw"></i> &nbsp;Edit Biodata</a></li> 
		<li><a href="?modul=edit_biodata_siswa_pass"><i class="fa fa-key fa-fw"></i> &nbsp;Ganti Password</a></li> 
		<li><a href="?modul=daftar_nilai"><i class="fa fa-book fa-fw"></i> &nbsp;Daftar Nilai</a></li> 
		
		<?php if( $nilaikelas=="1"  ){?>
		<li><a href="#"><i class="fa fa-edit fa-fw"></i> &nbsp;Daftar Nilai per Kelas<span class="fa arrow"></span></a>
			<ul class="nav nav-second-level">
				<li><a href="#" data-toggle="modal" data-target="#myCetakHasil"><i class="fa fa-file-text-o fa-fw"></i> &nbsp;Daftar Nilai Ujian</a></li>
				<li><a href="#" data-toggle="modal" data-target="#myCetakTO"><i class="fa fa-file-text-o fa-fw"></i> &nbsp;Daftar Nilai Try Out</a></li>
            </ul>
        </li>     

		<!-- /////// GURU (2) atau ADMIN (1) //////-->	

	<?php }} if($loginx=="1"  ) {?>
		<li><a href="#"><i class="fa fa-book fa-fw"></i> &nbsp;Bank Soal <span class="fa arrow"></span></a>
			<!-- /.nav-second-level -->
			<ul class="nav nav-second-level">
                <li><a href="?modul=daftar_soal"><i class="fa fa-briefcase   fa-fw"></i> &nbsp;Bank Soal</a></li>
				
				<li><a href="?modul=file_pendukung"><i class="fa fa-music fa-fw"></i> &nbsp;File Pendukung Soal</a></li>
                <li><a href="?modul=upl_tugas"><i class="fa fa-cloud-upload"></i> &nbsp;Upload Nilai Tugas</a></li>                                
            </ul>
        </li>      
	
	<?php } if( $loginx=="2" ) {?>
		<li><a href="#"><i class="fa fa-book fa-fw"></i> &nbsp;Bank Soal <span class="fa arrow"></span></a>
			<!-- /.nav-second-level -->
			<ul class="nav nav-second-level">
                <li><a href="?modul=daftar_soal"><i class="fa fa-briefcase   fa-fw"></i> &nbsp;Bank Soal</a></li>
				
				<li><a href="?modul=upl_files"><i class="fa fa-music fa-fw"></i> &nbsp;File Pendukung Soal</a></li>
                <li><a href="?modul=upl_tugas"><i class="fa fa-cloud-upload"></i> &nbsp;Upload Nilai Tugas</a></li>                                
            </ul>
        </li>      
	<?php } ?> 

<!-- //////// ADMIN (1) ////////  -->	
	
	<?php if($loginx=="1"){?>                        
        <li><a href="#"><i class="fa fa-print fa-fw"></i> &nbsp;Cetak<span class="fa arrow"></span></a>
			<ul class="nav nav-second-level">
                <li><a href="#" data-toggle="modal" data-target="#myCetakKartu"><i class="fa fa-credit-card  fa-fw"></i> &nbsp;Kartu USBK</a></li>
				<li><a href="#" data-toggle="modal" data-target="#myCetakKartuTO"><i class="fa fa-credit-card  fa-fw"></i> &nbsp;Kartu Ujian Try-Out</a></li>
                <li><a href="#" data-toggle="modal" data-target="#myDaftarHadir"><i class="fa fa-list-alt "></i> &nbsp;Daftar Hadir</a></li>
                <li><a href="?modul=berita_acara"><i class="fa fa-file-o fa-fw"></i> &nbsp;Berita Acara</a></li>
                <li><a href="#" data-toggle="modal" data-target="#myCetakHasil"><i class="fa fa-file-text-o fa-fw"></i> &nbsp;Daftar Nilai</a></li>
                <li><a href="#" data-toggle="modal" data-target="#myCetakTO"><i class="fa fa-file-text-o fa-fw"></i> &nbsp;Hasil Try Out</a></li>
            </ul>
        </li>                        
		<li><a href="#"><i class="fa fa-edit fa-fw"></i> &nbsp;Status Ujian <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="?modul=daftar_tesbaru"><i class="fa fa-folder-o fa-fw"></i> &nbsp;Setting Ujian</a></li>
                <li><a href="?modul=aktifkan_jadwaltes"><i class="fa fa-clock-o  fa-fw"></i> &nbsp;Jadwal Ujian</a></li>
				<li><a href="?modul=daftar_waktu"><i class="fa fa-edit"></i> &nbsp;Edit Setting Ujian</a></li> 
				<li><a href="?modul=daftar_waktu_db"><i class="fa fa-times"></i> &nbsp;DataBase Ujian</a></li>				
			</ul>
        </li>
		<li><a href="?modul=daftar_peserta"><i class="fa fa-user fa-fw"></i> &nbsp;Status Peserta</a></li>
		<li><a href="?modul=aktifkan_jadwaltes"><i class="fa fa-refresh fa-fw"></i> &nbsp;Reset Login Peserta</a></li>
	<?php } ?> 

	<!-- /////// ADMIN (1) atau GURU (2) ////// -->
	
	<?php if($loginx=="1"||$loginx=="2") {?>
        <li><a href="?modul=analisasoal"><i class="fa fa-bar-chart-o fa-fw"></i> &nbsp;Analisa</a></li>

	<?php } if($loginx=="1") { if ($xserver=="pusat"){?>
		<li><a href="?modul=upload_hasil"><i class="fa fa-cloud-upload"></i> &nbsp;Upload Hasil Ujian</a></li>      
						                    
	<!-- /////// ADMIN (1) atau GURU (2) atau SISWA (3) ////// -->
	
	<?php }} if($loginx=="1"||$loginx=="2"||$loginx=="3"){?>
		<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Log Out</a></li>		
	
	<?php } ?>    </ul>
        <!-- /.navbar-static-side -->
    </nav>
	</div>
		<!-- /.sidebar-collapse -->
	</div>
 
	<div id="page-wrapper"><!-- page wrapper -->
		<?php	if(isset($_REQUEST['modul'])==""){include "none.php";}	
				elseif($_REQUEST['modul']=="aktifkan_jadwaltes"){include "daftar_tes.php";}			
				elseif($_REQUEST['modul']=="buat_paketsoal"){include "buat_paketbaru.php";}	
				elseif($_REQUEST['modul']=="buat_soal"){include "buat_banksoal.php";}
				elseif($_REQUEST['modul']=="daftar_kelas"){include "daftar_kelas.php";}	
				elseif($_REQUEST['modul']=="daftar_mapel"){include "daftar_mapel.php";}	
				elseif($_REQUEST['modul']=="daftar_peserta"){include "daftarpeserta.php";}
				elseif($_REQUEST['modul']=="daftar_siswa"){include "daftar_siswa.php";}
				elseif($_REQUEST['modul']=="daftar_soal"){include "daftar_soal.php";}		
				elseif($_REQUEST['modul']=="daftar_tesbaru"){include "daftar_tesbaru.php";}	
				elseif($_REQUEST['modul']=="daftar_waktu"){include "daftar_waktu.php";}			
				elseif($_REQUEST['modul']=="data_skul"){include "daftar_sekolah.php";}
				elseif($_REQUEST['modul']=="data_user"||$_REQUEST['modul']=="hapus_user"){include "daftar_user.php";}			
				elseif($_REQUEST['modul']=="detil_siswa"){include "detil_siswa.php";}				
				elseif($_REQUEST['modul']=="edit_biodata"){include "edit_biodata.php";}	
				elseif($_REQUEST['modul']=="edit_biodata_pass"){include "edit_biodata_pass.php";}			
				elseif($_REQUEST['modul']=="edit_biodata_siswa"){include "edit_biodata_siswa.php";}
				elseif($_REQUEST['modul']=="edit_biodata_siswa_pass"){include "edit_biodata_siswa_pass.php";}				
				elseif($_REQUEST['modul']=="edit_soal"){include "edit_daftar_soal.php";}			
				elseif($_REQUEST['modul']=="edit_soal_esai"){include "bank_soal.php";}			
				elseif($_REQUEST['modul']=="edit_data_soal")
					{if($_REQUEST['jum']==5){include "bank_soal5.php";}
					elseif($_REQUEST['jum']==4){include "bank_soal4.php";}
					elseif($_REQUEST['jum']==3){include "bank_soal3.php";}
					elseif($_REQUEST['jum']==1){include "bank_soal.php";} }
				elseif($_REQUEST['modul']=="info_skul"){include "upl_skul.php";}	
				elseif($_REQUEST['modul']=="status_tes"){include "status_tes.php";}
				elseif($_REQUEST['modul']=="pilih_banksoal"){include "buat_paketbaru.php";}	
				
				elseif($_REQUEST['modul']=="reset_peserta"){include "resetpeserta.php";}									
				elseif($_REQUEST['modul']=="set_server"){include "set_server.php";}
				elseif($_REQUEST['modul']=="upl_soal"){include "upload_soal.php";}
				elseif($_REQUEST['modul']=="upl_files"){include "upload_files.php";}
				elseif($_REQUEST['modul']=="upl_filesoal"){include "upload_file.php";}
				elseif($_REQUEST['modul']=="file_pendukung"){include "gambar.php";}
				elseif($_REQUEST['modul']=="upl_foto"){include "upload_foto.php";}	
				elseif($_REQUEST['modul']=="upload_filesoal"){include "upload_filesoal.php";}
				elseif($_REQUEST['modul']=="upl_user"||$_REQUEST['modul']=="uploaduser"){include "upload_user.php";}				
				elseif($_REQUEST['modul']=="upl_kelas"||$_REQUEST['modul']=="uploadkelas"){include "upload_kelas.php";}		
				elseif($_REQUEST['modul']=="upl_mapel"||$_REQUEST['modul']=="uploadmapel"){include "upload_mapel.php";}	
				elseif($_REQUEST['modul']=="upl_siswa"||$_REQUEST['modul']=="uploadsiswa"){include "upload_siswa.php";}
				elseif($_REQUEST['modul']=="upl_soal"||$_REQUEST['modul']=="uploadsoal"){include "upload_soal.php";}	
				elseif($_REQUEST['modul']=="upl_tugas"||$_REQUEST['modul']=="uploadtugas"){include "upload_tugas.php";}				
				elseif($_REQUEST['modul']=="tambah_soal")
					{if($_REQUEST['jum']==5){include "tambah_soal5.php";}
						elseif($_REQUEST['jum']==4){include "tambah_soal4.php";}
						elseif($_REQUEST['jum']==3){include "tambah_soal3.php";}
						elseif($_REQUEST['jum']==1){include "tambah_soal.php";} }
				elseif($_REQUEST['modul']=="hapus_nosoal"){include "hapus_nosoal.php";}	
				elseif($_REQUEST['modul']=="cetak_kartu_to"){include "cetak_kartu_to.php";}				
				elseif($_REQUEST['modul']=="cetak_kartu"){include "cetak_kartu.php";}																																									
				elseif($_REQUEST['modul']=="cetak_absensi"){include "cetak_absen.php";}	
				elseif($_REQUEST['modul']=="cetak_berita"){include "cetak_berita.php";}	
				elseif($_REQUEST['modul']=="cetak_hasil"){include "cetak_hasil_ujian.php";}	
				elseif($_REQUEST['modul']=="cetak_TO"){include "cetak_hasil_TO.php";}	
				elseif($_REQUEST['modul']=="hasil_peserta"){include "cetak_hasil_analisa.php";}	
				elseif($_REQUEST['modul']=="jawabansiswa"){include "jawabansiswa.php";}	
				elseif($_REQUEST['modul']=="jawabanesai"){include "jawabanesai_siswa.php";}	
				elseif($_REQUEST['modul']=="analisasoal"){include "analisa_soal.php";}	
				elseif($_REQUEST['modul']=="analisajawaban"){include "analisa_jawaban.php";}																																																								
				elseif($_REQUEST['modul']=="analisabutir"){include "analisa_butirsoal.php";}	
				elseif($_REQUEST['modul']=="sebaran_nilai"){include "sebaran_nilai.php";}	
				elseif($_REQUEST['modul']=="lks"){include "lks.php";}	
				elseif($_REQUEST['modul']=="backup"){include "backup.php";}
				elseif($_REQUEST['modul']=="restore"){include "../../database/restore.php";}
				elseif($_REQUEST['modul']=="backup_db"){include "../../database/cbt_jawaban.php";}	
				elseif($_REQUEST['modul']=="edit_tes"){include "edit_tes.php";}	
				elseif($_REQUEST['modul']=="sinkron"||$_REQUEST['modul']=="sinkronsatu"){include "sinkron.php";}	
				elseif($_REQUEST['modul']=="berita_acara"){include "berita_acara.php";}	
				elseif($_REQUEST['modul']=="cetak_banksoal"){include "cetak_banksoal.php";}	
				elseif($_REQUEST['modul']=="database_ujian"){include "database_ujian.php";}
				elseif($_REQUEST['modul']=="daftar_waktu_db"){include "daftar_waktu_db.php";}
				elseif($_REQUEST['modul']=="daftar_nilai"){include "daftar_nilai.php";}	
				elseif($_REQUEST['modul']=="upl_hasil"){include "upload_hasil_proses.php";}
				elseif($_REQUEST['modul']=="upload_hasil"){include "upload_hasil.php";}		
				elseif($_REQUEST['modul']=="rekapesai"){include "rekapesai.php";}	
		?>
	
	</div><!-- /page wrapper -->
	</div>
</div>  

 <div class="modal fade" id="myInfo" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
		<form action="?&header5=yes" method="post">
            <div class="panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title page-label" align="center">
                    <a href="http://www.madiponegorobandung1.blogspot.com" target="_blank"><span style="color: #1B06CF;"><?php echo $skull; ?>-CBT </span></a>  </h2>
                </div>
				
				<?php if ($loginx=="1") { ?>
					<div class="panel-body">
						<div class="inner-content">
							<div class="wysiwyg-content">
								<p align="center"> <img src="../../images/beesmart.png" width="470"></p>
								<p align="center"> <br><b>BeeSMART</b> on Internet : <br>							
									<br><a href="https://www.youtube.com/watch?v=aceevCaKKH8&list=PLaRJCwMbrhIIj44b9JY08hf9C-FyJMtEt" target="_blank"><img src="images/youtube.png" width="60"></a> 
										&nbsp;&nbsp;&nbsp;&nbsp; 
										<a href="https://t.me/joinchat/AAAAAAtB2PtpcsPMaFEuKQ" target="_blank"><img src="images/telegram.png" width="30"></a> 
										&nbsp;&nbsp;&nbsp;&nbsp; 
										<a href="https://www.facebook.com/BSMARTLabs/" target="_blank"><img src="images/fb.png" width="30"> </a> 
										&nbsp;&nbsp;&nbsp;&nbsp;
										
									</br>
								</p>						
							</div>
						</div>
					</div>
					<div class="panel-footer" align="center">
						<div class="row">
						
							<a href="../../file-excel/panduan_cbt.pdf" target="_blank">
											<button type="button" class="btn btn-success btn-sm"><i class="fa fa-file-pdf-o"></i> &nbsp;Tutorial PDF</button>
										</a>
					
								
							<button type="submit" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
						</div>
				<?php } else if ($loginx=="2") {?>
					
					<div class="panel-body">
						<?php 	echo " 
							<font color=#0714F7><center>ASSALAMU'ALAIKUM 
							<br> Selamat Datang di Aplikasi UASBK ".$skull."
							<br>Semoga Hari Anda Menyenangkan
							<p>Anda Login Sebagai GURU, Fitur yang bisa anda gunakan adalah sebagai berikut:
							</font><font color=#675B80>
							<p>1. Anda dapat melakukan Edit Biodata dan Foto Profil Anda
							<br>2. Anda dapat mengganti Password guna kerahasiaan akun anda
							<br>3. Anda dapat Membuat Bank Soal dan Edit Soal.
							<br>4. Anda dapat mendownload/print Analisa Hasil Ujian Siswa.
							<p></font>
							<br><font color=#F70505> CARA MEMBUAT BANK SOAL</font>
							<br><font color=#675B80>
							<br>1. Membuat Bank Soal sesuai format excel template(oleh Guru)
<br>2. Upload File excel (oleh Guru/Admin)
<br>3.Edit Soal apabila dirasa perlu , seperti equation dan insert gambar (oleh Guru) dan jangan lupa pengacakan soal dan Kunci Jawaban harus diisi
<br>4. Mengaktifkan Status Bank Soal (oleh Guru/Admin), sehingga akan nampak pada halaman administrator untuk dibuat Paket Soal bersama Bank soal dari guru lain apabila akan melakukan tes pada waktu yang bersamaan.
<br>5. Buat jadwal/aktifkan ujian & generate Token (oleh Admin)
<br></font>
<br><font color=#F70505>Catatan: </font><font color=#675B80>
<br>- Bank Soal tidak bisa dihapus atau diedit selama Sedang AKTIF digunakan ujian
<br>- Bank Soal yang aktif belum bisa dipergunakan untuk ujian bila belum di buat jawdwal ujian oleh Admin.
<br>- Tombol Delete/Hapus Bank Soal Disable bila Bank Soal sedang dipakai ujian, menghapus Bank Soal berarti juga menghapus daftar Analisa Hasil Ujian
							</font>

						"; ?>
					</div>
					<div class="panel-footer" align="center">
						<div class="arow">
							<button type="submit" class="btn btn-success btn-sm" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
						</div>
					</div>
				<?php } else { ?>
					<div class="panel-body">
						<?php 	echo " 
							<font color=#0714F7><center>ASSALAMU'ALAIKUM 
							<br> Selamat Datang di Aplikasi UASBK ".$skull."
							<br>Semoga Hari Anda Menyenangkan
							<p>Anda Login Sebagai SISWA, Fitur yang bisa anda gunakan adalah sebagai berikut:</font>
							<font color=#675B80>
							<p>1. Anda dapat melakukan Edit Biodata dan Foto Profil Anda
							<br>2. Anda dapat mengganti Password guna kerahasiaan akun anda
							<br>3. Anda dapat melihat data hasil nilai ujian pribadi dan teman Anda (juga kelas lain).
							<p></font>
							<br><font color=#F70505> PERHATIAN !!!</font>
							<br><font color=#675B80>
							<br>Setelah Anda berhasil LOGIN Ubah Password yang diberikan Progtor/Teknisi, guna kerahasiaan Akun Anda karena Username dan Password awal Anda belum rahasia (hasil pengumuman).
							</font>
						"; ?>
					</div>
					<div class="panel-footer" align="center">
						<div class="arow">
							<button type="submit" class="btn btn-success btn-sm" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
						</div>
					</div>
				<?php } ?>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


    <!-- Modal -->
<div class="modal fade" id="myDaftarHadir" role="dialog">
<div class="modal-dialog">
    <!-- Modal content-->
<div class="modal-content">
<div class="panel-default">
<div class="panel-heading">
    <h1 class="panel-title page-label"><i class="glyphicon glyphicon-print"></i> | Daftar Hadir</h1>
</div>

<form action="?modul=cetak_absensi" method="post">
    <div class="panel-body">
    <div class="inner-content">
    <div class="wysiwyg-content">
    <p>	<table width="100%">
			<tr height="30px"><td><?php echo $rombel;?> </td><td>: &nbsp;&nbsp;<td>                          
                <select class="form-control" id="jur1"  name="jur1">
					<?php 	$sqk = mysqli_query($sqlconn,"select * from cbt_kelas group by XKodeJurusan");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeJurusan]'>$rs[XKodeJurusan]</option>";} 
					?>                                
                </select>
			</td></tr> 
            <tr height="30px"><td width="30%">Kelas </td><td>: <td>
                <select class="form-control" id="iki1"  name="iki1">
					<?php 	$sqk = mysqli_query($sqlconn,"select * from cbt_kelas group by XKodeKelas");
							while($rs = mysqli_fetch_array($sqk)){
                            echo "<option value='$rs[XKodeKelas]'>$rs[XKodeKelas]</option>";} 
					?>                                
                </select>
            </td></tr>
            <tr height="30px"><td width="30%">Sesi </td><td>: <td>
                <select class="form-control" id="sesi1"  name="sesi1">
					<?php	$sqk = mysqli_query($sqlconn,"select * from cbt_siswa group by XSesi");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XSesi]'>$rs[XSesi]</option>";} 
					?>                                
                </select>
            </td></tr> 
            <tr height="30px"><td width="30%">Ruang </td><td>: <td>
                <select class="form-control" id="ruang1"  name="ruang1">
					<?php	$sqk = mysqli_query($sqlconn,"select * from cbt_siswa group by XRuang");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XRuang]'>$rs[XRuang]</option>";} 
					?>                                
                </select>
            </td></tr>					
			<tr height="30px"><td width="30%">Mata Pelajaran </td><td>: <td>
                <select class="form-control" id="mapel1"  name="mapel1">
					<?php // edit Broo
							$sqk = mysqli_query($sqlconn,"select * from cbt_mapel group by XKodeMapel");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XNamaMapel]'>$rs[XKodeMapel] - $rs[XNamaMapel]</option>";} 
					?>                              
				</select>
			</td></tr>
			<tr height="30px"><td width="30%">Tanggal </td><td>: <td>
				<input class="form-control" id="tanggal1" name="tanggal1" type="text"/>
					<?php $tanggal1 = !empty($_POST['tanggal1']) ? $_POST['tanggal1'] : ''; ?> 
			<tr height="30px"><td width="30%">Jam Mulai </td><td>: <td>
				<input class="form-control" id="mulai1" name="mulai1" type="text"/>
					<?php $mulai1 = !empty($_POST['mulai1']) ? $_POST['mulai1'] : ''; ?> 
            </td></tr>
			<tr height="30px"><td width="30%">Jam Selesai </td><td>: <td>
                <input class="form-control" id="akhir1" name="akhir1" type="text"/>
					<?php $akhir1 = !empty($_POST['akhir1']) ? $_POST['akhir1'] : ''; ?> 
                                </td></tr>
	</table></p>
    </div>
    </div>
    </div>
	
    <div class="panel-footer">
    <div class="row">
    <div class="col-xs-offset-7 col-xs-6">
        <button type="submit" class="btn btn-default btn-sm">
        <i class="glyphicon glyphicon-print"></i> Print Preview</button>
        <button type="submit" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-minus-sign"></i> Tutup</button>
    </div>
    </div>
    </div>
</form>
</div>
</div>
</div>
</div>

<!-- Awal Modal myCetakKartu -->
<div class="modal fade" id="myCetakKartu" role="dialog">
	<div class="modal-dialog">
	<!-- Modal content-->
	<div class="modal-content">
	<div class="panel-default">
	<div class="panel-heading">
		<h1 class="panel-title page-label"><i class="glyphicon glyphicon-print"></i> | Kartu Ujian</h1>
	</div>

		<form action="?modul=cetak_kartu" method="post">
			<div class="panel-body">
			<div class="inner-content">
			<div class="wysiwyg-content">
				<p><table width="100%"  border="0" >
					<tr ><td><?php echo $rombel;?> </td><td>:&nbsp;&nbsp;<td>                                
						<select class="form-control" id="jur2"  name="jur2">
							<?php 	$sqk = mysqli_query($sqlconn,"select * from cbt_kelas group by XKodeJurusan");
									while($rs = mysqli_fetch_array($sqk)){
									echo "<option value='$rs[XKodeJurusan]'>$rs[XKodeJurusan]</option>";} 
							?>                                
						</select>
					</td></tr> 
					<tr ><td >Kelas </td><td>: <td>
						<select class="form-control" id="iki2"  name="iki2">
							<?php 	$sqk = mysqli_query($sqlconn,"select * from cbt_kelas group by XKodeKelas");
									while($rs = mysqli_fetch_array($sqk)){
									echo "<option value='$rs[XKodeKelas]'>$rs[XKodeKelas]</option>";} 
							?>                                
						 </select>
					</td></tr>
				</table></p>
			</div>
			</div>
			</div>
			
			<div class="panel-footer">
			<div class="row">
			<div class="col-xs-offset-7 col-xs-6">
				<button type="submit" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-print"></i> Print Preview</button>
				<button type="submit" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-minus-sign"></i> Tutup</button>
			</div>
			</div>
			</div>
		</form>
	</div>
	</div>
	</div>
</div>
<!-- Ahir Modal myCetakKartu -->

<!-- Awal Modal myCetakKartuTO -->
<div class="modal fade" id="myCetakKartuTO" role="dialog">
	<div class="modal-dialog">
	<!-- Modal content-->
	<div class="modal-content">
	<div class="panel-default">
	<div class="panel-heading">
		<h1 class="panel-title page-label"><i class="glyphicon glyphicon-print"></i> | Kartu Ujian Try-Out</h1>
	</div>

		<form action="?modul=cetak_kartu_to" method="post">
			<div class="panel-body">
			<div class="inner-content">
			<div class="wysiwyg-content">
				<p><table width="100%"  border="0" >
					<tr ><td><?php echo $rombel;?> </td><td>:&nbsp;&nbsp;<td>                                
						<select class="form-control" id="jur2"  name="jur2">
							<?php 	$sqk = mysqli_query($sqlconn,"select * from cbt_kelas group by XKodeJurusan");
									while($rs = mysqli_fetch_array($sqk)){
									echo "<option value='$rs[XKodeJurusan]'>$rs[XKodeJurusan]</option>";} 
							?>                                
						</select>
					</td></tr> 
					<tr ><td >Kelas </td><td>: <td>
						<select class="form-control" id="iki2"  name="iki2">
							<?php 	$sqk = mysqli_query($sqlconn,"select * from cbt_kelas group by XKodeKelas");
									while($rs = mysqli_fetch_array($sqk)){
									echo "<option value='$rs[XKodeKelas]'>$rs[XKodeKelas]</option>";} 
							?>                                
						 </select>
					</td></tr>
				</table></p>
			</div>
			</div>
			</div>
			
			<div class="panel-footer">
			<div class="row">
			<div class="col-xs-offset-7 col-xs-6">
				<button type="submit" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-print"></i> Print Preview</button>
				<button type="submit" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-minus-sign"></i> Tutup</button>
			</div>
			</div>
			</div>
		</form>
	</div>
	</div>
	</div>
</div>
<!-- Ahir Modal myCetakKartuTO -->


    <!-- Modal -->
<div class="modal fade" id="myCetakHasil" role="dialog">
<div class="modal-dialog">
    <!-- Modal content-->
<div class="modal-content">
<div class="panel-default">
<div class="panel-heading">
    <h1 class="panel-title page-label"><i class="glyphicon glyphicon-print"></i> | Hasil Ujian Ujian</h1>
</div>

<form action="?modul=cetak_hasil" method="post">
    <div class="panel-body">
    <div class="inner-content">
    <div class="wysiwyg-content">
        <p><table width="100%">
			<tr height="40px"><td>Jenis Tes</td><td>: &nbsp;&nbsp;<td>                                  
                <select class="form-control" id="tes3"  name="tes3">
					<?php	$sqk = mysqli_query($sqlconn,"select * from cbt_tes");
							echo "<option value='ALL' selected>SEMUA</option>";	
							while($rs = mysqli_fetch_array($sqk)){echo "<option value=$rs[XKodeUjian]>$rs[XNamaUjian]</option>";} 							
					?>  
                </select>
			</td></tr>        
            <tr height="40px"><td width="30%">Semester</td><td>:<td>  
                <select class="form-control" id="sem3"  name="sem3">
					<option class="form-control" value="1">SEMUA</option>
					<option value=1>Ganjil</option>; 
					<option value=2>Genap</option>; 
                </select>
            </td></tr>
            <tr height="40px"><td><?php echo $rombel;?> </td><td>:<td>                                  
                <select class="form-control" id="jur3"  name="jur3">
					<?php	$sqk = mysqli_query($sqlconn,"select * from cbt_kelas group by XKodeJurusan");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeJurusan]'>$rs[XKodeJurusan]</option>";} 
					?>                                
                </select>
			</td></tr> 
            <tr height="40px"><td width="30%">Kelas </td><td>:<td>  
                <select class="form-control" id="iki3"  name="iki3">
					<?php	$sqk = mysqli_query($sqlconn,"select * from cbt_kelas group by XKodeKelas");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeKelas]'>$rs[XKodeKelas]</option>";}
					?>                                
                </select>
            </td></tr>
            <tr height="40px"><td>Mata Pelajaran </td><td>:<td>                               
                <select class="form-control" id="map3"  name="map3">
					<?php	$sqk = mysqli_query($sqlconn,"select * from cbt_mapel");
								while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeMapel]'>$rs[XKodeMapel] - $rs[XNamaMapel]</option>";} 
					?>                                
                </select>
			</td></tr> 
		</table></p>
    </div>
    </div>
    </div>
	<div class="panel-footer">
    <div class="row">
    <div class="col-xs-offset-7 col-xs-6">
        <button type="submit" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-print"></i> Print Preview</button>
        <button type="submit" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-minus-sign"></i> Tutup</button>
    </div>
    </div>
    </div>
</form>
</div>
</div>
</div>
</div>

    <!-- Modal -->
<div class="modal fade" id="myCetakTO" role="dialog">
<div class="modal-dialog">
    <!-- Modal content-->
<div class="modal-content">
<div class="panel-default">
<div class="panel-heading"> <h1 class="panel-title page-label"><i class="glyphicon glyphicon-print"></i> | Hasil Ujian Try Out</h1></div>
<form action="?modul=cetak_TO" method="post">
    <div class="panel-body">
    <div class="inner-content">
    <div class="wysiwyg-content">
        <p><table width="100%">
			<tr height="40px"><td>Jenis Tes</td><td>:  &nbsp;&nbsp;<td>                                  
                <select class="form-control" id="tes3"  name="tes3">
					<?php	$sqk = mysqli_query($sqlconn,"select * from cbt_tes"); echo "<option value='TO' >Try Out</option>"; ?>                                
                </select>
			</td></tr>        
            <tr height="40px"><td width="30%">Semester</td><td>:<td>   
                <select class="form-control" id="sem3"  name="sem3">
					<?php echo "<option value=1>Ganjil</option>"; echo "<option value=2>Genap</option>"; ?>                                
                </select>
            </td></tr>
            <tr height="40px"><td><?php echo $rombel;?> </td><td>:<td>                                  
                <select class="form-control" id="jur3"  name="jur3">
					<?php	$sqk = mysqli_query($sqlconn,"select * from cbt_kelas group by XKodeJurusan");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeJurusan]'>$rs[XKodeJurusan]</option>";} 
					?>                                
                </select>
			</td></tr> 
            <tr height="40px"><td width="30%">Kelas </td><td>:<td>   
                <select class="form-control" id="iki3"  name="iki3">
					<?php	$sqk = mysqli_query($sqlconn,"select * from cbt_kelas group by XKodeKelas");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeKelas]'>$rs[XKodeKelas]</option>";} 
					?>                                
                </select>
            </td></tr>
            <tr height="40px"><td>Mata Pelajaran </td><td>:<td>                               
                <select class="form-control" id="map3"  name="map3">
					<?php	$sqk = mysqli_query($sqlconn,"select * from cbt_mapel");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeMapel]'>$rs[XKodeMapel]-$rs[XNamaMapel]</option>";} 
					?>                                
                </select>
			</td></tr> 
		</table></p>
    </div>
    </div>
    </div>
    <div class="panel-footer">
    <div class="row">
    <div class="col-xs-offset-7 col-xs-6">
        <button type="submit" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-print"></i> Print Preview</button>
		<button type="submit" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-minus-sign"></i> Tutup</button>
    </div>
    </div>
    </div>
</form>
</div>
</div>
</div>
</div>

<!-- modal Mode Server -->
<div class="modal fade" id="myServer" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
		<!-- MEMBUAT FORM -->
		<form action="?&simpan5=yes" method="post">		
			<div class="panel-default">
			<div class="modal-heading" style="width:100%; background-color:#28b2bc; color:#FFFFFF; padding:10px; margin-top:10px; font-size:22px">
				&nbsp; &nbsp;&nbsp; &nbsp;<i class="fa fa-gears fa-fw"></i> |  Mode Server</h1></div>
			<div class="panel-body">
			<div class="inner-content">
			<div class="wysiwyg-content">
				<table width="100%" border="0" >
					<tr><td>&nbsp; &nbsp; &nbsp; &nbsp; <td>Mode Server  <td >: &nbsp;&nbsp; <td >
						<select class="form-control" id="server1" name="server1">
							<option value='lokal' <?php if ($mode=="lokal") {echo "selected";} ?>>Mode Server PUSAT </option>
							<option value='pusat' <?php if ($mode=="pusat") {echo "selected";} ?>>Mode Server LOKAL </option>
						</select>
					</td><td> &nbsp; &nbsp;  &nbsp; &nbsp;</tr>
					<tr><td> <td>Zona Waktu <td >: <td >
						<select class="form-control" id="zona1" name="zona1">
							<option value='Asia/Jakarta' <?php if ($zo=="Asia/Jakarta") {echo "selected";} ?>>Asia/Jakarta (WIB)</option>
							<option value='Asia/Makassar' <?php if ($zo=="Asia/Makassar") {echo "selected";} ?>>Asia/Makassar (WITA)</option>
							<option value='Asia/Jayapura' <?php if ($zo=="Asia/Jayapura") {echo "selected";}?>>Asia/Jayapura (WIT) </option>
						</select>
					</td><td>  </tr>
					<tr><td> <td>Hak Akses <td >:  <td >
						<select class="form-control" id="hakakses" name="hakakses">
							<option value='0' <?php if ($hakakses=="0") {echo "selected";} ?>>Tiga Hak Akses (Admin | Siswa | Guru)</option>
							<option value='1' <?php if ($hakakses=="1") {echo "selected";} ?>>Dua Hak Akses (Admin | Guru)</option>
						</select>
					</td><td></tr>
					<tr><td> <td>Nilai Kelas Login Siswa <td >: <td >
						<select class="form-control" id="nilaikelas" name="nilaikelas">
							<option value='0' <?php if ($nilaikelas=="0") {echo "selected";} ?>>Nilai Kelas Sembunyi</option>
							<option value='1' <?php if ($nilaikelas=="1") {echo "selected";} ?>>Nilai Kelas Tampil </option>
						</select>
					</td><td></tr>
					<tr><td> <td>Header  Ujian<td >:<td >
						<select class="form-control" id="headerujian" name="headerujian">
							<option value='0' <?php if ($headerujian=="0") {echo "selected";} ?>>Header Ujian Tampil</option>
							<option value='1' <?php if ($headerujian=="1") {echo "selected";} ?>>Header Ujian Sembunyi</option>
						</select>
					</td><td></tr>	
					<tr><td><td>Header Utama <td>: <td>
						<select class="form-control" id="header" name="header">
							<option value='0' <?php if ($header=="0") {echo "selected";} ?>>Header Modern</option>
							<option value='1' <?php if ($header=="1") {echo "selected";} ?>>Header Klasik </option>
						</select>
					</td><td></tr>
					
				</table>
			<br>
			</div>
			</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-xs-offset-7 col-xs-6">
						<button class="btn btn-primary" type="submit" class="btn btn-primary" style="margin-top:0px"><i class="fa fa-laptop"></i> Simpan</button>
						<button type="submit" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp; Batal &nbsp;&nbsp;</button>
					</div>
				</div>
			</div>
	</form>	
	</div>
	</div>
    </div>
</div>

<!-- modal Mode Server -->
<div class="modal fade" id="db_server" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
		<!-- MEMBUAT FORM -->
		<form action="?&simpan_bd=yes" method="post">		
			<div class="panel-default">
			<div class="modal-heading" style="width:100%; background-color:#28b2bc; color:#FFFFFF; padding:10px; margin-top:10px; font-size:22px">
				&nbsp; &nbsp;&nbsp; &nbsp;<i class="fa fa-gear fa-fw"></i> |  Install DataBase Server Baru</h1></div>
			<div class="panel-body">
			<div class="inner-content">
			<div class="wysiwyg-content">
				<table width="80%" border="0" >
					<tr><td> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;<td>Ubah db/Install db Baru<td >:&nbsp;&nbsp; &nbsp;<td >
						<?php echo "<input type='text' class='form-control' name='db_server' value='$db'>"; ?>
					</td><td></tr>
				</table>
			<br>
			</div>
			</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-xs-offset-7 col-xs-6">
						<button class="btn btn-primary" type="submit" class="btn btn-primary" style="margin-top:0px"><i class="fa fa-laptop"></i> Simpan</button>
						<button type="submit" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp; Batal &nbsp;&nbsp;</button>
					</div>
				</div>
			</div>
	</form>	
	</div>
	</div>
    </div>
</div>

<div id="headtop"  style="width:98%; margin:0px 15px 15px 15px; height:60px; background-color:#fffefb; 
	border-bottom-color:#e4e4e2; font-size:14px; padding:15px; text-align:center"><span style="color: #ff0000;"><?php echo strtoupper($skull); ?> </span>| <span style="color: #1B06CF;">suported by BEESMART</span>
</div>

</body>

</html>
<script> function disableBackButton() { window.history.forward(); } setTimeout("disableBackButton()", 0); </script>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/metisMenu/metisMenu.min.js"></script>
<script src="../vendor/raphael/raphael.min.js"></script>
<script src="../vendor/morrisjs/morris.min.js"></script>
<script src="../data/morris-data.js"></script>
<script src="../dist/js/sb-admin-2.js"></script>
<script src="../../mesin/js/jquery.wallform.js"></script>
<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>