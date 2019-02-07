<?php
if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
include "../../config/server.php";
if(isset($_REQUEST['aksi'])){
//echo "delete from cbt_kelas where Urut = '$_REQUEST[urut]'";
$sql = mysqli_query($sqlconn,"delete from server_sekolah where Urut = '$_REQUEST[urut]'");
}
if(isset($_REQUEST['aksi1'])){ 
//echo "delete from cbt_kelas where Urut = '$_REQUEST[urut]'";
	$sqlcek = mysqli_query($sqlconn,"select * from server_sekolah where Urut = '$_REQUEST[urut]'");
	$sta = mysqli_fetch_array($sqlcek);
	$status= $sta['XStatus'];
	if($status=="1"){ $ubah = "0"; } 
	elseif($status=="0"){ $ubah = "1"; } 
	
$sqlpasaif = mysqli_query($sqlconn,"update server_sekolah set XStatus = '$ubah' where Urut = '$_REQUEST[urut]'");
}

if(isset($_REQUEST['reset'])){ 
//echo "delete from cbt_kelas where Urut = '$_REQUEST[urut]'";
	$sqlres = mysqli_query($sqlconn,"select * from server_sekolah where XServerId = '$_REQUEST[server]'");
	$stares = mysqli_fetch_array($sqlres);
	$stres= $stares['XStatus'];
	if($stres=="0"){ $res = "0"; } elseif($stres=="1"){ $res = "0"; } elseif ($stres=="2"){$res = "0";}
	$reset1 = mysqli_query($sqlconn,"update server_sekolah set XStatusSinc = '$res' where XServerId = '$_REQUEST[server]'");
	$reset10 = mysqli_query($sqlconn,"update cbt_sinc set XData1 = '0', XData2 = '0', XData3 = '0', XData4 = '0', XData5 = '0', XData6 = '0', XData7 = '0', 
	XData8 = '0', XData9 = '0', XData10 = '0', XData11 = '0', XData12 = '0' where XServerId = '$_REQUEST[server]'");
}

if(isset($_REQUEST['simpan'])){
	$sql = mysqli_query($sqlconn,"update server_sekolah set XServerId = '$_REQUEST[txt_kodsek]', XSekolah = '$_REQUEST[txt_namsek]', XAlamatSek = '$_REQUEST[txt_alsek]' where Urut = '$_REQUEST[urut]'");
}

if(isset($_REQUEST['tambah'])){
$sekolah=addslashes($_REQUEST['txt_namsek']);
$sqlcek = mysqli_num_rows(mysqli_query($sqlconn,"select * from server_sekolah where XServerId = '$_REQUEST[txt_kodsek]'"));
	if($sqlcek>0){
	$message = "Kode Sekolah SUDAH ADA";
	echo "<script type='text/javascript'>alert('$message');</script>";
	} else {
		if(!$_REQUEST['txt_kodsek']==""||!$_REQUEST['txt_jur']==""){
		$sql = mysqli_query($sqlconn,"insert into server_sekolah (XServerId, XSekolah, XAlamatSek, XStatus) values  
		('$_REQUEST[txt_kodsek]','$sekolah','$_REQUEST[txt_alsek]','1')");
		}
	}
}



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

<body>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Daftar Sekolah</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Sekolah 
<?php echo "<a href='#myTam' id='custId' data-toggle='modal' data-id=''>"; ?>
<button type="button" class="btn btn-info btn-small" ><i class="fa fa-plus-circle"></i> 
Tambah Sekolah</button>
<?php echo "</a>";?>                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
	                                    <th width="5%">No.</th>
                                        <th width="10%">Kode Sekolah</th>
                                        <th width="30%">Nama Sekolah</th>                                           
                                        <th width="40%">Alamat</th> 
										<th width="10%">Status<br>Sinkron</th>
										<th width="10%">Reset<br>Sinkron</th>
										<th width="10%">Status<br>Server</th>
                                        <th width="10%">Tindakan</th>                                                                                                                      
                                 </tr>
                                </thead>
                                <tbody>
                                <?php 
								
								$sql = mysqli_query($sqlconn,"select * from server_sekolah order by XServerId");
								$no=0;
								while($s = mysqli_fetch_array($sql)){ 
								$stts = $s['XStatus'];
								if (mysqli_query($sqlconn,"select * from cbt_sinc limit 1")==TRUE){
								$ssync=$s['XStatusSinc'];
								}else{
								$ssync=3;}
								$no++
								?>
                                
                                    <tr class="odd gradeX">
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $s['XServerId']; ?></td>
                                        <td><?php echo $s['XSekolah']; ?></td>
                                        <td><?php echo $s['XAlamatSek']; ?></td>  
										<td><?php 
										if ($ssync==0){
												echo "<b>Belum";
											}elseif($ssync==2){
												echo "Sukses";
											}elseif($ssync==1) {
												echo "Sedang Proses";
											}elseif($ssync==3) {
												echo "Tanpa Batas";
											}
										?>
										<td align="center">
										<?php if($ssync=="3"){ 
											echo "Tanpa Reset";
											} else { ?>
												<a href="?modul=data_skul&reset&server=<?php echo $s['XServerId']; ?>">
												<button class="btn btn-default" ><?php echo "<i class='fa fa-refresh fa-fw'></i>";?></button></a>
										<?php } ?>
										</td>
                                        <td><a href="?modul=data_skul&aksi1=status&urut=<?php echo $s['Urut']; ?>">													
                                        <?php if($stts=="1"){ ?>
										<button type="button" class="btn btn-success">Aktif</button></a>
										
                                        <?php } else { ?>
                                        <button type="button" class="btn btn-default">Non Aktif</button></a>
										<?php } ?>
                                        </td>						
                                        <?php echo "<td><a href='#myModal' id='custId' data-toggle='modal' data-id=".$s['Urut'].">"; ?>
										<button type="button" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                                        <a href="?modul=data_skul&aksi=hapus&urut=<?php echo $s['Urut']; ?>"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o "></i></button></a></td>                                                                               
                                    </td></tr>
 
 <script>
function myFunction<?php echo $s['Urut']; ?>() {
	alert(<?php echo $s['Urut']; ?>);
    document.getElementById("demo").innerHTML = "Hello World";
}
</script>
  <!-- Button trigger modal -->
<script>    
$(document).ready(function(){
	$("#simpan1<?php echo $s['Urut']; ?>").click(function(){
		$.ajax({
			type:"POST",
			url:"simpan_sekolah.php",
			data :  'urut='+ rowid,
			success: function(data){
			document.location.reload();
			loading.fadeOut();
			tampilkan.html(data);
			tampilkan.fadeIn(100);
			tampildata();
			window.location.reload();
			}
		});
	});
});
</script> 
                                                      
                                        
                                <?php } ?>
                                   
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            <div class="well">
                                <h4>CBT BEESMART</h4>
                                <p>Untuk keterangan lebih lanjut Hubungi : TUWAGAPAT STUDIO - CBT BeeSMART  087859216448</p><p>
                                </p>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
       
       
       
       
       <div class="modal fade" id="myTam" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Data Sekolah</h4>
                </div>
                <div class="modal-body">
        <!-- MEMBUAT FORM -->
        <form action="?modul=data_skul&tambah=yes" method="post">

             <div class="form-group">
                <label>Kode Sekolah</label>
                <input type="text" class="form-control" name="txt_kodsek">
            </div>

            <div class="form-group">
                <label>Nama Sekolah</label>
                <input type="text" class="form-control" name="txt_namsek">
            </div>
            <div class="form-group">
                <label>Alamat Sekolah</label>
                <input type="text" class="form-control" name="txt_alsek">
            </div>
            <button class="btn btn-primary" type="submit">Tambah</button>
        </form>
                
                    <div class="fetched-data2"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>    
           
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
    
<div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Data Sekolah</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>
 
  <script src="js/jquery-3.1.1.min.js"></script>
  
  <script type="text/javascript">
    $(document).ready(function(){
        $('#myModal').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'edit_sekolah.php',
                data :  'urut='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
		 
		  $('#myTam').on('show.bs.modal', function (e) {
           // var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'tambah_kelas.php',
                data :  'urut='+ rowid,
                success : function(data){
                $('.fetched-data2').html(data);//menampilkan data ke dalam modal
                }
            });
         });
		 
    });
  </script>
 
</body>

</html>

 