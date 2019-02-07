<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
	include "../../config/server.php"; 
								
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
                    <h3 class="page-header">Daftar Hasil Ujian/Tes</h3>
					<?php $esai = mysqli_num_rows(mysqli_query($sqlconn,"SELECT * FROM cbt_jawaban where XJenisSoal='2'"));
if ($esai>0){$herf="down_excel_esai.php"; $kata="";}else{$herf=""; $kata="disabled";}?>
					<p><a href="<?php echo $herf; ?>" target="_blank">
					<button type="button" class="btn btn-success" id="download" <?php echo $kata; ?>> <i class='fa fa-cloud-download  '></i> Jawaban ESAI Excel </button>
				 </a></P>
					
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <table width="100%"><tr><td>Daftar soal </td><td align="right"></td></tr>
							</table>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        		
                        
                        
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" >
                                <thead>
                                    <tr >
	                                    <th width="7%">No.</th>
                                        <th width="20%">Kode</th>
                                        <th width="20%">Mata Pelajaran</th>
                                        <th width="8%">Soal</th>	
                                        <th width="5%">Kelas</th>
                                        <th width="20%" >Pembuat Soal</th>                                           
                                                                                  
                                        <th width="8%">Rekap Nilai</th>    
                                        <th width="8%">Analisa Hasil</th>                                                                              
                                        <th width="8%">Status</th>                                        
                                                                                                                          
                                 </tr>
                                </thead>
                                <tbody>
								<?php
                                $no=0;
								if($_COOKIE['beelogin']=='admin'){
								$sql = mysqli_query($sqlconn,"select p.*,m.*,p.Urut as Urutan,p.XKodeKelas  as kokel from cbt_paketsoal p left join cbt_mapel m on m.XKodeMapel = 
								p.XKodeMapel order by p.Urut desc");
								} else {
								$sql = mysqli_query($sqlconn,"select p.*,m.*,p.Urut as Urutan,p.XKodeKelas  as kokel from cbt_paketsoal p left join cbt_mapel m on m.XKodeMapel = 
								p.XKodeMapel where p.XGuru='$_COOKIE[beeuser]' order by p.Urut desc");								
								}
								while($s = mysqli_fetch_array($sql)){ 
					$sqlsoal = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_soal where XKodeSoal = '$s[XKodeSoal]'"));
					$sqljawab = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_jawaban where XKodeSoal = '$s[XKodeSoal]'"));
										
					$sqlpakai = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_nilai where XKodeSoal = '$s[XKodeSoal]'"));
					$sqlpakai2 = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_siswa_ujian where XKodeSoal = '$s[XKodeSoal]' and XStatusUjian = '1'"));
					if($sqlsoal<1){$kata="disabled";$alink="";}  else {$kata=""; $alink = "rekapexcel.php?soal=$s[XKodeSoal]&mapel=$s[XKodeMapel]&kelas=$s[XKodeKelas]";}	
					if($sqlpakai2>0){$katapakai="disabled";$alink="";}  else {$katapakai="";$alink = "rekapexcel.php?soal=$s[XKodeSoal]&mapel=$s[XKodeMapel]&kelas=$s[XKodeKelas]";}
					if($sqljawab<1){$katapakai="disabled";$alink="";}  else {$katapakai="";$alink = "rekapexcel.php?soal=$s[XKodeSoal]&mapel=$s[XKodeMapel]&kelas=$s[XKodeKelas]";}
					if($sqlpakai2>0){$katapakai2="disabled";$alink2="";}  else {$katapakai2="";$alink2 = "?modul=analisajawaban&soal=$s[XKodeSoal]&kelas=$s[XKodeKelas]";}								
					 $no++	;		
                               ?> 
                                    <tr class="odd gradeX">
										<td align="center">
											<input type="hidden" value="<?php echo $s['Urutan']; ?>" id="txt_mapel<?php echo $s['Urutan']; ?>"> 
											<?php echo $no; ?></td>
                                        <td align="center"><?php echo $s['XKodeSoal'];?></td>
                                        <td align="center"><?php echo $s['XNamaMapel']; ?></td>
                                        <td align="center"><?php echo "$sqlsoal (". $s['XJumPilihan']." Pilihan)"; ?></td>                                           
                                        <td align="center"><?php echo $s['kokel']." - ".$s['XKodeJurusan'].""; ?></td> 
                                        
                                        <td align="center">
                                        <?php // if($s['XAcakSoal']=="Y"){ echo "Acak";} else {echo "Tidak";} ?>                                        
										<?php echo "$s[XGuru]"; ?>
                                        </td>
                                                                                
										<td align="center"><a href=<?php echo $alink; ?> target="_blank">
                                        <button type="button" class="btn btn-info btn-sm" <?php echo $katapakai; ?> <?php echo $katapakai2; ?>><i class="fa fa-cloud-download"></i></button></a></td>											
										<td align="center"><a href=<?php echo $alink2; ?>>
                                        <button type="button" class="btn btn-primary btn-sm" <?php echo $katapakai; ?> <?php echo $katapakai2; ?>><i class="fa fa-bar-chart-o"></i></button></a></td>
                                        <td align="center">													
                                        <?php if($s['XStatusSoal']=="Y"){ ?>
                                        Aktif
                                        <?php } else { ?>
                                        Non Aktif                                        
										<?php } ?>
                                        </td>     
                                    </tr>
 
                          
                          <?php } ?>
                                   
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            <div class="well">
                            <p></p>
								<h4><span style="color: #1B06CF;"><?php echo $skull; ?>-CBT</span></h4>
								<b>PERHATIAN! Download Hasil Ujian (Rekap dan Analisa Nilai) DISABLE, apabila:</b>
                                <ul>
									<li>Belum ada peserta yang mengerjakan/mengikuti tes.</li>
									<li>Masih ada peserta yang berstatus Masih dikerjakan, reset status peserta 'online' ke 'selesai' bila tes sudah selesai namun status siswa 'masih dikerjakan / online' sebelum melihat Analisa Hasil</li>                                    
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
