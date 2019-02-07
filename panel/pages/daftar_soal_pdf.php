<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $skull; ?>-CBT | Administrator</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="./js/jquery-1.4.js"></script>
<script>    
$(document).ready(function(){

	var loading = $("#loading");
	var tampilkan = $("#tampilkan1");
 	var idstu = $("#idstu").val();
	function tampildata(){
	tampilkan.hide();
	loading.fadeIn();
	
	$.ajax({
    type:"POST",
    url:"database_soal_tampil.php",  
	data:"aksi=tampil&idstu=" + idstu,  
	success: function(data){ 
		loading.fadeOut();
		tampilkan.html(data);
		tampilkan.fadeIn(100);
	   }
    }); 
	}// akhir fungsi tampildata
	tampildata();

});
</script>
<style>
.asd {
  display: inline-block;
  width: 30%;
}
</style>
<body>

<!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Bank Soal</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<?php
$sql3 = mysqli_query($sqlconn,"select * from cbt_server");
$xadm10 = mysqli_fetch_array($sql3);
$xserver= $xadm10['XServer'];
  

include "../../config/server.php"; ?>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<table width="100%"><tr><td>Daftar Bank Soal</td>
							<td align="right">
								
                            </td></tr>
							</table>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width="4%">No</th>
										<th width="8%">Kode Sekolah</th>
                                        <th width="20%">Kode Bank Soal</th>
                                        <th width="20%">Mata Pelajaran</th>
                                        	
                                        <th width="6%">Kelas</th>
                                        <th width="7%">Copy|Upload|Edit Bank Soal</th>                                                                                                                        
                                        
                                        <th width="7%">Print&Del</th>
                                                                                                                                                             
                                 </tr>
                                </thead>
                                <tbody>
								
                                <?php 
								$no=0;
if($_COOKIE['beelogin']=='admin'){								
$sql = mysqli_query($sqlconn,"select p.*,m.*,p.Urut as Urutan,p.XKodeSekolah  as kosek,p.XKodeKelas  as kokel from cbt_paketsoal p left join cbt_mapel m on m.XKodeMapel = p.XKodeMapel order by p.Urut desc");
} else {
$sql = mysqli_query($sqlconn,"select p.*,m.*,p.Urut as Urutan,p.XKodeSekolah  as kosek,p.XKodeKelas  as kokel from cbt_paketsoal p left join cbt_mapel m on m.XKodeMapel = p.XKodeMapel where p.XGuru = '$_COOKIE[beeuser]' order by p.Urut desc");								
}								
								while($s = mysqli_fetch_array($sql)){ 
					$sqlsoal = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_soal where XKodeSoal = '$s[XKodeSoal]'"));
					$sqlpakai = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_siswa_ujian where XKodeSoal = '$s[XKodeSoal]' and XStatusUjian = '1'"));
					$sqlsudah = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_jawaban where XKodeSoal = '$s[XKodeSoal]'"));
					if($sqlsoal==0){$katakosong="disabled";}  else {$katakosong="";}	
					if($sqlsudah>0||$sqlpakai>0){$katasudah="disabled";}  else {$katasudah="";}			
					if($sqlpakai>0){$katapakai="disabled";}  else {$katapakai="";}	
										
					$no++
								?>
                                
                                    <tr class="odd gradeX">
                                        <td align="center">
											<input type="hidden" value="<?php echo $s['Urutan']; ?>" id="txt_mapel<?php echo $s['Urutan']; ?>"> 
											<?php echo $no; ?></td>
											<input type="hidden" value="<?php echo $s['XKodeSoal']; ?>" id="txt_soal<?php echo $s['Urutan']; ?>">
                                        <td align="center"><?php echo $s['kosek']; ?></td>
										<td align="center"><?php echo $s['XKodeSoal']; ?></td>
                                        <td align="center"><?php echo $s['XNamaMapel']." (".$s['XKodeMapel'].")"; ?></td>
                                        <td align="center"><?php echo $s['kokel']."-".$s['XKodeJurusan']; ?></td> 
										
										<td align="center">
										
										</td>
                                      
                                        
										<td align="center">
										
										</td>
									
										
									</tr>
  <!-- Button trigger modal -->
   
<script>    
$(document).ready(function(){
$("#simpan<?php echo $s['Urutan']; ?>").click(function(){
//alert("<?php echo $s['Urutan']; ?>");
 var txt_ujian = $("#txt_ujian").val();
 var txt_jawab = $("#txt_jawab").val();
 var txt_acak = $("#switch_left").val();
 var txt_durasi = $("#txt_durasi").val();
 var txt_telat = $("#txt_telat").val();
 var txt_soal = $("#txt_soal<?php echo $s['Urutan']; ?>").val();  
 var txt_mapel = $("#txt_mapel<?php echo $s['Urutan']; ?>").val();
 var txt_level = $("#txt_level").val(); 
 var txt_nama = $("#txt_nama").val();  
 var txt_status = $("#ingat<?php echo $s['Urutan']; ?>").val();    
 $.ajax({
     type:"POST",
     url:"simpan_soal.php",    
     data: "aksi=simpan&txt_ujian=" + txt_ujian + "&txt_jawab=" + txt_jawab + "&txt_acak=" + txt_acak + "&txt_telat=" + txt_telat + "&txt_durasi=" + txt_durasi + "&txt_soal="
	 + txt_soal + "&txt_level=" + txt_level + "&txt_mapel=" + txt_mapel + "&txt_nama=" + txt_nama + "&txt_status=" + txt_status,
	 success: function(data){
		//alert(data);
	 	if(data > 0){
		alert("masalah");
		} else {
				if( $("#simpan<?php echo $s['Urutan']; ?>").hasClass( "btn-success" ) )
		{
		 $("#simpan<?php echo $s['Urutan']; ?>").removeClass("btn-success").addClass("btn-default");
		 $("#simpan<?php echo $s['Urutan']; ?>").val("Aktifkan");
		} else {	 	
	 	 $("#simpan<?php echo $s['Urutan']; ?>").removeClass("btn-info").addClass("btn-success");
		 $("#simpan<?php echo $s['Urutan']; ?>").val("Aktif");		 
		}
		}
	  
	 loading.fadeOut();
	 tampilkan.html(data);
	 tampilkan.fadeIn(100);
	 tampildata();
	 window.location.reload();
	 }
	 
	 
	 });
	 });
	 
$("#acak<?php echo $s['Urutan']; ?>").click(function(){
//alert("<?php echo $s['Urutan']; ?>");
 var txt_ujian = $("#txt_ujian").val();
 var txt_jawab = $("#txt_jawab").val();
 var txt_acak = $("#switch_left").val();
 var txt_durasi = $("#txt_durasi").val();
 var txt_telat = $("#txt_telat").val();
 var txt_soal = $("#txt_soal").val();  
 var txt_mapel = $("#txt_mapel<?php echo $s['Urutan']; ?>").val();
 var txt_level = $("#txt_level").val(); 
  var txt_nama = $("#txt_nama").val();  
  
 $.ajax({
     type:"POST",
     url:"simpan_soal.php",    
     data: "aksi=acak&txt_ujian=" + txt_ujian + "&txt_jawab=" + txt_jawab + "&txt_acak=" + txt_acak + "&txt_telat=" + txt_telat + "&txt_durasi=" + txt_durasi + "&txt_soal=" + txt_soal + "&txt_level=" + txt_level + "&txt_mapel=" + txt_mapel + "&txt_nama=" + txt_nama,
	 success: function(data){

		if( $("#acak<?php echo $s['Urutan']; ?>").hasClass( "btn-success" ) )
		{
		 $("#acak<?php echo $s['Urutan']; ?>").removeClass("btn-success").addClass("btn-warning");
		 $("#acak<?php echo $s['Urutan']; ?>").val("Tidak");
		} else {	 	
	 	 $("#acak<?php echo $s['Urutan']; ?>").removeClass("btn-warning").addClass("btn-success");
		 $("#acak<?php echo $s['Urutan']; ?>").val("Acak");
		}

		loading.fadeOut();
		tampilkan.html(data);
		tampilkan.fadeIn(100);
	 tampildata();
	 }
	 });
	 });	 


$("#hapus<?php echo $s['Urutan']; ?>").click(function(){
//	 alert("<?php echo $s['Urutan']; ?>");
 var txt_ujian = $("#txt_ujian").val();
 var txt_jawab = $("#txt_jawab").val();
 var txt_acak = $("#switch_left").val();
 var txt_durasi = $("#txt_durasi").val();
 var txt_telat = $("#txt_telat").val();
 var txt_soal = $("#txt_soal<?php echo $s['Urutan']; ?>").val();  
 var txt_mapel = $("#txt_mapel<?php echo $s['Urutan']; ?>").val();
 var txt_level = $("#txt_level").val(); 
  var txt_nama = $("#txt_nama").val();  
  
 $.ajax({
     type:"POST",
     url:"hapus_soal.php",    
     data: "aksi=hapus&txt_ujian=" + txt_ujian + "&txt_jawab=" + txt_jawab + "&txt_acak=" + txt_acak + "&txt_telat=" + txt_telat + "&txt_durasi=" + txt_durasi + "&txt_soal=" + txt_soal + "&txt_level=" + txt_level + "&txt_mapel=" + txt_mapel + "&txt_nama=" + txt_nama,
	 success: function(data){

		loading.fadeOut();
		tampilkan.html(data);
		tampilkan.fadeIn(100);
	 tampildata();
	 }
	 });
	 });

$('#btnDelete<?php echo $s['Urutan']; ?>').on('click', function(e){
					
    confirmDialog("Apakah yakin akan menghapus Bank Soal ini?" , function(){
        //My code to delete
 var txt_ujian = $("#txt_ujian").val();
 var txt_jawab = $("#txt_jawab").val();
 var txt_acak = $("#switch_left").val();
 var txt_durasi = $("#txt_durasi").val();
 var txt_telat = $("#txt_telat").val();
 var txt_soal = $("#txt_soal<?php echo $s['Urutan']; ?>").val();  
 var txt_mapel = $("#txt_mapel<?php echo $s['Urutan']; ?>").val();
 var txt_level = $("#txt_level").val(); 
  var txt_nama = $("#txt_nama").val();  
  
 $.ajax({
     type:"POST",
     url:"hapus_soal.php",    
     data: "aksi=hapus&txt_ujian=" + txt_ujian + "&txt_jawab=" + txt_jawab + "&txt_acak=" + txt_acak + "&txt_telat=" + txt_telat + "&txt_durasi=" + txt_durasi + "&txt_soal=" + txt_soal + "&txt_level=" + txt_level + "&txt_mapel=" + txt_mapel + "&txt_nama=" + txt_nama,
	 success: function(data){
	  document.location.reload();
	 // alert("hapus");

		loading.fadeOut();
		tampilkan.html(data);
		tampilkan.fadeIn(100);
	 tampildata();
	 }
	 });
    });
});

$("#tambah<?php echo $s['Urutan']; ?>").click(function(){
//alert("<?php echo $s['Urutan']; ?>");
 var txt_ujianx = $("#txt_ujianx<?php echo "$s[Urutan]"; ?>").val();
 var txt_jawabx = $("#txt_jawabx<?php echo "$s[Urutan]"; ?>").val();
 var txt_acakx = $("#txt_acakx<?php echo "$s[Urutan]"; ?>").val();
 var txt_kelasx = $("#txt_kelasx<?php echo "$s[Urutan]"; ?>").val();
 var txt_jurusanx = $("#txt_jurusanx<?php echo "$s[Urutan]"; ?>").val();
 var txt_mapelx = $("#txt_mapelx<?php echo "$s[Urutan]"; ?>").val();
 var txt_levelx = $("#txt_levelx<?php echo "$s[Urutan]"; ?>").val(); 
 var txt_namax = $("#txt_namax<?php echo "$s[Urutan]"; ?>").val();  
 var txt_jumsoalx = $("#txt_jumsoalx<?php echo "$s[Urutan]"; ?>").val(); 
 var txt_jawabx = $("#txt_jawabx<?php echo "$s[Urutan]"; ?>").val();  
 var txt_kodesek = $("#txt_kodesek<?php echo "$s[Urutan]"; ?>").val();
 var txt_sesix = $("#txt_sesix<?php echo "$s[Urutan]"; ?>").val();
 var txt_acaksoalx = $("#txt_acaksoalx<?php echo "$s[Urutan]"; ?>").val();
 
 var txt_jumsoalz1 = $("#txt_jumsoalz1<?php echo "$s[Urutan]"; ?>").val();  
 var txt_jumsoalz2 = $("#txt_jumsoalz2<?php echo "$s[Urutan]"; ?>").val();  
 var txt_bobotsoalz1 = $("#txt_bobotsoalz1<?php echo "$s[Urutan]"; ?>").val();  
 var txt_bobotsoalz2 = $("#txt_bobotsoalz2<?php echo "$s[Urutan]"; ?>").val();  

  
//alert(txt_ujianx);  
  
 $.ajax({
     type:"POST",
     url:"gandakan_soal.php",    
     data: "aksi=simpan &txt_jumsoalx=" + txt_jumsoalx + "&txt_kodesek=" + txt_kodesek + "&txt_jawabx=" + txt_jawabx + "&txt_acakx=" + txt_acakx + "&txt_kelasx=" + txt_kelasx + "&txt_levelx=" + txt_levelx + "&txt_mapelx=" + txt_mapelx + "&txt_namax=" + txt_namax + "&txt_jurusanx=" + txt_jurusanx + "&txt_ujianx=" + txt_ujianx + "&txt_jumsoalz1=" + txt_jumsoalz1 + "&txt_jumsoalz2=" + txt_jumsoalz2  + "&txt_bobotsoalz1=" + txt_bobotsoalz1 + "&txt_bobotsoalz2=" + txt_bobotsoalz2 + "&txt_sesix=" + txt_sesix + "&txt_acaksoalx=" + txt_acaksoalx,
	 success: function(data){
	      //alert("Soal Sukses Digandakan");
		  document.location.reload();
		if( $("#simpan<?php echo $s['Urutan']; ?>").hasClass( "btn-success" ) )
		{
		 $("#simpan<?php echo $s['Urutan']; ?>").removeClass("btn-success").addClass("btn-default");
		 $("#simpan<?php echo $s['Urutan']; ?>").val("Aktif");
		} else {	 	
	 	 $("#simpan<?php echo $s['Urutan']; ?>").removeClass("btn-info").addClass("btn-success");
		 $("#simpan<?php echo $s['Urutan']; ?>").val("Aktifkan");		 
		}
		loading.fadeOut();
		tampilkan.html(data);
		tampilkan.fadeIn(100);
	 tampildata();
	 }
	 });
	 });


function confirmDialog(message, onConfirm){
    var fClose = function(){
        modal.modal("hide");
    };
    var modal = $("#confirmModal");
    modal.modal("show");
    $("#confirmMessage").empty().append(message);
    $("#confirmOk").one('click', onConfirm);
    $("#confirmOk").one('click', fClose);
    $("#confirmCancel").one("click", fClose);
}


function confirmDialog2(message, onConfirm){
    var fClose = function(){
        modal.modal("hide");
    };
    var modal = $("#confirmModal");
    modal.modal("show");
    $("#confirmMessage").empty().append(message);
    $("#confirmOk").one('click', onConfirm);
    $("#confirmOk").one('click', fClose);
    $("#confirmCancel").one("click", fClose);
}



});


</script>
                                                     
  <!-- Modal confirm -->
<div class="modal" id="confirmModal" style="display: none; z-index: 1050;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="confirmMessage">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="confirmOk">Ok</button>
                <button type="button" class="btn btn-default" id="confirmCancel">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myCopy<?php echo $s['Urutan']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  style="display: none; z-index: 1050;"> 
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
        <?php // echo $s['Urutan']; ?>
                        <div class="panel panel-primary">
                        <div class="panel-heading">
                            Bank Soal yang akan digandakan
                        </div>
                        
                        <div class="panel-body">
						<p><span class="asd" class="asd">Kode Sekolah</span><span>: 
                            <select id="txt_kodesek<?php echo "$s[Urutan]"; ?>">
							<option value='ALL'>SEMUA</option>
                            <?php 
							$sqlsek = mysqli_query($sqlconn,"select * from server_sekolah");
							while($se = mysqli_fetch_array($sqlsek)){
                            echo "<option value='$se[XServerId]'>$se[XServerId]</option>";
							}
							?>
							
                            </select>
							</span>
						</p>
                        <p> <span class="asd" class="asd">Mata Pelajaran</span><span>:
                            <select name="txt_mapelx<?php echo "$s[Urutan]"; ?>" id="txt_mapelx<?php echo "$s[Urutan]"; ?>">
                            <?php 
                            echo "<option value='$s[XKodeMapel]' >$s[XKodeMapel] - $s[XNamaMapel]</option>";
							
                            ?>
                            <?php 
                            $sqlkelas = mysqli_query($sqlconn,"select * from cbt_mapel where NOT XKodeMapel = '$s[XKodeMapel]' order by XKodeMapel");
                            while($sk = mysqli_fetch_array($sqlkelas))
							{ echo "<option value='$sk[XKodeMapel]'>$sk[XKodeMapel] - $sk[XNamaMapel]</option>"; }
                            ?>
                            </select>
                            </span>
						</p>
                        <?php 
                         $sqladmin = mysqli_query($sqlconn,"select * from cbt_admin");
                         $sa = mysqli_fetch_array($sqladmin);
						 $skul = $sa['XTingkat'];
						?>

                        <p><span class="asd" class="asd">Tingkat Sekolah</span><span>: 
                            <select id="txt_levelx<?php echo "$s[Urutan]"; ?>">
 								<option value="SD" <?php if($skul=='SD'){echo "selected";} ?>>SD</option>
								<option value="MI" <?php if($skul=='MI'){echo "selected";} ?>>MI</option>                            
								<option value="SMP" <?php if($skul=='SMP'){echo "selected";} ?>>SMP</option>
								<option value="MTs" <?php if($skul=='MTs'){echo "selected";} ?>>MTs</option>                            
								<option value="SMA" <?php if($skul=='SMA'){echo "selected";} ?>>SMA</option>
								<option value="MA" <?php if($skul=='MA'){echo "selected";} ?>>MA</option>                            
								<option value="SMK" <?php if($skul=='SMK'){echo "selected";} ?>>SMK</option>   							
							</select>
                            </span>
						</p>
                            
                        <p><span class="asd" class="asd">Jurusan</span><span>: 
						
                            <select id="txt_jurusanx<?php echo "$s[Urutan]"; ?>">
                            <?php 
							echo "<option value='$s[XKodeJurusan]' selected>$s[XKodeJurusan]</option>";
							?>
                            <?php 
							$sqljur = mysqli_query($sqlconn,"select * from cbt_kelas where NOT XKodeJurusan = '$s[XKodeJurusan]' group by XKodeJurusan");
							while($j = mysqli_fetch_array($sqljur)){
                            echo "<option value='$j[XKodeJurusan]'>$j[XKodeJurusan]</option>";
							}
							?>
							<option value='ALL'>SEMUA</option>
                            </select>
							</span>
						</p>
                            
                            <p>
                            <span class="asd" class="asd">
                            Kelas</span><span>: 
							<select id="txt_kelasx<?php echo "$s[Urutan]"; ?>">
                            <option value="<?php echo "$s[kokel]"; ?>" selected><?php echo "$s[kokel]"; ?></option>
                             <?php 
							 $sqlkelas = mysqli_query($sqlconn,"select * from cbt_kelas group by XKodeKelas");
							 while($k = mysqli_fetch_array($sqlkelas)){
                             echo "<option value='$k[XKodeKelas]'>$k[XKodeKelas]</option>";
							 }
							 ?>
							 <option value='ALL'>SEMUA</option>
                             </select>
							</span></p>

						<p> <span class="asd" class="asd">Kode Bank Soal </span><span>:
							<?php $soale = "$s[XKodeSoal]"; 
							$carisoal = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_paketsoal where XKodeSoal = '$soale' and XKodeJurusan = '$s[XKodeJurusan]' and 
							XKodeKelas = '$s[kokel]' and XKodeMapel ='$s[XKodeMapel]'"));								
							if($carisoal>0){
							$urutz = date("-dmyhi");
							$soalez = preg_replace('/[0-9]+/', '', $soale);																
							$soalez = "$soalez".$urutz;} 
							else {$soalez = $soale;}
							?>
                            <input size="2" type="hidden" id="txt_ujianx<?php echo "$s[Urutan]"; ?>" value="<?php echo "$s[XKodeSoal]"; ?>"/>
                            <input type="text" id="txt_namax<?php echo "$s[Urutan]"; ?>" value="<?php echo "$soalez"; ?>"/> 
                            </span>  <span style="color: #ff0000;">*</span>
						</p>
						
                        <p><span class="asd" class="asd">Jumlah Opsi Jawaban</span><span>: 
								<select id="txt_jawabx<?php echo "$s[Urutan]"; ?>">
								<option value= '<?php echo "$s[XJumPilihan]"; ?>' selected><?php echo "$s[XJumPilihan]"; ?></option>
									<option value= '5' >5</option>
									<option value='4' >4</option>
									<option value='3' >3</option>
								</select>
						<!--						
						<input size="2" type="text" id="txt_jawabx<?php echo "$s[Urutan]"; ?>" value="<?php echo "$s[XJumPilihan]"; ?>"/> * Default 5 Pilihan
                        !-->
						</span>
						</p>
                            
						<p><span class="asd" class="asd">Pilihan Ganda</span><span>: <input size="2" type="text" id="txt_jumsoalz1<?php echo "$s[Urutan]"; ?>" value="<?php echo "$s[XPilGanda]"; ?>"/> Jml yg ditampilkan
							</span>
						</p>     
							
						<p><span class="asd" class="asd">Bobot Pilihan </span><span>: <input size="2" type="text" id="txt_bobotsoalz1<?php echo "$s[Urutan]"; ?>" value="<?php echo "$s[XPersenPil]"; ?>"/> %
							</span>
						</p>
							
						<p><span class="asd" class="asd">Esai</span><span>: <input size="2" type="text" id="txt_jumsoalz2<?php echo "$s[Urutan]"; ?>" value="<?php echo "$s[XEsai]"; ?>"/> Jml yg ditampilkan
							</span>
						</p>
							
						<p><span class="asd" class="asd">Bobot Pilihan </span><span>: <input size="2" type="text" id="txt_bobotsoalz2<?php echo "$s[Urutan]"; ?>" value="<?php echo "$s[XPersenEsai]"; ?>"/> %
							</span>
						</p>  
						
                                                                             
                        </div>

                        
						<div style="width: 75%; float:left">
						<h4><font color="#FF0000">Keterangan: *</font></h4>
						<ul><li>Jangan ada SPASI, BISA menggunakan tanda sambung (-) </li>
						<li>Hindari Kode Bank Soal yang Terlalu Panjang </li>
						</ul>

                        </div>
                                      
        </div>
        
      </div>
      
      <script>$("#cart").on('hide', function () {
        window.location.reload();
    });</script>
      <div class="modal-footer">
	  <div style="width: 15; float:left">
		<input type="submit"  class="btn btn-info" id="tambah<?php echo $s['Urutan']; ?>" value="Copy Bank Soal" name="tambah<?php echo $s['Urutan']; ?>">
                        </div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>
                              <?php } ?>
                                   
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            <div class="well">
                            <p></p>
                                
                                 <h4><span style="color: #1B06CF;"><?php echo $skull; ?>-CBT</span></h4>
                               <h5>CATATAN PENTING :</h5>
                                <ul><li><font color="#FF0000">Tombol Delete/Hapus Bank Soal Disable bila Bank Soal sedang dipakai ujian, menghapus Bank Soal berarti juga menghapus daftar Analisa Hasil Ujian </font>
                                </li>

                                <li>Langkah-langkah pembuatan soal<ul>
                                	<li>Membuat Bank Soal sesuai format excel template(oleh Guru)</li>
                                	<li>Upload File excel (oleh Guru/Admin)</li>                                    
                                	<li>Edit Soal apabila dirasa perlu , seperti equation dan insert gambar (oleh Guru) dan jangan lupa pengacakan soal dan Kunci Jawaban harus diisi</li>
                                	<li>Mengaktifkan Status Bank Soal (oleh Guru/Admin), sehingga akan nampak pada halaman administrator untuk dibuat Paket Soal bersama Bank soal dari guru
                                    lain apabila akan melakukan tes pada waktu yang bersamaan.</li>
                                	<li>Buat jadwal/aktifkan ujian & generate Token (oleh Admin)</li>                                    
                                </ul></li>
                                <li>Bank Soal tidak bisa dihapus atau diedit selama Sedang AKTIF digunakan ujian</li>
                                <li>Bank Soal yang aktif belum bisa dipergunakan untuk ujian bila belum di buat jawdwal ujian oleh Admin</li>
                                </ul>                              
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           
    <script src="../vendor/jquery/jquery-1.12.3.js"></script>
    <script src="../vendor/jquery/jquery.dataTables.min.js"></script>
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    
	
	
	});
    </script>
    <script>$(document).ready(function() {
    var table = $('#example').DataTable();
 
    $('#example tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
 
    $('#button').click( function () {
        table.row('.selected').remove().draw( false );
    } );
} );</script>
    
 
<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
       
      <div class="modal-body">
        <?php include "buat_banksoalbaru.php";?>
      </div>
      <div class="modal-footer">
        <div style="width:19%; float:left">
		<input type="submit"  class="btn btn-info" id="baru" value="Buat Bank Soal" name="baru"> </div>
		<div style="width: 9%; float:right">
		<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button> </div>
		
			   
      </div>
  </div>
  </div>
</div>
</div>
</div>

<script>
	$('#myModal').on('shown.bs.modal', function () {
	  $('#myInput').focus()
	})
	$('#myModal').on('hidden.bs.modal', function () {
	  document.location.reload();
	 // alert("tes");
	})
	
	$('#confirmModal').on('hidden.bs.modal', function () {
	  document.location.reload();
	  //alert("hapus");
	})
</script>

</body>

</html>
