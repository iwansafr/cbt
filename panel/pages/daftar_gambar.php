<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}

	//cek apakah tombol delete diklik
if(isset($_REQUEST['gambar'])){
	$gambar=$_REQUEST['file'];
	$folder="../../pictures/$gambar";
	unlink($folder);
	}
if(isset($_REQUEST['del'])){
	$gam=$_REQUEST['checkbox'];
	$jum_pil = count($gam);
	$folder="../../pictures/$gam";
	for($x=0;$x<$jum_pil;$x++){
	unlink($folder);
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
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
	<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="./js/jquery-1.4.js"></script>
<script>
function toggle(pilih) {
  checkboxes = document.getElementsByName('checkbox[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = pilih.checked;
  }
}	
</script>
</head>

<body>
<?php
	$folder = "../../pictures"; //folder tempat gambar disimpan 
	$handle = opendir($folder);
	$i=1;
?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">

<form>						
<table width="100%"><tr><td>
<?php echo "<a href='?modul=upl_filesoal' id='custId' data-toggle='modal' data-id=''>"; ?>
<button type="button" class="btn btn-info btn-small" ><i class="fa fa-plus-circle"></i> Tambah Gambar</button><?php echo "</a>";?>
<br/></td></tr></table>
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    
                                </thead>
                                <tbody>
                                <?php 
    while(false !== ($file = readdir($handle))){  
        if($file != '.' && $file != '..'){ ?> 
				<td style="border:1px solid #000000;">
				<a href="?modul=file_pendukung&gambar=hapus&file=<?php echo $file; ?>">
				<i class="fa fa-times "></i></a> <table width="100%"><tr><td align="center">
				<a class="fancybox" href="../../pictures/<?php echo $file; ?>" data-fancybox-group="gallery" 
				target="popup" onclick="window.open('../../pictures/<?php echo $file; ?>','popup','width=600,height=600'); return false;"
				Open Link in Popup title="<?php echo $file; ?>"><img class="img-polaroid" src="../../pictures/<?php echo $file; ?>" 
				alt="" width="50px"/></a><br/></td></tr></table></td>
				<?php
                 
            if(($i % 10) == 0){  
                echo '</tr><tr>';  
            }  
            $i++;  
        }  
    }   
    ?> </td></tr>
 
                                </tbody>
                            </table></form>
                            <!-- /.table-responsive -->
                            <div class="well">
                                <h4><span style="color: #1B06CF;"><?php echo $skull; ?>-CBT</span></h4>
                                <p>Daftar File Media Gambar Pendukung Soal</p><p>
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
} );

</script>
</body>

</html>
