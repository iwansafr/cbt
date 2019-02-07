<?php ini_set('max_execution_time',0); 
	include "../../config/ipserver.php";
	$PCSERVER = $host_name;

	include "../../config/server.php";
	$serverid= $log['XKodeSekolah'];
	$folder=$log['XFolderPusat'];
	
	include "../../config/server_pusat.php";
		$sql = mysqli_query($sqlconn,"select * from server_sekolah where XServerId='$serverid'");
		$st = mysqli_fetch_array($sql);
		
		$sinch = mysqli_query($sqlconn,"select * from cbt_sinc where XServerId='$serverid'");
		if ($sinch == TRUE){
			$sts = $st['XStatusSinc']; 
			if ($sts=="2"){$kata="disabled";}
			else{$kata="enabled";}
			$sinch1=mysqli_num_rows($sinch);
			$now=date("Y-m-d H:i:s");
			if($sinch1==0){
				$sinch2=mysqli_query($sqlconn,"INSERT into cbt_sinc (XServerId, XData1, XData2, XData3, XData4, XData5, XData6, XData7, XData8, XData9, XData10, XData11, XData12, XTanggal) 
				values ('$serverid','0','0','0','0','0','0','0','0','0','0','0','0','$now')");
			}
			$sinc = mysqli_fetch_array($sinch);
			$data1 = $sinc['XData1'];			$data2 = $sinc['XData2'];
			$data3 = $sinc['XData3'];			$data4 = $sinc['XData4'];
			$data5 = $sinc['XData5'];			$data6 = $sinc['XData6'];
			$data7 = $sinc['XData7'];			$data8 = $sinc['XData8'];
			$data9 = $sinc['XData9'];			$data10 = $sinc['XData10'];
			$data11 = $sinc['XData11'];			$data12 = $sinc['XData12'];
		}else{
		$data1 = 0;		$data2 = 0;
		$data3 = 0;		$data4 = 0;
		$data5 = 0;		$data6 = 0;
		$data7 = 0;		$data8 = 0;
		$data9 = 0;		$data10 = 0;
		$data11 = 0;	$data12 = 0;	
		}
?>

<br> 

	<table border="0" width="250px" cellpadding="20px" cellspacing="20px">
	<tr>
	<?php include "../../config/server_pusat.php";
		$sync = mysqli_query($sqlconn,"select * from cbt_sinc where XServerId='$serverid'");
		if ($sync == TRUE){
		$syn0 = mysqli_fetch_array($sync);
		$syn1=$syn0['XData1'];
		$syn2=$syn0['XData2'];
		$syn3=$syn0['XData3'];
		$syn4=$syn0['XData4'];
		$syn5=$syn0['XData5'];
		$syn6=$syn0['XData6'];
		$syn7=$syn0['XData7'];
		$syn8=$syn0['XData8'];
		$syn9=$syn0['XData9'];
		}else{
		$syn1=0;
		$syn2=0;
		$syn3=0;
		$syn4=0;
		$syn5=0;
		$syn6=0;
		$syn7=0;
		$syn8=0;
		$syn9=0;
		}
	?> 
		<td><a href="#" data-toggle='modal' data-target='#myInfoz'>
						<button class="btn btn-info">REFRESH</button>
					</a>
        </td>
		<td> 
			<?php 	if ($syn9==0 and $syn8==0 and $syn7==0 and $syn6==0 and $syn5==0 and $syn4==0 and $syn3==0 and $syn2==0 and $syn1==0){echo "&nbsp;<a href='#myTam' id='custId' data-toggle='modal' data-id=''>
					<button type='button' class='btn btn-danger' >START SYNC</button>
			</a>";} 
					else {?><input name="upload" type="submit" value="SYNC SELESAI" <?php echo $kata; ?> class="btn btn-danger" style="margin-top:0px">
			<?php 	} ?>
		</td>		
	</tr>
		
	</table>
	
<style>
.an ul {	list-style-type: none;	margin: 0;	padding: 0;	overflow: hidden; }
.an li {	float: left;	width:50%; list-style:none; }
</style>

<script>
    setTimeout(myFunction, 9000)
</script>
        
 <div class="modal fade" id="myTam" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
        <!-- MEMBUAT FORM -->
			<form method="post" enctype="multipart/form-data" action="<?php echo "?modul=sinkronsatu"; ?>">
				<div class="form-group">
					<div style="width:100%; background-color:#28b2bc; color:#FFFFFF; padding:10px; margin-top:10px; font-size:22px">Sinkron Data</div>
					<label></label>
				</div>
				<table>
					<tr><td width="10%"></td>
						<td width="30%">
							<div class="form-group">
								<input type="checkbox" value="1" checked="checked" name="data_siswa"> <label>Data 1 : Data Siswa</label>
							</div>
						</td>
						<td width="30%">
							<div class="form-group">
								<input type="checkbox" value="1" checked="checked" name="data_gambar"> <label>Data 6 : Data Gambar</label>
							</div>
						</td>
					</tr>
					<tr><td width="10%"></td>
						<td width="30%">
							<div class="form-group">
								<input type="checkbox" value="1" checked="checked" name="data_kelas"> <label>Data 2 : Data Kelas</label>
							</div>
						</td>
						<td width="30%">
							<div class="form-group">
								<input type="checkbox" value="1" checked="checked" name="data_audio"> <label>Data 7 : Data Audio</label>
							</div>
						</td>
					</tr>
					<tr><td width="10%"></td>
						<td width="30%">
							<div class="form-group">
								<input type="checkbox" value="1" checked="checked" name="paket_soal"> <label>Data 3 : Paket Soal</label>
							</div>
						</td>
						<td width="30%">
							<div class="form-group">
								<input type="checkbox" value="1" checked="checked" name="data_video"> <label>Data 8 : Data Video</label>
							</div>
						</td>
					</tr>
					<tr><td width="10%"></td>
						<td width="30%">
							<div class="form-group">
								<input type="checkbox" value="1" checked="checked" name="data_soal"> <label>Data 4 : Data Soal</label>
							</div>
						</td>
						<td width="30%">
							<div class="form-group">
								<input type="checkbox" value="1" checked="checked" name="data_pdf"> <label>Data 9 : Data PDF</label>
							</div>
						</td>
					</tr>
					<tr><td width="10%"></td>
						
						
						<td width="30%">
							<div class="form-group">
								<input type="checkbox" value="1" checked="checked" name="data_mapel"> <label>Data 5 : Data Mapel</label>
							</div>
						</td>
					</tr>
				</table>
				<center><input name="upload" type="submit" value="START SYNC"  class="btn btn-danger" style="margin-top:0px">
					<br><br><button type="submit" class="btn btn-default btn-sm" data-dismiss="modal">
								<i class="glyphicon glyphicon-minus-sign"></i> Close
							</button>
				</center>
			</form>                
            <div class="fetched-data2"></div>
            </div>
        </div>
    </div>
</div>          
<!-- Sinkron Siswa-->                        
<div style="width:75%; background-color:#28b2bc; color:#FFFFFF; padding:15px; margin-top:10px; font-size:22px">Sync Progress Status</div>
<!-- Progress bar holder -->
<div style="margin-top:10px;width:77%;"><ul class="an"><li style="margin-left:-40px;">DATA 1 : Data Siswa</li><li style="text-align:right; display:none" id="statusdata">Selesai</li></ul></div>
<br>
<div id="progress" style="width:75%; border:1px solid #ccc; padding:5px; margin-top:10px; height:33px"></div>
<!-- Progress information -->
<div id="information1" style="width"></div>

<!-- Sinkron Kelas -->
<!-- Progress bar holder -->
<hr style="width:75%; text-align:left; margin-left:0px; padding:0px">
<div style="margin-top:10px;width:77%;"><ul class="an"><li style="margin-left:-40px;">DATA 2 : Data Kelas</li><li style="text-align:right; display:none" id="statusdata2">Selesai</li></ul></div>
<br>
<div id="progress2" style="width:75%; border:1px solid #ccc; padding:5px; margin-top:10px; height:33px"></div>
<!-- Progress information -->
<div id="information2" style="width"></div>

<!-- Sinkron Paket Soal -->
<!-- Progress bar holder -->
<hr style="width:75%; text-align:left; margin-left:0px; padding:0px">
<div style="margin-top:10px;width:77%;"><ul class="an"><li style="margin-left:-40px;">DATA 3 : Paket Soal</li><li style="text-align:right; display:none" id="statusdata3">Selesai</li></ul></div>
<br>
<div id="progress3" style="width:75%; border:1px solid #ccc; padding:5px; margin-top:10px; height:33px"></div>
<!-- Progress information -->
<div id="information3" style="width"></div>

<!-- Sinkron Soal -->
<!-- Progress bar holder -->
<hr style="width:75%; text-align:left; margin-left:0px; padding:0px">
<div style="margin-top:10px;width:77%;"><ul class="an"><li style="margin-left:-40px;">DATA 4 : Data Soal</li><li style="text-align:right; display:none" id="statusdata4">Selesai</li></ul></div>
<br>
<div id="progress4" style="width:75%; border:1px solid #ccc; padding:5px; margin-top:10px; height:33px"></div>
<!-- Progress information -->
<div id="information4" style="width"></div>

<!-- Sinkron Mapel -->
<hr style="width:75%; text-align:left; margin-left:0px">
<div style="margin-top:10px;width:77%;"><ul class="an"><li style="margin-left:-40px;">DATA 5 : Data Mapel</li><li style="text-align:right; display:none" id="statusdata5">Selesai</li></ul></div>
<br>
<div id="progress5" style="width:75%; border:1px solid #ccc; padding:5px; margin-top:10px; height:33px"></div>
<!-- Progress information -->
<div id="information5" style="width"></div>

<!-- Sinkron Gambar -->
<hr style="width:75%; text-align:left; margin-left:0px">
<!-- Progress bar holder -->
<div style="margin-top:10px;width:77%;"><ul class="an"><li style="margin-left:-40px;">DATA 6 : Data Gambar</li><li style="text-align:right; display:none" id="statusdataG">Selesai</li></ul></div>
<br>
<div id="progressG" style="width:75%; border:1px solid #ccc; padding:5px; margin-top:10px; height:33px"></div>
<!-- Progress information -->
<div id="informationG" style="width"></div>

<!-- Sinkron Audio-->                        
<!-- Progress bar holder -->
<hr style="width:75%; text-align:left; margin-left:0px">

<div style="margin-top:10px;width:77%;"><ul class="an"><li style="margin-left:-40px;">DATA 7 : Data Audio</li><li style="text-align:right; display:none" id="statusdataA">Selesai</li></ul></div>
<br>
<div id="progressA" style="width:75%; border:1px solid #ccc; padding:5px; margin-top:10px; height:33px"></div>
<!-- Progress information -->
<div id="informationA" style="width"></div>

<!-- Sinkron Video-->                        
<!-- Progress bar holder -->
<hr style="width:75%; text-align:left; margin-left:0px">

<div style="margin-top:10px;width:77%;"><ul class="an"><li style="margin-left:-40px;">DATA 8 : Data Video</li><li style="text-align:right; display:none" id="statusdataV">Selesai</li></ul></div>
<br>
<div id="progressV" style="width:75%; border:1px solid #ccc; padding:5px; margin-top:10px; height:33px"></div>
<!-- Progress information -->
<div id="informationV" style="width"></div>

<!-- Sinkron PDF-->                        
<!-- Progress bar holder -->
<hr style="width:75%; text-align:left; margin-left:0px">

<div style="margin-top:10px;width:77%;"><ul class="an"><li style="margin-left:-40px;">DATA 9 : Data PDF</li><li style="text-align:right; display:none" id="statusdataP">Selesai</li></ul></div>
<br>
<div id="progressP" style="width:75%; border:1px solid #ccc; padding:5px; margin-top:10px; height:33px"></div>
<!-- Progress information -->
<div id="informationP" style="width"></div>

<hr style="width:75%; text-align:left; margin-left:0px">

<?php   

/* === DATA SISWA DATA 1== */

if($_REQUEST['modul']=="sinkronsatu"){
if(isset($_REQUEST['data_siswa'])){
if($data1==0){

include "../../config/server.php";
$sql = mysqli_query($sqlconn,"truncate table cbt_siswa");
$i = 1;

//document.getElementById("information").innerHTML="  Sikronisasi : DATA 1 ... <b>'.$i.'</b> dari <b>'. $baris.'</b> Selesai.";
		include "../../config/server_pusat.php";
		$sqlcek = mysqli_query($sqlconn,"select * from cbt_siswa WHERE XKodeSekolah='$serverid' or XKodeSekolah='ALL'");
		$baris = mysqli_num_rows($sqlcek);
		//echo "jumlah total paket data : $baris";
		if (mysqli_query($sqlconn,"select * from cbt_zona LIMIT 1")==True){
		while($r=mysqli_fetch_array($sqlcek)){
			
					include "../../config/server.php";
					$sql = mysqli_query($sqlconn,"insert into cbt_siswa 
					(XNomerUjian,XNIK,XKodeJurusan,XNamaSiswa,XKodeKelas,XKodeLevel,XJenisKelamin,XPassword,XFoto,XAgama,XSetId,XSesi,XRuang,XKodeSekolah,XPilihan,XNamaKelas) values 			
					('$r[XNomerUjian]','$r[XNIK]','$r[XKodeJurusan]','$r[XNamaSiswa]','$r[XKodeKelas]',			
					'$r[XKodeLevel]','$r[XJenisKelamin]','$r[XPassword]','$r[XFoto]',
					'$r[XAgama]','$r[XSetId]','$r[XSesi]','$r[XRuang]','$r[XKodeSekolah]','$r[XPilihan]','$r[XNamaKelas]')");
			
		$percent = intval($i/$baris * 100)."%";
			// Javascript for updating the progress bar and information
			echo '<script language="javascript">
			document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.';background-image:url(images/pbar-ani1.gif);\">&nbsp;</div>";
		    document.getElementById("information1").innerHTML="  Download Berkas Daftar Siswa <b>'.$i.'</b> row(s) of <b>'. $baris.'</b> ... '.$percent.'  Completed.";			
			</script>';
		// This is for the buffer achieve the minimum size in order to flush data
			echo str_repeat(' ',1024*64);
		// Send output to browser immediately
			flush();
		// Tell user that the process is completed
		$i++;
		}}else{
			while($r=mysqli_fetch_array($sqlcek)){
			
					include "../../config/server.php";
					$sql = mysqli_query($sqlconn,"insert into cbt_siswa 
					(XNomerUjian,XNIK,XKodeJurusan,XNamaSiswa,XKodeKelas,XKodeLevel,XJenisKelamin,XPassword,XFoto,XAgama,XSetId,XSesi,XRuang,XKodeSekolah,XPilihan) values 			
					('$r[XNomerUjian]','$r[XNIK]','$r[XKodeJurusan]','$r[XNamaSiswa]','$r[XKodeKelas]',			
					'$r[XKodeLevel]','$r[XJenisKelamin]','$r[XPassword]','$r[XFoto]',
					'$r[XAgama]','$r[XSetId]','$r[XSesi]','$r[XRuang]','$r[XKodeSekolah]','$r[XPilihan]')");
			
		$percent = intval($i/$baris * 100)."%";
			// Javascript for updating the progress bar and information
			echo '<script language="javascript">
			document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.';background-image:url(images/pbar-ani1.gif);\">&nbsp;</div>";
		    document.getElementById("information1").innerHTML="  Download Berkas Daftar Siswa <b>'.$i.'</b> row(s) of <b>'. $baris.'</b> ... '.$percent.'  Completed.";			
			</script>';
		// This is for the buffer achieve the minimum size in order to flush data
			echo str_repeat(' ',1024*64);
		// Send output to browser immediately
			flush();
		// Tell user that the process is completed
		$i++;
		}
		}
		include "../../config/server_pusat.php";
		$now1=date("Y-m-d H:i:s");
		if ($sinch == TRUE){
					$sin1 = mysqli_query($sqlconn,"UPDATE cbt_sinc SET XData1='1', XTanggal='$now1' where XServerId='$serverid'");
					$sina = mysqli_query($sqlconn,"UPDATE server_sekolah SET XStatusSinc='1' where XServerId='$serverid'");
		}
		}
		}
?>
		<script>document.getElementById("statusdata").style.display="block";
        setTimeout(myFunction, 9000);
        </script>
		
<?php

/* === KELAS DATA 2== */
if(isset($_REQUEST['data_kelas'])){
	if($data2==0){
include "../../config/server.php";
$sql = mysqli_query($sqlconn,"truncate table cbt_kelas");
$i = 1;

//document.getElementById("information").innerHTML="  Sikronisasi : DATA 2 ... <b>'.$i.'</b> dari <b>'. $baris.'</b> Selesai.";
		include "../../config/server_pusat.php";
		$sqlcek = mysqli_query($sqlconn,"select * from cbt_kelas WHERE XKodeSekolah='$serverid' or XKodeSekolah='ALL'");
		$baris = mysqli_num_rows($sqlcek);
				
		while($r=mysqli_fetch_array($sqlcek)){
		
					include "../../config/server.php";
					$sql = mysqli_query($sqlconn,"insert into cbt_kelas 
					(XKodeLevel,XNamaKelas,XKodeJurusan,XKodeKelas,XStatusKelas,XKodeSekolah) values 			
					('$r[XKodeLevel]','$r[XNamaKelas]','$r[XKodeJurusan]','$r[XKodeKelas]','$r[XStatusKelas]','$r[XKodeSekolah]')");

		$percent = intval($i/$baris * 100)."%";
			// Javascript for updating the progress bar and information
			echo '<script language="javascript">
			document.getElementById("progress2").innerHTML="<div style=\"width:'.$percent.';background-image:url(images/pbar-ani1.gif);\">&nbsp;</div>";
		    document.getElementById("information2").innerHTML="  Download Berkas Kelas <b>'.$i.'</b> row(s) of <b>'. $baris.'</b> ... '.$percent.'  Completed.";			
			</script>';
		// This is for the buffer achieve the minimum size in order to flush data
			echo str_repeat(' ',1024*64);
		// Send output to browser immediately
			flush();
		// Tell user that the process is completed
		  
		
		$i++;
		} 
		include "../../config/server_pusat.php";
		$now2=date("Y-m-d H:i:s");
		if ($sinch == TRUE){
					$sin2 = mysqli_query($sqlconn,"UPDATE cbt_sinc SET XData2='1', XTanggal='$now2' where XServerId='$serverid'");
					$sinb = mysqli_query($sqlconn,"UPDATE server_sekolah SET XStatusSinc='1' where XServerId='$serverid'");
		}			
		}
		}
?>
		<script>document.getElementById("statusdata2").style.display="block";
        setTimeout(myFunction, 9000);
        </script>
        
<?php 	

/* === PAKET SOAL DATA 3== */
if(isset($_REQUEST['paket_soal'])){
	if($data3==0){
include "../../config/server.php";
$sql = mysqli_query($sqlconn,"truncate table cbt_paketsoal");
$i = 1;

//document.getElementById("information").innerHTML="  Sikronisasi : DATA 3 ... <b>'.$i.'</b> dari <b>'. $baris.'</b> Selesai.";
		include "../../config/server_pusat.php";
		$sqlcek = mysqli_query($sqlconn,"select * from cbt_paketsoal WHERE XKodeSekolah='$serverid' or XKodeSekolah='ALL'");
		$baris = mysqli_num_rows($sqlcek);
		if (mysqli_query($sqlconn,"select * from cbt_sinc LIMIT 1")==True){
		while($r=mysqli_fetch_array($sqlcek)){
		
					include "../../config/server.php";
					$sql = mysqli_query($sqlconn,"insert into cbt_paketsoal 
					(XKodeKelas,XLevel,XKodeJurusan,XKodeMapel,XKodeLevel,
					XSesi,XJenisSoal,XPilGanda,XEsai,XPersenPil,
					XPersenEsai,XKodeSoal,XJumPilihan,XJumSoal,JumUjian,
					XAcakSoal,XGuru,XSetId,XSemua,XStatusSoal,XTglBuat,XKodeSekolah,XPaketSoal
					) values 			
					('$r[XKodeKelas]','$r[XLevel]','$r[XKodeJurusan]','$r[XKodeMapel]','$r[XKodeLevel]',
					'$r[XSesi]','$r[XJenisSoal]','$r[XPilGanda]','$r[XEsai]','$r[XPersenPil]',
					'$r[XPersenEsai]','$r[XKodeSoal]','$r[XJumPilihan]','$r[XJumSoal]','$r[JumUjian]',
					'$r[XAcakSoal]','$r[XGuru]','$r[XSetId]','$r[XSemua]','$r[XStatusSoal]','$r[XTglBuat]','$r[XKodeSekolah]','$r[XPaketSoal]')");
			
		$percent = intval($i/$baris * 100)."%";
			// Javascript for updating the progress bar and information
			echo '<script language="javascript">
			document.getElementById("progress3").innerHTML="<div style=\"width:'.$percent.';background-image:url(images/pbar-ani1.gif);\">&nbsp;</div>";
		    document.getElementById("information3").innerHTML="  Download Berkas Paket Soal <b>'.$i.'</b> row(s) of <b>'. $baris.'</b> ... '.$percent.'  Completed.";			
			</script>';
		// This is for the buffer achieve the minimum size in order to flush data
			echo str_repeat(' ',1024*64);
		// Send output to browser immediately
			flush();
		// Tell user that the process is completed
		  
		
		$i++;
		}}else{
			while($r=mysqli_fetch_array($sqlcek)){
		
					include "../../config/server.php";
					$sql = mysqli_query($sqlconn,"insert into cbt_paketsoal 
					(XKodeKelas,XLevel,XKodeJurusan,XKodeMapel,XKodeLevel,
					XSesi,XJenisSoal,XPilGanda,XEsai,XPersenPil,
					XPersenEsai,XKodeSoal,XJumPilihan,XJumSoal,JumUjian,
					XAcakSoal,XGuru,XSetId,XStatusSoal,XTglBuat,XKodeSekolah,XPaketSoal
					) values 			
					('$r[XKodeKelas]','$r[XLevel]','$r[XKodeJurusan]','$r[XKodeMapel]','$r[XKodeLevel]',
					'$r[XSesi]','$r[XJenisSoal]','$r[XPilGanda]','$r[XEsai]','$r[XPersenPil]',
					'$r[XPersenEsai]','$r[XKodeSoal]','$r[XJumPilihan]','$r[XJumSoal]','$r[JumUjian]',
					'$r[XAcakSoal]','$r[XGuru]','$r[XSetId]','$r[XStatusSoal]','$r[XTglBuat]','$r[XKodeSekolah]','$r[XPaketSoal]')");
			
		$percent = intval($i/$baris * 100)."%";
			// Javascript for updating the progress bar and information
			echo '<script language="javascript">
			document.getElementById("progress3").innerHTML="<div style=\"width:'.$percent.';background-image:url(images/pbar-ani1.gif);\">&nbsp;</div>";
		    document.getElementById("information3").innerHTML="  Download Berkas Paket Soal <b>'.$i.'</b> row(s) of <b>'. $baris.'</b> ... '.$percent.'  Completed.";			
			</script>';
		// This is for the buffer achieve the minimum size in order to flush data
			echo str_repeat(' ',1024*64);
		// Send output to browser immediately
			flush();
		// Tell user that the process is completed
		  
		
		$i++;
		}}
		include "../../config/server_pusat.php";
		$now3=date("Y-m-d H:i:s");
		if ($sinch == TRUE){
					$sin3 = mysqli_query($sqlconn,"UPDATE cbt_sinc SET XData3='1', XTanggal='$now3' where XServerId='$serverid'");
					$sinc = mysqli_query($sqlconn,"UPDATE server_sekolah SET XStatusSinc='1' where XServerId='$serverid'");
		}	
		}
		} 
?>
		<script>document.getElementById("statusdata3").style.display="block";
        setTimeout(myFunction, 9000);
        </script>
        
<?php 	

/* === CBT SOAL DATA 4== */
if(isset($_REQUEST['data_soal'])){	
if($data4==0){
include "../../config/server.php";
$sql = mysqli_query($sqlconn,"truncate table cbt_soal");
$i = 1;

		include "../../config/server_pusat.php";
		$sqlcek = mysqli_query($sqlconn,"select * from cbt_soal order by Urut");
		$baris = mysqli_num_rows($sqlcek);
		
		while($r=mysqli_fetch_array($sqlcek)){
	
					include "../../config/server.php";
							 $hasil= mysqli_query($sqlconn,"INSERT INTO cbt_soal (XNomerSoal, XKodeMapel, XKodeSoal, XTanya, XJawab1, XGambarJawab1, XJawab2,XGambarJawab2, 
							 XJawab3,XGambarJawab3, XJawab4,XGambarJawab4, XJawab5,XGambarJawab5, XAudioTanya, XVideoTanya, XGambarTanya, XKunciJawaban,XJenisSoal,XAcakSoal,
							 XAcakOpsi,XKategori,XAgama) 
							 VALUES ('$r[XNomerSoal]','$r[XKodeMapel]','$r[XKodeSoal]','$r[XTanya]','$r[XJawab1]','$r[XGambarJawab1]','$r[XJawab2]','$r[XGambarJawab2]',
							'$r[XJawab3]','$r[XGambarJawab3]','$r[XJawab4]','$r[XGambarJawab4]','$r[XJawab5]','$r[XGambarJawab5]','$r[XAudioTanya]',
							 '$r[XVideoTanya]','$r[XGambarTanya]','$r[XKunciJawaban]','$r[XJenisSoal]','$r[XAcakSoal]','$r[XAcakOpsi]','$r[XKategori]','$r[XAgama]')");
		
						
			// Calculate the percentation
			$percent = intval($i/$baris * 100)."%";

//		$percent = intval($i/$baris * 100)."%";
//			document.getElementById("information2").innerHTML="  Sikronisasi : DATA 4 ... <b>'.$i.'</b> dari <b>'. $baris.'</b> Selesai.";			

			// Javascript for updating the progress bar and information
			echo '<script language="javascript">
			document.getElementById("progress4").innerHTML="<div style=\"width:'.$percent.';background-image:url(images/pbar-ani1.gif);\">&nbsp;</div>";
		    document.getElementById("information4").innerHTML="  Download Berkas Soal <b>'.$i.'</b> row(s) of <b>'. $baris.'</b> ... '.$percent.'  completed.";			
			</script>';
		// This is for the buffer achieve the minimum size in order to flush data
			echo str_repeat(' ',1024*64);
		// Send output to browser immediately
			flush();
		// Tell user that the process is completed

		//}
				
		$i++;
		}
				include "../../config/server_pusat.php";
		$now4=date("Y-m-d H:i:s");
		if ($sinch == TRUE){
					$sin4 = mysqli_query($sqlconn,"UPDATE cbt_sinc SET XData4='1', XTanggal='$now4' where XServerId='$serverid'");
					$sind = mysqli_query($sqlconn,"UPDATE server_sekolah SET XStatusSinc='1' where XServerId='$serverid'");
		}		
		}
} ?>
		<script>document.getElementById("statusdata4").style.display="block";
        setTimeout(myFunction, 9000);
        </script>

  
<?php 		

/* === CBT MAPEL DATA 5== */

include "../../config/server.php";
if(isset($_REQUEST['data_mapel'])){
	if($data5==0){
$sql = mysqli_query($sqlconn,"truncate table cbt_mapel");
$i = 1;

		include "../../config/server_pusat.php";
		$sqlcek = mysqli_query($sqlconn,"select * from cbt_mapel WHERE XKodeSekolah='$serverid' or XKodeSekolah='ALL'");
		$baris = mysqli_num_rows($sqlcek);
				
		while($r=mysqli_fetch_array($sqlcek)){
		
					include "../../config/server.php";
					
					$query =  mysqli_query($sqlconn,"INSERT INTO cbt_mapel ( 
					XKodeMapel, XNamaMapel,XPersenUH,XPersenUTS,XPersenUAS,XKKM,XMapelAgama,XKodeSekolah) VALUES (
					'$r[XKodeMapel]', '$r[XNamaMapel]', '$r[XPersenUH]', '$r[XPersenUTS]', '$r[XPersenUAS]', '$r[XKKM]','$r[XMapelAgama]','$r[XKodeSekolah]')");
					
			$percent = intval($i/$baris * 100)."%";
		
			// Javascript for updating the progress bar and information
			echo '<script language="javascript">
			document.getElementById("progress5").innerHTML="<div style=\"width:'.$percent.';background-image:url(images/pbar-ani1.gif);\">&nbsp;</div>";
		    document.getElementById("information5").innerHTML="  Download Berkas Mata Pelajaran <b>'.$i.'</b> row(s) of <b>'. $baris.'</b> ... '.$percent.'  completed.";			
			</script>';
		// This is for the buffer achieve the minimum size in order to flush data
			echo str_repeat(' ',1024*64);
		// Send output to browser immediately
			flush();
		// Tell user that the process is completed
		
		$i++;
		}
		include "../../config/server_pusat.php";
		$now5=date("Y-m-d H:i:s");
		if ($sinch == TRUE){
					$sin5 = mysqli_query($sqlconn,"UPDATE cbt_sinc SET XData5='1', XTanggal='$now5' where XServerId='$serverid'");
					$sine = mysqli_query($sqlconn,"UPDATE server_sekolah SET XStatusSinc='1' where XServerId='$serverid'");
		}		
		}
		}	?>
		<script>document.getElementById("statusdata5").style.display="block";
        setTimeout(myFunction, 9000);
        </script>
	
<?php

////// === DATA 6 : GAMBAR == /////////

if(isset($_REQUEST['data_gambar'])){
	if($data6==0){
include "../../config/server.php";
//$sql = mysqli_query($sqlconn,"truncate table cbt_upload_file");
$i = 1;

		include "../../config/server_pusat.php";
		$sqlcek = mysqli_query($sqlconn,"select * from cbt_upload_file where XFolder ='pictures'");
		$baris = mysqli_num_rows($sqlcek);
		//echo "jumlah total paket data : $baris";
		
		while($r=mysqli_fetch_array($sqlcek)){
		//for ($i=1; $i<=$baris; $i++){
					
					include "../../config/server.php";
							 $hasil= mysqli_query($sqlconn,"INSERT INTO cbt_upload_file (Urut, XNamaFile, XFolder) 
							 VALUES ('$r[Urut]','$r[XNamaFile]','$r[XFolder]')");
 
				
		$i++;
		}
	
include "../../config/server_pusat.php";
$sql1 = mysqli_query($sqlconn,"select * from cbt_upload_file where XFolder ='pictures' group by XNamaFile");
$jum1 = mysqli_num_rows($sql1);
$i = 0;
while($r=mysqli_fetch_array($sql1)){
	if(!$r['XNamaFile']==''){
	$filese = "$r[XNamaFile]";	
$i++;

//echo "$i. file |$filese|<br>";
//$url = 'http://SMP-BINAKARYA/beesmart2/pictures/'.$filese; // working
//$file = fopen(dirname(__FILE__) . '/images/'.$filese, 'w+');
//$url = 'http://demo.cbtbeesmart.com/pictures/'.$filese; online
//$file = fopen('../../pictures/'.$filese, 'w+');

if($folder==''){$url = 'http://'.$PCSERVER.'/pictures/'.$filese; }else{$url = 'http://'.$PCSERVER.'/'.$folder.'/pictures/'.$filese;} 

$file = fopen('../../pictures/'.$filese, 'w+');
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_TIMEOUT, 0); 
// Update as of PHP 5.4 array() can be written []
curl_setopt_array($curl, [
    CURLOPT_URL            => $url,
//  CURLOPT_BINARYTRANSFER => 1, --- No effect from PHP 5.1.3
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_FILE           => $file,
    CURLOPT_TIMEOUT        => 50,
    CURLOPT_USERAGENT      => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)'
]);

$response = curl_exec($curl);

if($response === false) {
    // Update as of PHP 5.3 use of Namespaces Exception() becomes \Exception()
    throw new \Exception('Curl error: ' . curl_error($curl));
}

$response; // Do something with the response.
$percent = intval($i/$jum1 * 100)."%";
// Javascript for updating the progress bar and information
			echo '<script language="javascript">
			document.getElementById("progressG").innerHTML="<div style=\"width:'.$percent.';background-image:url(images/pbar-ani1.gif);\">&nbsp;</div>";
		    document.getElementById("informationG").innerHTML="  Download Berkas Gambar Soal <b>'.$i.'</b> row(s) of <b>'. $jum1.'</b> ... '.$percent.'  completed.";			
			</script>';
		// This is for the buffer achieve the minimum size in order to flush data
			echo str_repeat(' ',1024*64);
		// Send output to browser immediately
			flush();

	}
}
		include "../../config/server_pusat.php";
		$now6=date("Y-m-d H:i:s");
		if ($sinch == TRUE){
					$sin6 = mysqli_query($sqlconn,"UPDATE cbt_sinc SET XData6='1', XTanggal='$now6' where XServerId='$serverid'");
					$sinf = mysqli_query($sqlconn,"UPDATE server_sekolah SET XStatusSinc='1' where XServerId='$serverid'");
		}		
		}
}
?>
		<script>document.getElementById("statusdataG").style.display="block";
        setTimeout(myFunction, 9000);
        </script>

       
<?php 	

//End of Copying		

/////// === DATA 7 : AUDIO == /////////
if(isset($_REQUEST['data_audio'])){
if($data7==0){
	include "../../config/server.php";
//$sql = mysqli_query($sqlconn,"truncate table cbt_upload_file");
$ia = 1;

		include "../../config/server_pusat.php";
		$sqlceka = mysqli_query($sqlconn,"select * from cbt_upload_file where XFolder ='audio'");
		$barisa = mysqli_num_rows($sqlceka);
		//echo "jumlah total paket data : $baris";
		
		while($ra=mysqli_fetch_array($sqlceka)){
		//for ($i=1; $i<=$baris; $i++){
					
					include "../../config/server.php";
							 $hasila= mysqli_query($sqlconn,"INSERT INTO cbt_upload_file (Urut, XNamaFile, XFolder) 
							 VALUES ('$ra[Urut]','$ra[XNamaFile]','$ra[XFolder]')");
 
				
		$ia++;
		}
	
include "../../config/server_pusat.php";	
$sql2 = mysqli_query($sqlconn,"select * from cbt_upload_file where XFolder ='audio' group by XNamaFile");
$jum2 = mysqli_num_rows($sql2);

$i = 0;
while($r=mysqli_fetch_array($sql2)){
	if(!$r['XNamaFile']==''){
	$filese = "$r[XNamaFile]";		
	
$i++;

if($folder==''){$url = 'http://'.$PCSERVER.'/audio/'.$filese;}else{$url = 'http://'.$PCSERVER.'/'.$folder.'/audio/'.$filese; }
$file = fopen('../../audio/'.$filese, 'w+');
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_TIMEOUT, 0); 
// Update as of PHP 5.4 array() can be written []
curl_setopt_array($curl, [
    CURLOPT_URL            => $url,
//  CURLOPT_BINARYTRANSFER => 1, --- No effect from PHP 5.1.3
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_FILE           => $file,
    CURLOPT_TIMEOUT        => 50,
    CURLOPT_USERAGENT      => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)'
]);

$response = curl_exec($curl);

if($response === false) {
    // Update as of PHP 5.3 use of Namespaces Exception() becomes \Exception()
    throw new \Exception('Curl error: ' . curl_error($curl));
}

$response; // Do something with the response.
$percent = intval($i/$jum2 * 100)."%";
// Javascript for updating the progress bar and information
			echo '<script language="javascript">
			document.getElementById("progressA").innerHTML="<div style=\"width:'.$percent.';background-image:url(images/pbar-ani1.gif);\">&nbsp;</div>";
		    document.getElementById("informationA").innerHTML="  Download Berkas Audio Soal <b>'.$i.'</b> row(s) of <b>'. $jum2.'</b> ... '.$percent.'  completed.";			
			</script>';
		// This is for the buffer achieve the minimum size in order to flush data
			echo str_repeat(' ',1024*64);
		// Send output to browser immediately
			flush();

	}
}
		include "../../config/server_pusat.php";
		$now7=date("Y-m-d H:i:s");
		if ($sinch == TRUE){
					$sin7 = mysqli_query($sqlconn,"UPDATE cbt_sinc SET XData7='1', XTanggal='$now7' where XServerId='$serverid'");
					$sing = mysqli_query($sqlconn,"UPDATE server_sekolah SET XStatusSinc='1' where XServerId='$serverid'");
		}
		}
}
?>
		<script>document.getElementById("statusdataA").style.display="block";
        setTimeout(myFunction, 9000);
        </script>

       
<?php 		


/////// === DATA 8 : VIDEO == /////////


include "../../config/server_pusat.php";
if(isset($_REQUEST['data_video'])){
	if($data8==0 ){
		include "../../config/server.php";
//$sql = mysqli_query($sqlconn,"truncate table cbt_upload_file");
$iv = 1;

		include "../../config/server_pusat.php";
		$sqlcekv = mysqli_query($sqlconn,"select * from cbt_upload_file where XFolder ='video'");
		$barisv = mysqli_num_rows($sqlcekv);
		//echo "jumlah total paket data : $baris";
		
		while($rv=mysqli_fetch_array($sqlcekv)){
		//for ($i=1; $i<=$baris; $i++){
					
					include "../../config/server.php";
							 $hasilv= mysqli_query($sqlconn,"INSERT INTO cbt_upload_file (Urut, XNamaFile, XFolder) 
							 VALUES ('$rv[Urut]','$rv[XNamaFile]','$rv[XFolder]')");
 
				
		$iv++;
		}
	
$sql3 = mysqli_query($sqlconn,"select * from cbt_upload_file where XFolder ='video' group by XNamaFile");
$jum3 = mysqli_num_rows($sql3);
$i = 0;
while($r=mysqli_fetch_array($sql3)){
	if(!$r['XNamaFile']==''){
	$filese = "$r[XNamaFile]";		
$i++;

if ($folder==""){$url = 'http://'.$PCSERVER.'/video/'.$filese; }else{$url = 'http://'.$PCSERVER.'/'.$folder.'/video/'.$filese; }

$file = fopen('../../video/'.$filese, 'w+');
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_TIMEOUT, 0); 
// Update as of PHP 5.4 array() can be written []
curl_setopt_array($curl, [
    CURLOPT_URL            => $url,
//  CURLOPT_BINARYTRANSFER => 1, --- No effect from PHP 5.1.3
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_FILE           => $file,
    CURLOPT_TIMEOUT        => 50,
    CURLOPT_USERAGENT      => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)'
]);

$response = curl_exec($curl);

if($response === false) {
    // Update as of PHP 5.3 use of Namespaces Exception() becomes \Exception()
    throw new \Exception('Curl error: ' . curl_error($curl));
}

$response; // Do something with the response.
$percent = intval($i/$jum3 * 100)."%";
// Javascript for updating the progress bar and information
			echo '<script language="javascript">
			document.getElementById("progressV").innerHTML="<div style=\"width:'.$percent.';background-image:url(images/pbar-ani1.gif);\">&nbsp;</div>";
		    document.getElementById("informationV").innerHTML="  Download Berkas Video Soal <b>'.$i.'</b> row(s) of <b>'. $jum3.'</b> ... '.$percent.'  completed.";			
			</script>';
		// This is for the buffer achieve the minimum size in order to flush data
			echo str_repeat(' ',1024*64);
		// Send output to browser immediately
			flush();

	}
}
	include "../../config/server_pusat.php";
		$now8=date("Y-m-d H:i:s");
		if ($sinch == TRUE){
					$sinh = mysqli_query($sqlconn,"UPDATE cbt_sinc SET XData8='1', XTanggal='$now8' where XServerId='$serverid'");
					$sinc = mysqli_query($sqlconn,"UPDATE server_sekolah SET XStatusSinc='1' where XServerId='$serverid'");
		}
		}
}
?>
		<script>document.getElementById("statusdataV").style.display="block";
        setTimeout(myFunction, 9000);
        </script>

<?php 		

/////// === DATA 9 : PDF == /////////

include "../../config/server_pusat.php";
if (mysqli_query($sqlconn,"select * from cbt_sinc LIMIT 1")==TRUE){
if(isset($_REQUEST['data_pdf'])){
	if($data9==0){
		include "../../config/server.php";
//$sql = mysqli_query($sqlconn,"truncate table cbt_upload_file");
$ip = 1;

		include "../../config/server_pusat.php";
		$sqlcekp = mysqli_query($sqlconn,"select * from cbt_upload_file where XFolder ='file-pdf'");
		$barisp = mysqli_num_rows($sqlcekp);
		if ($sqlcekp>0){
		
		while($rp=mysqli_fetch_array($sqlcekp)){
	
					
					include "../../config/server.php";
							 $hasil= mysqli_query($sqlconn,"INSERT INTO cbt_upload_file (Urut, XNamaFile, XFolder) 
							 VALUES ('$rp[Urut]','$rp[XNamaFile]','$rp[XFolder]')");
 
				
		$ip++;
		}
	
$sql4 = mysqli_query($sqlconn,"select * from cbt_upload_file where XFolder ='file-pdf' group by XNamaFile");
$jum4 = mysqli_num_rows($sql4);
$i = 0;
while($r=mysqli_fetch_array($sql4)){
	if(!$r['XNamaFile']==''){
	$filese = "$r[XNamaFile]";		
$i++;

if ($folder==""){$url = 'http://'.$PCSERVER.'/file-pdf/'.$filese; }else{$url = 'http://'.$PCSERVER.'/'.$folder.'/file-pdf/'.$filese; }

$file = fopen('../../file-pdf/'.$filese, 'w+');
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_TIMEOUT, 0); 
// Update as of PHP 5.4 array() can be written []
curl_setopt_array($curl, [
    CURLOPT_URL            => $url,
//  CURLOPT_BINARYTRANSFER => 1, --- No effect from PHP 5.1.3
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_FILE           => $file,
    CURLOPT_TIMEOUT        => 50,
    CURLOPT_USERAGENT      => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)'
]);

$response = curl_exec($curl);

if($response === false) {
    // Update as of PHP 5.3 use of Namespaces Exception() becomes \Exception()
    throw new \Exception('Curl error: ' . curl_error($curl));
}

$response; // Do something with the response.
$percent = intval($i/$jum4 * 100)."%";
// Javascript for updating the progress bar and information
			echo '<script language="javascript">
			document.getElementById("progressP").innerHTML="<div style=\"width:'.$percent.';background-image:url(images/pbar-ani1.gif);\">&nbsp;</div>";
		    document.getElementById("informationP").innerHTML="  Download Berkas PDF Soal <b>'.$i.'</b> row(s) of <b>'. $jum4.'</b> ... '.$percent.'  completed.";			
			</script>';
		// This is for the buffer achieve the minimum size in order to flush data
			echo str_repeat(' ',1024*64);
		// Send output to browser immediately
			flush();

	}
		}}
	include "../../config/server_pusat.php";
		$now9=date("Y-m-d H:i:s");
		if ($sinch == TRUE){
					$sinh9 = mysqli_query($sqlconn,"UPDATE cbt_sinc SET XData9='1', XTanggal='$now9' where XServerId='$serverid'");
					$sinc9 = mysqli_query($sqlconn,"UPDATE server_sekolah SET XStatusSinc='2' where XServerId='$serverid'");
		}
		}
}
?>
		<script>document.getElementById("statusdataP").style.display="block";
        setTimeout(myFunction, 9000);
        </script><!-- Akhir Sinkron -->

       
<?php }}  
include "../../config/server_pusat.php";
//DATA 1
$sqlsw = mysqli_query($sqlconn,"select * from cbt_siswa WHERE XKodeSekolah='$serverid' or XKodeSekolah='ALL'");
$jumsw = mysqli_num_rows($sqlsw);
//DATA 2
$sqlk = mysqli_query($sqlconn,"select * from cbt_kelas WHERE XKodeSekolah='$serverid' or XKodeSekolah='ALL'");
$jumk = mysqli_num_rows($sqlk);
//DATA 3
$sqlp = mysqli_query($sqlconn,"select * from cbt_paketsoal WHERE XKodeSekolah='$serverid' or XKodeSekolah='ALL'");
$jump = mysqli_num_rows($sqlp);
//DATA 4
$sqls = mysqli_query($sqlconn,"select * from cbt_soal");
$jums = mysqli_num_rows($sqls);
//DATA 5
$sqlm = mysqli_query($sqlconn,"select * from cbt_mapel WHERE XKodeSekolah='$serverid' or XKodeSekolah='ALL'");
$jumm = mysqli_num_rows($sqlm);
//DATA 6
$sql1 = mysqli_query($sqlconn,"select * from cbt_upload_file where XFolder ='pictures' group by XNamaFile");
$jum1 = mysqli_num_rows($sql1);
//DATA 7
$sql2 = mysqli_query($sqlconn,"select * from cbt_upload_file where XFolder ='audio' group by XNamaFile");
$jum2 = mysqli_num_rows($sql2);
//DATA 8
$sql3 = mysqli_query($sqlconn,"select * from cbt_upload_file where XFolder ='video' group by XNamaFile");
$jum3 = mysqli_num_rows($sql3);
//DATA 9
$sql4 = mysqli_query($sqlconn,"select * from cbt_upload_file where XFolder ='file-pdf' group by XNamaFile");
$jum4 = mysqli_num_rows($sql4);


include "../../config/server.php";
//DATA 1
$sqlsw_ = mysqli_query($sqlconn,"select * from cbt_siswa WHERE XKodeSekolah='$serverid' or XKodeSekolah='ALL'");
$jumsw_ = mysqli_num_rows($sqlsw_);
//DATA 2
$sqlk_ = mysqli_query($sqlconn,"select * from cbt_kelas WHERE XKodeSekolah='$serverid' or XKodeSekolah='ALL'");
$jumk_ = mysqli_num_rows($sqlk_);
//DATA 3
$sqlp_ = mysqli_query($sqlconn,"select * from cbt_paketsoal WHERE XKodeSekolah='$serverid' or XKodeSekolah='ALL'");
$jump_ = mysqli_num_rows($sqlp_);
//DATA 4
$sqls_ = mysqli_query($sqlconn,"select * from cbt_soal");
$jums_ = mysqli_num_rows($sqls_);
//DATA 5
$sqlm_ = mysqli_query($sqlconn,"select * from cbt_mapel WHERE XKodeSekolah='$serverid' or XKodeSekolah='ALL'");
$jumm_ = mysqli_num_rows($sqlm_);
//DATA 6
$sql1_ = mysqli_query($sqlconn,"select * from cbt_upload_file where XFolder ='pictures' group by XNamaFile");
$jum1_ = mysqli_num_rows($sql1_);
//DATA 7
$sql2_ = mysqli_query($sqlconn,"select * from cbt_upload_file where XFolder ='audio' group by XNamaFile");
$jum2_ = mysqli_num_rows($sql2_);
//DATA 8
$sql3_ = mysqli_query($sqlconn,"select * from cbt_upload_file where XFolder ='video' group by XNamaFile");
$jum3_ = mysqli_num_rows($sql3_);
//DATA 9
$sql4_ = mysqli_query($sqlconn,"select * from cbt_upload_file where XFolder ='file-pdf' group by XNamaFile");
$jum4_ = mysqli_num_rows($sql4_);
?>
<div class="modal fade" id="myInfoz" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h1 class="panel-title page-label" align="left">Data Hasil Sinkron</h1>
                </div>
                <div class="panel-body">
                    <div class="inner-content">
                        <div class="wysiwyg-content">
                        <table width="565">
						<tr>
	                                    <th width="15%" height="40" align="left" style="border-bottom:thin solid #D1CABC">DATA 1 : Siswa</th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jumsw; ?></th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jumsw_?> </th>
                          </tr>
						  <tr>
	                                    <th width="15%" height="40" align="left" style="border-bottom:thin solid #D1CABC">DATA 2 : Kelas</th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jumk; ?></th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jumk_?> </th>
                          </tr>
						<tr>
	                                    <th width="15%" height="40" align="left" style="border-bottom:thin solid #D1CABC">DATA 3 : Paket Soal</th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jump; ?></th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jump_?> </th>
                          </tr>
						<tr>
	                                    <th width="15%" height="40" align="left" style="border-bottom:thin solid #D1CABC">DATA 4 : Soal</th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jums; ?></th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jums_; ?></th>
                          </tr>
						<tr>
	                                    <th width="15%" height="40" align="left" style="border-bottom:thin solid #D1CABC">DATA 5 : Mapel</th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jumm; ?></th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jumm_; ?></th>
                          </tr>
						<tr>
	                                    <th width="15%" height="40" align="left" style="border-bottom:thin solid #D1CABC">DATA 6 : Gambar</th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jum1;?></th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jum1_;?></th>
                          </tr>
						<tr>
	                                    <th width="15%" height="40" align="left" style="border-bottom:thin solid #D1CABC">DATA 7 : Audio</th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jum2;?></th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jum2_;?></th>
                          </tr>
						<tr>
	                                    <th width="15%" height="40" align="left" style="border-bottom:thin solid #D1CABC">DATA 8 : Video</th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jum3;?> </th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jum3_;?> </th>
                          </tr>
						  <tr>
	                                    <th width="15%" height="40" align="left" style="border-bottom:thin solid #D1CABC">DATA 9 : PDF</th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jum4;?> </th>
										<th width="15%" height="40" align="center" style="border-bottom:thin solid #D1CABC"><?php echo $jum4_;?> </th>
                          </tr>
						</table>
						</div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-offset-4 col-xs-9">                        
                           <button type="submit" class="btn btn-default btn-sm" data-dismiss="modal">
                           <i class="glyphicon glyphicon-minus-sign"></i> Close</button>
                        </div>
                    </div>
                </div></form>
            </div>
        </div>
    </div>
</div>
<script src="../../../mesin/js/jquery.js"></script>


