<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
include "../../config/server.php";
if(isset($_REQUEST['aksi'])){
//echo "delete from cbt_kelas where Urut = '$_REQUEST[urut]'";
$sql = mysqli_query($sqlconn,"delete from cbt_kelas where Urut = '$_REQUEST[urut]'");
}


if(isset($_REQUEST['simpan'])){
	$sql = mysqli_query($sqlconn,"update cbt_kelas set XKodeLevel = '$_REQUEST[txt_kodlev]', XNamaKelas = '$_REQUEST[txt_namkel]', XKodeJurusan = '$_REQUEST[txt_jur]',
	XKodeKelas = '$_REQUEST[txt_kodkel]', XKodeSekolah = '$_REQUEST[txt_kodesek]'  where Urut = '$_REQUEST[id]'");
}

if(isset($_REQUEST['tambah'])){
$kelas=$_REQUEST['txt_kodkel'];
$jurusan=$_REQUEST['txt_jur'];
$namakelas=$_REQUEST['txt_namkel'];
$level=$_REQUEST['txt_kodlev'];
$sqlcek1 = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_kelas where XNamaKelas='$namakelas'"));
$sqlcek2 = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_kelas where XKodeLevel = '$level' and XKodeKelas = '$kelas' and XKodeJurusan = '$jurusan' "));
	if($sqlcek1>0){
		$message1 = "Nama Kelas SUDAH ADA";
		echo "<script type='text/javascript'>alert('$message1');</script>";
	} else {
		if($sqlcek2>0){
			$message2 = "Data Kelas SUDAH ADA";
			echo "<script type='text/javascript'>alert('$message2');</script>";
		} else {
			if($_REQUEST['txt_kodkel']==""||$_REQUEST['txt_jur']==""||$_REQUEST['txt_kodlev']==""||$_REQUEST['txt_namkel']==""){$message = "Kode, Nama & Level Kelas serta Jurusan tidak boleh Kosong";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}else{
				$sql = mysqli_query($sqlconn,"insert into cbt_kelas (XKodeLevel, XNamaKelas, XKodeJurusan,XKodeKelas, XKodeSekolah) values  
				('$_REQUEST[txt_kodlev]','$_REQUEST[txt_namkel]','$_REQUEST[txt_jur]','$_REQUEST[txt_kodkel]','$_REQUEST[txt_kodesek]')");
			}
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
                    <h1 class="page-header">Daftar Kelas</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           oO <b>Data Kelas</b> Oo  &nbsp;&nbsp;&nbsp;
					
				<a href="?modul=upl_kelas">
					<button type="button" class="btn btn-info btn-small" style="margin-top:5px; margin-bottom:5px">
						<i class="fa fa-cloud-upload"></i>&nbsp; Upload Data Kelas</i>
					</button>
				</a>	
		
				<a href="down_excel_kelas.php" target="_blank">
					<button type="button" class="btn btn-success" id="download"> <i class='fa fa-cloud-download  '></i>&nbsp; Download Data</button>
				</a>
				 
				<?php echo "<a href='#myTam' id='custId' data-toggle='modal' data-id=''>"; ?>
					<button type="button" class="btn btn-primary btn-small" ><i class="fa fa-plus-circle"></i>&nbsp; Tambah Kelas & <?php echo $rombel;?></button>	
				<?php echo "</a>";?>                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
	                                    <th width="5%">Nomor</th>
										<th width="15%">Kode Sekolah</th>
                                        <th width="10%">Kode Level</th>
                                        <th width="10%">Kode Kelas</th>
										<th width="30%"><?php echo $rombel;?></th> 
										<th width="20%">Nama Kelas</th>										
                                                                               
                                        <th width="20%">Edit - Hapus</th>                                                                                                                      
                                 </tr>
                                </thead>
                                <tbody>
                                <?php 
								$no=0;
								$sql = mysqli_query($sqlconn,"select * from cbt_kelas order by Urut");
								while($s = mysqli_fetch_array($sql)){ 
								$no++
								?>
                                
                                    <tr class="odd gradeX">
                                        <td align="center"><?php echo $no; ?></td>
										<td align="center"><?php echo $s['XKodeSekolah']; ?></td>
                                        <td align="center"><?php echo $s['XKodeLevel']; ?></td>
                                        <td align="center"><?php echo $s['XKodeKelas']; ?></td>
										<td align="center"><?php echo $s['XKodeJurusan']; ?></td>
                                        <td align="center"><?php echo $s['XNamaKelas']; ?></td>  
										<td align="center"><?php echo "
											<a href='#myModal' id='custId' data-toggle='modal' data-id=".$s['Urut'].">"; ?>
                                            <button type="button" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                                            <a href="?modul=daftar_kelas&aksi=hapus&urut=<?php echo $s['Urut']; ?>"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o "></i></button></a></td>                                                                               
                                    </tr>
 
 <script>
function myFunction<?php echo $s['Urut']; ?>() {
	alert(<?php echo $s['Urut']; ?>);
    document.getElementById("demo").innerHTML = "Hello World";
}
</script>
  <!-- Button trigger modal -->
                                    
                                        
                                <?php } ?>
                                   
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            <div class="well">
                                <h4><span style="color: #1B06CF;"><?php echo $skull; ?>-CBT</span></h4>
                                <p>Untuk keterangan lebih lanjut Hubungi :  <?php echo $skull; ?>-CBT </p><p>
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
                    <h4 class="modal-title">Tambah Data Kelas & <?php echo $rombel;?></h4>
                </div>
                <div class="modal-body">
        <!-- MEMBUAT FORM -->
        <form action="?modul=daftar_kelas&tambah=yes" method="post">
			<div class="form-group">
                <label>Kode Sekolah</label><br>
                <select class="form-control" name="txt_kodesek" id="txt_kodesek">
					<option value='ALL'>SEMUA (ALL)</option>
					<?php 
						$sqlsek = mysqli_query($sqlconn,"select * from server_sekolah order by XServerId");
						while($sek = mysqli_fetch_array($sqlsek)){echo "<option value='$sek[XServerId]'>$sek[XServerId] $sek[XSekolah]</option>";}
					?>
				</select>
            </div><p>
             <div class="form-group">
                <label>Kode Kelas</label>
                <input type="text" class="form-control" name="txt_kodkel">
            </div>

            <div class="form-group">
                <label>Nama Kelas</label>
                <input type="text" class="form-control" name="txt_namkel">
            </div>
            <div class="form-group">
                <label>Kode Level</label>
                <input type="text" class="form-control" name="txt_kodlev">
            </div>
            <div class="form-group">
                <label><?php echo $rombel;?></label>
				<input type="text" class="form-control" name="txt_jur" >
				<!--<select class="form-control" name="txt_jur" id="txt_jur">
				<?php 
                                $sqlsek = mysqli_query($sqlconn,"select * from cbt_kelas order by Urut");
                                while($sek = mysqli_fetch_array($sqlsek)){
                                echo "<option value='$sek[XKodeJurusan]'>$sek[XKodeJurusan]</option>";
                                }
                                ?>
								</select>-->
								
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
                    <h4 class="modal-title">Edit Data Kelas</h4>
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
                url : 'edit_kelas.php',
                data :  'urut='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
		  /*
		  $('#myTam').on('show.bs.modal', function (e) {
           var rowid = $(e.relatedTarget).data('id');
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
		 */
    });
  </script>
 
</body>

</html>

 