<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
	
	
	if(isset($_REQUEST['statustoken'])){
		$sqlcek = mysqli_query($sqlconn,"select * from cbt_ujian order by XStatusToken");
		$stat = mysqli_fetch_array($sqlcek);
		$status= $stat['XStatusToken'];
			if($status==0){ $ubah = 1; } 
			elseif($status==1){ $ubah = 0; }
			$sqlpasaif = mysqli_query($sqlconn,"update cbt_ujian set XStatusToken = '$ubah'");
	}
	if(isset($_REQUEST['hasiltampil'])){
		$sqlcekh = mysqli_query($sqlconn,"select * from cbt_ujian order by XTampil");
		$sh = mysqli_fetch_array($sqlcekh);
		$statush= $sh['XTampil'];
			if($statush==0){ $ubahh = 1; } 
			elseif($statush==1){ $ubahh = 0; }
			$sqlpasaifh = mysqli_query($sqlconn,"update cbt_ujian set XTampil = '$ubahh'");
	}
	$sqlt = mysqli_query($sqlconn,"select * from cbt_ujian order by Urut  ");
	$st = mysqli_fetch_array($sqlt);
	$stts= $st['XStatusToken'];	
	$sttsh= $st['XTampil'];
	
	$sqlad = mysqli_query($sqlconn,"select * from cbt_admin");
$ad = mysqli_fetch_array($sqlad);
$tingkat=$ad['XTingkat'];
if ($tingkat=="MA" or $tingkat=="SMA" or $tingkat=="SMK"  ){$rombel="Jurusan";}else{$rombel="Rombel";}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

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

 <?php $tgljam = date("Y/m/d H:i");  
 $tgl = date("Y/m/d"); 
 ?>
  <link rel="stylesheet" type="text/css" href="./css/jquery.datetimepicker.css"/>
<style type="text/css">

.custom-date-style {
	background-color: red !important;
}

.input{	
}
.input-wide{
	width: 500px;
}

</style>
<?php 
$tgx = 29;
$blx = '09';
$thx = 2016;

$tglx = date("Y/m/d");
$jamx = date("H:i:s");
?>
<script src="date/jquery.js"></script>
<script src="./js/jquery.datetimepicker.full.js"></script>
<script>/*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}*/
$.noConflict();
jQuery( document ).ready(function( $ ) {
$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1986/01/05'
});
$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});
$('.some_class').datetimepicker();
$('#default_datetimepicker').datetimepicker({
	formatTime:'H:i',
	//formatDate:'d.m.Y',
	formatDate:'Y.m.d',
	//defaultDate:'8.12.1986', // it's my birthday
	defaultDate:'+03.01.1970', // it's my birthday
	defaultTime:'10:00',
	timepickerScrollbar:false
});
$('#datetimepicker10').datetimepicker({
	step:5,
	inline:true
});
$('#datetimepicker_mask').datetimepicker({
	mask:'9999/19/39 29:59'
});
$('#datetimepicker_mask').datetimepicker({value:'<?php echo "$tglx $jamx"; ?>',step:10});
$('#datetimepicker_dark').datetimepicker({theme:'dark'})
        }); 
</script>
<body>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Reset Peserta | Kontrol Tampil Token & Nilai</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <table width="50%"><tr>
                                        
										<td align="left"><a href="?modul=aktifkan_jadwaltes&hasiltampil">													
                                        <?php if($sttsh=="0"){ ?>
										<button type="button" class="btn btn-primary">Tampilkan Hasil Ujian Semua</button></a>
										
                                        <?php } else { ?>
                                        <button type="button" class="btn btn-warning">Sembunyikan Hasil Ujian Semua</button></a>
										<?php } ?>
                                        </td>
										<td align="left"><a href="?modul=aktifkan_jadwaltes&statustoken">													
                                        <?php if($stts=="0"){ ?>
										<button type="button" class="btn btn-success">Tampilkan Semua Token</button></a>
										
                                        <?php } else { ?>
                                        <button type="button" class="btn btn-warning">Sembunyikan Semua Token</button></a>
										<?php } ?>
                                        </td>										
                                        </td></tr>
							</table>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        		<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
	                                    <th width="2%">No</th>
                                        <th width="15%">Kode Bank Soal</th>
                                        
                                        <th width="5%">Kelas-<?php echo $rombel; ?></th>	
                                        <th width="2%">Sesi</th>	
                                        <th width="5%">Tgl Aktif </th>
                                        <th width="3%">Durasi</th>
										<th width="8%">Hasil Tampil</th> 
										<th width="6%">Token Tampil</th>
										<th width="6%">Token | Reset Login</th>											
                                        <th width="6%">Status Tes</th>    
										 
                                 </tr>
                                </thead>
                                <tbody>
<?php 
$no=0;
$sql = mysqli_query($sqlconn,"select u.*,m.*,u.Urut as Urutan,u.XKodeKelas as kokel from cbt_ujian u left join cbt_mapel m on m.XKodeMapel = u.XKodeMapel 
left join cbt_paketsoal p on p.XKodeSoal = u.XKodeSoal where u.XStatusUjian='1'");
								while($s = mysqli_fetch_array($sql)){ 
					$sqlsoal  = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_soal where XKodeSoal = '$s[XKodeSoal]'"));
					$sqlpakai = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_siswa_ujian where XKodeSoal = '$s[XKodeSoal]' and XStatusUjian = '1'"));
					$sqlsudah = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_jawaban where XKodeSoal = '$s[XKodeSoal]'"));
					if($sqlsoal<1){$kata="disabled";}  else {$kata="";}	
					if($sqlsudah>0||$sqlpakai>0){$kata="disabled";}  else {$kata="";}			
					if($sqlpakai>0){$katapakai="disabled";}  else {$katapakai="";}
					
$time1 = "$s[XJamUjian]";
$time2 = "$s[XLamaUjian]";

$secs = strtotime($time2)-strtotime("00:00:00");
$jamhabis = date("H:i:s",strtotime($time1)+$secs);	
$sekarang = date("H:i:s");	
$tglsekarang = date("Y-m-d");	
$tglujian = "$s[XTglUjian]";
$sttss= $s['XStatusToken'];	
$no++		
								?>
<script>    
$(document).ready(function(){
	
 $("#selesai<?php echo $s['Urutan']; ?>").click(function(){
 
 var txt_ujian = $("#txt_ujian<?php echo $s['Urutan']; ?>").val();
 // alert(txt_ujian);
 $.ajax({
     type:"POST",
     url:"selesaites.php",    
     data: "aksi=selesai&txt_ujian=" + txt_ujian,
	 success: function(data){
	 //alert();
	 location.reload();
		//tampildata();
	 }
	 });
	 });
	

});
</script>                               
                                    <tr class="odd gradeX">
                                        <td align="center"><input type="hidden" value="<?php echo $s['Urutan']; ?>" id="txt_mapel<?php echo $s['Urutan']; ?>"><?php echo $no; ?>
                                        <input type="hidden" value="<?php echo $s['Urutan']; ?>" id="txt_ujian<?php echo $s['Urutan']; ?>">
                                        </td>
                                        <?php echo"
                                        <td align='center'>". $s['XKodeSoal']."</td>
                                        <td align='center'>". $s['kokel']."-".$s['XKodeJurusan']."</td> 
                                        <td align='center'>". $s['XSesi']."</td>
                                        <td align='center'>".$s['XTglUjian']." ".$s['XJamUjian'] ."</td>                                        
                                        <td align='center'>". $s['XLamaUjian']."</td>
										<td align='center'>
										"; if($s['XTampil']=="1"){ echo"
												<button type='button' class='btn btn-primary'>Tampil</button></a>
											"; } else { echo"
												<button type='button' class='btn btn-default'>Tidak</button></a>
											"; } echo"
										</td>
										<td align='center'>
											"; if($s['XStatusToken']=='1'){ echo"
												<button type='button' class='btn btn-success'>Tampil</button></a>
											"; } else { echo"
												<button type='button' class='btn btn-default'>Tidak</button></a>
											"; } ?> 
										</td> 
										
										<td align="center"><a href="?modul=reset_peserta&token=<?php echo $s['XTokenUjian']; ?>">
										 <?php echo " <button class='btn btn-default' ><i class='fa fa-refresh fa-fw'></i> $s[XTokenUjian]</button></a></td>
										<td align='center'>"; if(($s['XStatusUjian']=="0"||$s['XStatusUjian']=="9")||($tglsekarang>$tglujian||$sekarang > $jamhabis)){ echo"
											<input type='button' id='selesai". $s['Urutan']."' class='btn btn-default' value='Selesai'  ". $katapakai; ?>
											<?php } elseif($tglsekarang==$tglujian&&$sekarang < $time1){ ?> <input type="button" id="selesai<?php echo $s['Urutan']; ?>" class="btn btn-default" value="Segera"  <?php echo $katapakai.">"; } else { ?><input type="button" id="selesai<?php echo $s['Urutan']; ?>" class="btn btn-info" value="Aktif" <?php echo $katapakai; ?>
											<?php } ?>></td>     
                                                                                                             
                                    </tr>
  <!-- Button trigger modal -->
  <!-- Modal -->
                            <div class="modal fade" id="myModal<?php echo $s['XNomerUjian']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><?php echo "Peserta Ujian : $s[XNomerUjian]"; ?></h4>
                                        </div>
                                        <div class="modal-body" style="text-align:center">
                                        
                                               <?php 
												if(file_exists("../../fotosiswa/$s[XFoto]")&&!$gbr==''){ ?>
                                                <img src="../../fotosiswa/<?php echo $s['XFoto']; ?>" width="400px">
                                                <?php 
												} else {
												echo "<img src=../../fotosiswa/nouser.png>";
												}
												?>
                                       

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal --> 
                                           
<script>    
$(document).ready(function(){
$("#simpan<?php echo $s['Urutan']; ?>").click(function(){
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
     data: "aksi=simpan&txt_ujian=" + txt_ujian + "&txt_jawab=" + txt_jawab + "&txt_acak=" + txt_acak + "&txt_telat=" + txt_telat + "&txt_durasi=" + txt_durasi + "&txt_soal=" + txt_soal + "&txt_level=" + txt_level + "&txt_mapel=" + txt_mapel + "&txt_nama=" + txt_nama,
	 success: function(data){
		if( $("#simpan<?php echo $s['Urutan']; ?>").hasClass( "btn-success" ) )
		{
		 $("#simpan<?php echo $s['Urutan']; ?>").removeClass("btn-success").addClass("btn-default");
		 $("#simpan<?php echo $s['Urutan']; ?>").val("Aktifkan");
		} else {	 	
	 	 $("#simpan<?php echo $s['Urutan']; ?>").removeClass("btn-info").addClass("btn-success");
		 $("#simpan<?php echo $s['Urutan']; ?>").val("Matikan");		 
		}
		loading.fadeOut();
		tampilkan.html(data);
		tampilkan.fadeIn(100);
	 tampildata();
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
 var txt_soal = $("#txt_soal").val();  
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
    confirmDialog("Apakah yakin akan menghapus Bank Soal ini? ", function(){
        //My code to delete
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
                              <?php } ?>
                                   
                                </tbody>
                            </table>
                            
<!-- /.panel-heading -->
                                                   
                            <!-- /.table-responsive -->
                            <div class="well">
							<h4><span style="color: #1B06CF;"><?php echo $skull; ?>-CBT</span></h4>
                            <p><b>Fitur Jadwal Ujian Meliputi:</b> 
								<br>Menghentikan Jadwal Ujian (klik tombol Status Tes), Reset Peserta (tombol Token), Tampilkan/sembunyikan semua Hasil Tes tombol atas), Tampilkan/sembunyikan semua Token Ujian (tombol atas)
								<br><b>NB:</b> Tombol Status Tes NON AKTIF jika masih ada siswa yang berstatus online, reset menjadi selesai guna hentikan ujian/tes</br>
							</p>
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
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Buat Bank Soal Baru</h4>
      </div>
      <div class="modal-body">
        <?php include "buat_banksoalbaru.php";?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>

</body>

</html>
