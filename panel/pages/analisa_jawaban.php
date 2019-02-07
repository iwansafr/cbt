<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
	include "../../config/server.php";
	$xadm = mysqli_fetch_array(mysqli_query($sqlconn,"select * from cbt_admin"));
	$skul_tkt= $xadm['XTingkat']; 
	if ($skul_tkt=="SMA" || $skul_tkt=="MA"||$skul_tkt=="STM"){$rombel="Jurusan";}else{$rombel="Rombel";}	

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

    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
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
<body>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"> Analisa Soal <?php echo $_REQUEST['soal']; ?> dan Hasil Jawaban</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <table width="100%"><tr><td><a href="?modul=analisasoal"><button class="btn btn-default">
                           <i class="fa fa-arrow-circle-left"></i> Kembali ke Daftar</button></a> &nbsp;&nbsp;&nbsp;Daftar Peserta Ujian</td><td align="right">
                          
                           <a href=?modul=analisabutir&soal=<?php echo $_REQUEST['soal']; ?>><button type="button" class="btn btn-success  btn-small">
                           <i class="fa fa-file-text"></i> Analisa Butir Soal </button></a>
                           
                          
                         
						    <!--
						   <a href=?modul=rekapesai&soal=<?php echo $_REQUEST['soal']; ?>><button type="button" class="btn btn-primary btn-small">
                           <i class="fa fa-file-text"></i> Rekap Jawaban Esai </button></a>
						   
                            <a href="?modul=sebaran_nilai&soal=<?php echo $_REQUEST['soal']; ?>"><button class="btn btn-info">
                            <i class="fa fa-bar-chart-o  "></i> Sebaran Nilai</button></a>
							-->

                           </td></tr>
							</table>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example"  >
                                <thead>
                                    <tr>
	                                    <th width="7%">No.</th>
                                        <th width="10%">No.Ujian</th>
                                        <th width="7%">Ujian</th>
                                        <th width="25%">Nama</th>
                                        <th width="8%">Kelas</th>
                                        <th width="8%"><?php echo $rombel ;?></th>
                                        <th width="8%">Token</th>                                           
                                        <th width="8%">Nilai Esai</th>
                                        <th width="8%">Skoring Esai</th>                                        
                                        <th width="18%">Hasil PG|Esai</th>                                          
                                                                                                                          
                                 </tr>
                                </thead>
                                <tbody>
                                <?php 
								$sql = mysqli_query($sqlconn,"select * from cbt_siswa_ujian c left join cbt_siswa s on s.XNomerUjian = c.XNomerUjian  
									left join cbt_ujian u on u.XTokenUjian = c.XTokenUjian  where c.XKodeSoal = '$_REQUEST[soal]'");
									
								$so = 1;
								while($s = mysqli_fetch_array($sql)){ 
					$sqlsoal = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_soal where XKodeSoal = '$s[XKodeSoal]'"));
					$sqlpakai = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_nilai where XKodeSoal = '$s[XKodeSoal]'"));
					
					
						$sqljumlahx = mysqli_query($sqlconn,"select sum(XNilaiEsai) as hasil from cbt_jawaban where XKodeSoal = '$s[XKodeSoal]' and XUserJawab = 
						'$s[XNomerUjian]' and XTokenUjian = '$s[XTokenUjian]'");
						$o = mysqli_fetch_array($sqljumlahx);
						$cekjum = mysqli_num_rows($sqljumlahx);
						$nilaiawal = round($o['hasil'],2);
						$sqljur = mysqli_query($sqlconn,"SELECT * FROM `cbt_siswa` WHERE XNamaSiswa= '$s[XNamaSiswa]' ");
						$sjur = mysqli_fetch_array($sqljur);
						$kojur = $sjur['XKodeJurusan'];

								?>
                                
                                    <tr class="odd gradeX">
                                        <td><input type="hidden" value="<?php echo $s['Urutan']; ?>" id="txt_mapel<?php echo $s['Urut']; ?>">
                                        <?php echo $so; ?></td>
                                        <td><?php echo $s['XNomerUjian']; ?></td>
                                        <td align="center"><?php echo $s['XKodeUjian']; ?></td>
                                        <td><?php echo $s['XNamaSiswa']; ?></td>                                      
                                        <td align="center"><?php echo $s['XKodeKelas']; ?></td>                                         
                                        <td align="center"><?php echo $kojur; ?></td>
                                        <td align="center"><?php echo $s['XTokenUjian']; ?></td>
                                        <td align="center"><?php echo $nilaiawal; ?></td>                                        
                                        <td align="center"><a href=?modul=lks&soal=<?php echo $s['XKodeSoal']; ?>&siswa=<?php echo $s['XNomerUjian']; ?>&token=<?php echo $s['XTokenUjian']; ?>>
										<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-file-text-o"></i></button></a></td>											
										<td align="center">
										<a href=?modul=jawabansiswa&soal=<?php echo $s['XKodeSoal']; ?>&siswa=<?php echo $s['XNomerUjian']; ?>&token=<?php echo $s['XTokenUjian']; ?>>
											<button type="button" class="btn btn-success btn-sm"><i class="fa fa-file-text-o"></i></button>
										</a>
										<a href=?modul=jawabanesai_siswa&soal=<?php echo $s['XKodeSoal']; ?>&siswa=<?php echo $s['XNomerUjian']; ?>&token=<?php echo $s['XTokenUjian']; ?>>
											<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-file-text-o"></i></button>
										</a>									
										</td>                                        
                                    </tr>
  <!-- Button trigger modal -->
  <!-- Modal -->
                          
                            
 
                              <?php 
							  $so++;
							  } ?>
                                   
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            <div class="well">
                            <p></p>
                                <h4>Keterangan</h4>
                                <ul><li>Analisa Butir soal bisa didownload dengan format excel.
                                <li>Hasil Esai adalah data hasil ujian siswa yang berupa lembar Soal dan Jawaban Siswa untuk validasi kerja siswa
								<li>Nilai PG adalah Hasil nilai Ujian Siswa Pilihan Ganda dan Esai                                    
                                </ul></li>
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
    
</body>

</html>
