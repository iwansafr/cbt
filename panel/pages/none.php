          <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
<?php 
if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
	if($_COOKIE['beelogin']=="siswa"||$_COOKIE['beelogin']=="guru"){
		echo "<h4 style='margin-top:20px'><font color=#78B096> Selamat Datang di </font>
		<h4 style='margin-top:15px'><b><font color=#7895B8  >UJIAN SEKOLAH BERBASIS KOMPUTER (USBK) 
		<h4 style='margin-top:10px'>".$skull." </font></b></h4>
		<h5 style='margin-top:20px'><font color=#0100F7 >Semoga Hari Anda Menyenangkan</h5></font><br><br> 
		<h3><b><font color=#B8A95E >MOTTO :</h3>
		<font color=#F7A805>- JUJUR<br>- CERDAS<br>- KREATIF<br>- SEMANGAT </b></font></span>";
	}else{ 
include "../../config/server.php";

if($mode=="pusat"){
$sqlklien = mysqli_query($sqlconn, "select * from cbt_admin");
$sk = mysqli_fetch_array($sqlklien);
$kodesekolah = $sk['XKodeSekolah'];
//echo $kodesekolah;

		include "../../config/ipserver.php";
			  if(isset($_SERVER['SERVER_NAME'])){
			  $serverIP = $_SERVER['SERVER_NAME'];
			  $alamat2 = $_SERVER['SERVER_PORT'];
			  }
		
		if ($sock = @fsockopen($ipserver, 80, $num, $error, 5)){
		$status_server = 1;
		
		 $host_name = gethostbyaddr($_SERVER['REMOTE_ADDR']); //untuk mendeteksi computer name
		// echo"Nama Komputer : $host_name";
		
		$pc_client = $host_name;
		//echo "Server : $pc_client";z
		include "../../config/server_status.php";		
		
		//echo $status_konek;
		if($status_konek=='1'){
		//$sqlhost = mysqli_query($sqlconn, "select * from server_sekolah where XServerName = '$pc_client' and XServerId = '$kodesekolah'");
		$sqlhost = mysqli_query($sqlconn, "select * from server_sekolah where XServerId = '$kodesekolah'");
		$sqlstatus = mysqli_num_rows($sqlhost);
		//echo "select * from server_sekolah where XServerName = '$pc_client'";
		$sq = mysqli_fetch_array($sqlhost);
		$var_status = $sq['XStatus'];}
		else{
		$var_status = '';$sqlstatus = 9;}		
		//echo "var_server : |$var_status|,sqlstatus : $sqlstatus ";
		
			if($sqlstatus>0&&$var_status=='0'){
				$warna = "warning"; $server_status = "STANDBY";$txt_server_status = "Akses ke Server Pusat Ditutup SN sudah terdaftar di Server Pusat";$huruf ="#ffca01";$bg=
				"#ffca01";
				}
			elseif($var_status==''&&$sqlstatus>0){
				$warna = "danger"; $server_status = "STANDBY";$txt_server_status = "CBTSync tidak terkoneksi ke server pusat";$huruf ="red";$bg=
				"red";}
			elseif($sqlstatus==0&&$var_status=='') { 
				$warna = "danger"; $server_status = "OFFLINE";$txt_server_status = "ID Server / SN tidak sesuai dengan data server pusat"; $huruf ="red";$bg="red";}
			elseif($sqlstatus>0&&$var_status>0){
				$warna = "info"; $server_status = "AKTIF";$txt_server_status = "CBTSync Aktif, Sinkronisasi Siap Digunakan"; $huruf ="#10d8f3";$bg="#15c0d7"; }
			
		?>
		<div style="width:58%">   
					<div class="row" >
						<div align="center">
						<h3 style="color:#21BA04 ; font-size:35px"> <b>SERVER SEKOLAH</b> <h3>
						</div>
						<div  align="center">
								<h4 style="color:<?php echo $huruf; ?>; font-size:30px"><p><?php echo "<b>$server_status</b>"; ?> <span style=color:#999; font-size:14px"><?php //echo $status_internet; ?></span></p></h4><br/>
						</div>
					</div>
							<div class="alert alert-<?php echo $warna; ?>" style="background-color:15c0d7" align="center">
							<?php echo "$txt_server_status "; ?>
							</div>
		 <div class="well" style="" align="center">
								<h4>Server ID : 
								<span class="label" style="background-color:<?php echo $bg; ?>; padding-left:40px; padding-right:40px;  padding-top:6px; padding-bottom:6px; 
                                font-size:24px">
								<?php echo "$kodesekolah"; ?>
								</span></h4>
							</div>
							<div>
						   <?php if($server_status == "AKTIF"){ ?>
							 <a href="?modul=sinkron"><button type="button"  class="btn btn-success" aria-hidden="true">Sinkronisasi</button></a>
							<?php } else { ?>
							<button type="button"  class="btn btn-default" aria-hidden="true" disabled="disabled">Sinkronisasi</button>
							<?php } ?>
							
							</div>
		
		</div>
		<?php 
		}

}else{

include "../../config/server.php";
$host_name = gethostbyaddr($_SERVER['REMOTE_ADDR']); //untuk mendeteksi computer name

$pc_client = $host_name;
$status_server = 0;
$status_internet = "Jaringan server ke Internet : Terhubung";

// Penambahan SQL Statistik  - 2017/03/09
$jumkelas = mysqli_num_rows(mysqli_query($sqlconn, "select * from cbt_kelas"));
$jumsiswa = mysqli_num_rows(mysqli_query($sqlconn, "select * from cbt_siswa"));
$jummapel = mysqli_num_rows(mysqli_query($sqlconn, "select * from cbt_mapel"));
$jumsoal = mysqli_num_rows(mysqli_query($sqlconn, "select * from cbt_paketsoal"));
$jumsek = mysqli_num_rows(mysqli_query($sqlconn, "select * from server_sekolah"));
$jummedia = mysqli_num_rows(mysqli_query($sqlconn, "select * from cbt_upload_file"));
?>
<div style="width:50%" >           
	<div class="row">
		<div align="center">
			<h4 style="color:#A17110; font-size:40px"><p><b>SERVER PUSAT</b> <span style="color:#999; font-size:14px"><?php //echo $status_internet; ?></span></p>	
        	</h4>
    	</div>
		<br>
	</div>
	<div class="alert alert-success" style="background-color:15c0d7" align="center">
		<?php echo "CBTSync Lokal Akif terhubung sebagai Server PUSAT"; ?>
	</div>
 	<div class="well" style="" align="center">
		<h4>Server ID : 
		<span class="label" style="background-color:#33b68f; padding-left:40px; padding-right:40px;  padding-top:6px; padding-bottom:6px; font-size:20px">
			<?php
			$sqlklient = mysqli_query($sqlconn, "select * from cbt_admin");
			$sek = mysqli_fetch_array($sqlklient);
			$kodesek = $sek['XKodeSekolah'];
			echo "$kodesek "; ?>
        </span>
        </h4>
 	</div>
</div>
<?php
if($_COOKIE['beelogin']=="admin"){?>
<!-- Starting Statistik -->
<div class="row">
   
   <!-- Statistik Kelas -->
   <div class="col-lg-3 col-md-6">
      <div class="panel panel-primary">
         <div class="panel-heading">
            <div class="row">
               <div class="col-xs-3"><i class="fa fa-edit fa-5x"></i></div>
               <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo "$jumkelas";?></div>
                  <div>Kelas</div>
               </div>
            </div>
         </div>
         <a href="?modul=daftar_kelas">
            <div class="panel-footer">
               <span class="pull-left">Lihat Detail</span>
               <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
               <div class="clearfix"></div>
            </div>
         </a>
      </div>
   </div>

   <!-- Statistik Siswa -->
   <div class="col-lg-3 col-md-6">
      <div class="panel panel-green">
         <div class="panel-heading">
            <div class="row">
               <div class="col-xs-3"><i class="fa fa-user fa-5x"></i></div>
               <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo "$jumsiswa";?></div>
                  <div>Siswa</div>
               </div>
            </div>
         </div>
         <a href="?modul=daftar_siswa">
            <div class="panel-footer">
               <span class="pull-left">Lihat Detail</span>
               <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
               <div class="clearfix"></div>
            </div>
         </a>
      </div>
   </div>

   <!-- Statistik Mapel -->
   <div class="col-lg-3 col-md-6">
      <div class="panel panel-yellow">
         <div class="panel-heading">
            <div class="row">
               <div class="col-xs-3">
                  <i class="fa fa-book fa-5x"></i>
               </div>
               <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo "$jummapel";?></div>
                  <div>Mapel</div>
               </div>
            </div>
         </div>
         <a href="?modul=daftar_mapel">
            <div class="panel-footer">
               <span class="pull-left">Lihat Detail</span>
               <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
               <div class="clearfix"></div>
            </div>
         </a>
      </div>
   </div>

   <!-- Statistik Soal -->
   <div class="col-lg-3 col-md-6">
      <div class="panel panel-red">
         <div class="panel-heading">
            <div class="row">
               <div class="col-xs-3">
                  <i class="fa fa-tasks fa-5x"></i>
               </div>
               <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo "$jumsoal";?></div>
                  <div>Bank Soal</div>
               </div>
            </div>
         </div>
         <a href="?modul=daftar_soal">
            <div class="panel-footer">
               <span class="pull-left">Lihat Detail</span>
               <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
               <div class="clearfix"></div>
            </div>
         </a>
      </div>
   </div>
</div>
<!-- Starting Statistik -->
<div class="row">
   
   <!-- Statistik Kelas -->
   <div class="col-lg-3 col-md-6">
      <div class="panel" style="background-color:#60DB0F;">
         <div class="panel-heading">
            <div class="row">
               <div class="col-xs-3"><i class="fa fa-home fa-5x"></i></div>
               <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo "$jumsek";?></div>
                  <div>Sekolah</div>
               </div>
            </div>
         </div>
         <a href="?modul=data_skul">
            <div class="panel-footer">
               <span class="pull-left">Lihat Detail</span>
               <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
               <div class="clearfix"></div>
            </div>
         </a>
      </div>
	</div>
   
<!-- End of Statistik -->

   <!-- Statistik Siswa -->
   <div class="col-lg-3 col-md-6">
      <div class="panel panel-danger">
         <div class="panel-heading">
            <div class="row">
               <div class="col-xs-3">
                  <i class="fa fa-gears fa-5x"></i>
               </div>
               <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo "$jummedia";?></div>
                  <div>File Media</div>
               </div>
            </div>
         </div>
         <a href="?modul=upl_filesoal">
            <div class="panel-footer">
               <span class="pull-left">Upload Media Pendukung</span>
               <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
               <div class="clearfix"></div>
            </div>
         </a>
      </div>
   </div>
</div>

<?php }}} ?>
