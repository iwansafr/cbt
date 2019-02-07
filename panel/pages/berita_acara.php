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
<body>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Cetak Berita Acara</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <table width="100%"><tr><td>Daftar Pelaksanaan Test</td><td align="right">
                                        
                                        </td></tr>
							</table>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        		<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
	                                    <th width="2%">No</th>
										<th width="5%">Ujian</th>                                        
                                        <th width="8%">Kode Soal</th>
                                        <th width="12%">Mata Pelajaran</th>
                                        <th width="4%">Kelas</th>	
                                        <th width="4%">Token</th>	
                                        <th width="5%">Waktu</th>
                                        <th width="3%">Durasi</th>  
                                        <th width="5%">Proktor - Pengawas</th>
                                        <th width="10%">Catatan</th>
                                        <th width="5%">Edit Pengawas | Print</th>                                        
                                 </tr>
                                </thead>
                                <tbody>
<?php 
$sql = mysqli_query($sqlconn,"select u.*,m.*,u.Urut as Urutan,u.XKodeKelas as kokel from cbt_ujian u left join cbt_mapel m on m.XKodeMapel = u.XKodeMapel 
left join cbt_paketsoal p on p.XKodeSoal = u.XKodeSoal where u.XStatusUjian='9'");
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
		
								?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="./js/jquery-1.4.js"></script>
                                
<script>    
$(document).ready(function(){
	$("#awas<?php echo $s['XTokenUjian']; ?>").click(function(){
	alert();
	//alert("<?php echo $s['Urutan']; ?>");
	 var txt_tokenx = $("#txt_tokenx<?php echo "$s[XTokenUjian]"; ?>").val();
	 var txt_proktorx = $("#txt_proktorx<?php echo "$s[XTokenUjian]"; ?>").val();
	 var txt_nipproktorx = $("#txt_nipproktorx<?php echo "$s[XTokenUjian]"; ?>").val();
	 var txt_pengawasx = $("#txt_pengawasx<?php echo "$s[XTokenUjian]"; ?>").val();
	 var txt_nip_pengawasx = $("#txt_nip_pengawasx<?php echo "$s[XTokenUjian]"; ?>").val();
	 var txt_catatanx = $("#txt_catatanx<?php echo "$s[XTokenUjian]"; ?>").val();
	
	  
	//alert(txt_ujianx);  
	  
	 $.ajax({
		 type:"POST",
		 url:"ubahpengawas.php",    
		 data: "aksi=simpan&txt_tokenx=" + txt_tokenx + "&txt_proktor=" + txt_proktorx + "&txt_nipproktor=" + txt_nipproktorx + "&txt_pengawas=" + txt_pengawasx + "&txt_nippengawas=" + txt_nip_pengawasx + "&txt_catatan=" + txt_catatanx,
		 success: function(data){
			  document.location.reload();
			  loading.fadeOut();
			  tampilkan.html(data);
			  tampilkan.fadeIn(100);
			  tampildata();
			}
		 });
	});
}
);
</script>                               
<tr class="odd gradeX">
	<td align="center">	<input type="hidden" value="<?php echo $s['Urutan']; ?>" id="txt_mapel<?php echo $s['Urutan']; ?>"><?php echo $s['Urutan']; ?>
		<input type="hidden" value="<?php echo $s['Urutan']; ?>" id="txt_ujian<?php echo $s['Urutan']; ?>">
    </td>
    <td align="center"><?php echo $s['XKodeUjian']; ?></td>
    <td align="center"><?php echo $s['XKodeSoal']; ?></td>
    <td align="center"><?php echo $s['XNamaMapel']; ?></td>
    <td align="center"><?php echo $s['kokel']." - ".$s['XKodeJurusan']."."; ?></td> 
    <td align="center"><?php echo $s['XTokenUjian']; ?></td>
    <td align="center"><?php echo $s['XTglUjian']." ".$s['XJamUjian'] ; ?></td>                                        
	<td align="center"><?php echo $s['XLamaUjian']; ?></td>
	<td align="center"><?php echo $s['XProktor']." - ".$s['XPengawas']; ?></td>
	<td align="center"><?php echo $s['XCatatan']; ?></td>
	<td align="center">
		<button type="button" class="btn btn-warning btn-sm"  
				data-toggle="modal" data-target="#myPengawas<?php echo $s['XTokenUjian']; ?>"><i class="fa fa-edit"></i>
		</button>
		<a href="?modul=cetak_berita&token=<?php echo $s['XTokenUjian']; ?>"><button type="button" class="btn btn-info btn-sm"><i class="fa fa-print"></i></button></a>
	</td>     
</tr>
  <!-- Button trigger modal -->
  <!-- Modal -->
    <div class="modal fade" id="myPengawas<?php echo $s['XTokenUjian']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					
                        <h4 class="modal-title" id="myModalLabel"><?php echo "Pengawas Ujian Mapel : $s[XNamaMapel]"; ?></h4>
                </div>
                <div class="modal-body" >
					<input type="hidden" value="<?php echo $s['XTokenUjian']; ?>" id="txt_tokenx<?php echo $s['XTokenUjian']; ?>">
						<br><span>Nama Proktor &nbsp&nbsp&nbsp&nbsp&nbsp: </span><span><label><input type="text" id="txt_proktorx<?php echo $s['XTokenUjian']; ?>" width="90%"></label></span>
						<br><span>NIP  Proktor &nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp: </span><span><label><input type="text" id="txt_nipproktorx<?php echo $s['XTokenUjian']; ?>" width="90%"></label></span>
						<br><span>Nama Pengawas : </span><span><label><input type="text" id="txt_pengawasx<?php echo $s['XTokenUjian']; ?>" width="90%"></label></span>
						<br><span>NIP  Pengawas &nbsp&nbsp&nbsp&nbsp: </span><span><label><input type="text" id="txt_nip_pengawasx<?php echo $s['XTokenUjian']; ?>" width="90%"></label></span>
						<br><span>Catatan : </span><span><br><label><textarea id="txt_catatanx<?php echo $s['XTokenUjian']; ?>" cols="45" rows="5"></textarea></label></span>
						<br>
				</div>
                <div class="modal-footer">
					
                    <input type="submit"  class="btn btn-info btn-sm" id="awas<?php echo $s['XTokenUjian']; ?>" value="Simpan">
					<button type="submit" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-minus-sign"></i> Tutup</button>
				</div>                                        
			</div>
                <!-- /.modal-content -->
		</div>
				<!-- /.modal-dialog -->
	</div>
				<!-- /.modal --> 
<?php } ?>
                                   
                                </tbody>
                            </table>
                            
<!-- /.panel-heading -->
                                                   
                            <!-- /.table-responsive -->
                            <div class="well" style=" text-align: center;">
                            <p>Form Berita Acara <?php include "../../config/server.php"; echo "$skull";?>-CBT </p>
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
</div>
</div>
</body>
</html>
