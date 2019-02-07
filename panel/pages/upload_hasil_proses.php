<?php

include "../../config/server.php";
$token=$_REQUEST['token'];
$sql4 = mysqli_query($sqlconn,"SELECT * from cbt_ujian WHERE XTokenUjian='$token'");
while($nil= mysqli_fetch_array($sql4)){ 
	
	$kodesoal = $nil['XKodeSoal']; 
	$uji = $nil['XStatusUjian'];
	if ($uji=="9") {$e="";}else{$e="disabled";}	

if(isset($_REQUEST['upl'])){ 
	$sqlnilai = mysqli_query($sqlconn,"select * from cbt_nilai where XTokenUjian = '$_REQUEST[token]' AND XStatus='0' or XStatus='1'");
	
	while($nilai=mysqli_fetch_array($sqlnilai)){
		include "../../config/server_pusat.php";
		$cek = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_nilai where  XTokenUjian = '$_REQUEST[token]' and XNomerUjian='$nilai[XNomerUjian]'"));
		if($cek==0){
		$sql = mysqli_query($sqlconn,"insert into cbt_nilai (XNomerUjian,XNIK,XKodeUjian,XTokenUjian,XTgl,XJumSoal,XBenar,XSalah,XNilai,XPersenPil,XPersenEsai,
					XEsai,XTotalNilai,XKodeMapel,XKodeKelas,XKodeSoal,XSetId,XSemester,XPilGanda) values 			
					('$nilai[XNomerUjian]','$nilai[XNIK]','$nilai[XKodeUjian]','$nilai[XTokenUjian]','$nilai[XTgl]','$nilai[XJumSoal]','$nilai[XBenar]',
					'$nilai[XSalah]','$nilai[XNilai]','$nilai[XPersenPil]','$nilai[XPersenEsai]','$nilai[XEsai]','$nilai[XTotalNilai]','$nilai[XKodeMapel]',
					'$nilai[XKodeKelas]','$nilai[XKodeSoal]','$nilai[XSetId]','$nilai[XSemester]','$nilai[XPilGanda]')");
	include "../../config/server.php";
	$sqljawab = mysqli_query($sqlconn,"update cbt_nilai SET XStatus='9' where XNomerUjian = '$nilai[XNomerUjian]' and  XTokenUjian = '$_REQUEST[token]'");
	flush(); }else{echo"DATA SUDAH ADA di SERVER PUSAT"; }}
		
		
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

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Upload Hasil Ujian</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
<a href="?modul=upload_hasil"><button type="button" class="btn btn-info btn-small"><i class="fa fa-backward"></i> Kembali</button></a>
<?php echo "<a href='?modul=upl_hasil&upl&token=$token' id='custId' data-toggle='modal' data-id=''>"; ?>
<button type="button" class="btn btn-info btn-small" <?php echo " ".$e;?>><i class="fa fa-cloud-upload"></i> 
Upload</button> <?php echo "<a href='?modul=upl_hasil&token=$token' id='custId' data-toggle='modal'>"; ?>
<button type="button" class="btn btn-success"><i class='fa fa-refresh fa-fw'></i></button></a>
</a>                        
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr style="color:#FFFFFF; font-style:normal; font-weight:normal; text-align:center" height="40px" bgcolor="#000">
									<th style="color:#FFFFFF; font-style:normal; font-weight:normal; text-align:center">&nbsp;No.</th>
                                    <th style="color:#FFFFFF; font-style:normal; font-weight:normal; text-align:center">Nomer Peserta</th>
                                    <th style="color:#FFFFFF; font-style:normal; font-weight:normal; text-align:center">Token</th>
                                    <th style="color:#FFFFFF; font-style:normal; font-weight:normal; text-align:center">Kelas</th>
                                    <th style="color:#FFFFFF; font-style:normal; font-weight:normal; text-align:center">Jenis Ujian</th>
                                    <th style="color:#FFFFFF; font-style:normal; font-weight:normal; text-align:center">NIS</th>
                                    <th style="color:#FFFFFF; font-style:normal; font-weight:normal; text-align:center">Status Upload</th>
									</tr>
                                </thead>
                                <tbody>
                                <?php   
								include "../../config/server.php";
								$sql5 = mysqli_query($sqlconn,"SELECT * from cbt_nilai
								WHERE XTokenUjian='$token'");
								
								$nom = 1;	
								
								while($nil= mysqli_fetch_array($sql5)){ 
								$nouji = $nil['XNomerUjian']; 
								$XStat = $nil['XStatus'];
								if($XStat =='0'){$statujian = "Belum";}
									elseif($XStat =='1'){$statujian = "<font color='#629ad8'> Belum </font>";}
									elseif($XStat =='9'){$statujian = "<font color='#be425f'> Terupload</font>";}	
								?>
                                
                                    <tr class="odd gradeX">
                                        <td width="5%">&nbsp;<?php echo $nom ; $nom++;?></td>
										<td width="10%"><?php echo $nouji; ?></td>
										<td width="30%"><?php echo $nil['XTokenUjian']; ?></td>
										<td width="10%"><?php echo $nil['XNamaKelas']; ?></td>
										<td width="20%"><?php echo $nil['XKodeUjian']; ?></td>
										<td width="5%"><?php echo $nil['XNIK']; ?></td>
										<td width="10%"><?php echo "$statujian"; ?></td>
                                    </tr>
 
 <script>
function myFunction<?php echo $s['Urut']; ?>() {
	alert(<?php echo $s['Urut']; ?>);
    document.getElementById("demo").innerHTML = "Hello World";
}
</script>
<script>
function toggle(pilih) {
  checkboxes = document.getElementsByName('upl');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = pilih.checked;
  }
}
</script>

                                                      
                                        
                                <?php  }}?>
                                   
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            <div class="well">
                                <h4><span style="color: #1B06CF;"><?php echo $skull; ?>-CBT</span></h4>
                                <p>Untuk keterangan lebih lanjut Hubungi : <?php echo $skull; ?> </p><p>
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

 