<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}

	//cek apakah tombol delete diklik
if(isset($_REQUEST['audio'])){
	$gambar=$_REQUEST['file'];
	$folder="../../audio/$gambar";
	unlink($folder);
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
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
</head>

<body>
<?php
	$folder = "../../audio"; //folder tempat gambar disimpan 
	$handle = opendir($folder);
	$i=1;
?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
<?php echo "<a href='?modul=upl_filesoal' id='custId' data-toggle='modal' data-id=''>"; ?>
<button type="button" class="btn btn-info btn-small" ><i class="fa fa-plus-circle"></i> 
Tambah Audio</button>
<?php echo "</a>";?>                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%">
                                <thead>
                                    
                                </thead>
                                <tbody>
                                <?php 
    while(false !== ($file = readdir($handle))){  
        if($file != '.' && $file != '..'){ ?> 
				<td width="5%">
				<a href="?modul=file_pendukung&audio=hapus&file=<?php echo $file; ?>">
				<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o "></i></button></a></td>
				<td width="5%"> <?php echo $i; ?></td>
				<td><?php echo $file; ?></td>
                <td><section><audio controls>
				<source src="../../audio/<?php echo $file; ?>" type="audio/mpeg">
				</audio></section>
				</td></tr>
				<?php
                
            $i++;  
        }  
    }   
    ?> </td></tr>
 
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            <div class="well">
                                <h4><span style="color: #1B06CF;"><?php echo $skull; ?>-CBT</span></h4>
                                <p>Daftar File Media Audio Pendukung Soal</p><p>
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

</body>

</html>
