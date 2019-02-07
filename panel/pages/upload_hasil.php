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
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
</head>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="./js/jquery-1.4.js"></script>

<body>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Daftar Tes </h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <table width="100%"><tr><td>Daftar Tes </td><td align="right"></td></tr>
							</table>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        		
                        
                        
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
	                                    <th width="6%">No.</th>
                                        <th width="10%">Kode Mapel </th>
                                        <th width="20%">Mata Pelajaran</th>
                                        <th width="9%">Soal</th>	
                                        <th width="9%">Kelas</th>
                                        <th width="8%">Guru</th>                                           
                                        <th width="9%">Token</th>                                           
                                        <th width="11%">Tanggal Ujian</th>    
                                        <th width="7%">Upload<br/>Hasil</th>                                        
                                 </tr>
                                </thead>
                                <tbody>
                                <?php 
								$no=1;
				
					$sql = mysqli_query($sqlconn,"select p.*,m.*,p.Urut as Urutan,p.XKodeKelas  as kokel,p.XTokenUjian as token from cbt_ujian p left join cbt_mapel m on m.XKodeMapel = p.XKodeMapel left join cbt_paketsoal u on u.XKodeSoal=p.XKodeSoal order by p.Urut desc");
								
					while($s = mysqli_fetch_array($sql)){ 
					$sqlsoal = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_soal where XKodeSoal = '$s[XKodeSoal]'"));
			
					$sqlpakai2 = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_siswa_ujian where XKodeSoal = '$s[XKodeSoal]' and XStatusUjian = '1'"));
		
					if($sqlpakai2>0){$katapakai2="disabled";$alink2="";}  else {$katapakai2="";$alink2 = "?modul=analisajawaban&soal=$s[XKodeSoal]&kelas=$s[XKodeKelas]";}								
								?>
                                
                                    <tr class="odd gradeX">
                                        <td><?php echo $no; $no++;?></td>
										<td><?php echo $s['XKodeSoal'];?></td>
                                        <td><?php echo $s['XNamaMapel']; ?></td>
                                        <td><?php echo "$sqlsoal (". $s['XJumPilihan']." Pilihan)"; ?></td>                                           
                                        <td><?php echo $s['kokel']." | ".$s['XKodeJurusan']."."; ?></td> 
                                        
                                        <td align="center">
                                        <?php  if($s['XAcakSoal']=="Y"){ echo "Acak "."|";} else {echo "Tidak "."|";} ?>                                        
										<?php echo "$s[XGuru]"; ?></td>
                                        <td><?php echo "$s[token]"; ?></td>                                         
										<td align="center"><?php echo ''.substr($s['XTglUjian'],8,2)."-".substr($s['XTglUjian'],5,2)."-".substr($s['XTglUjian'],0,4); ?></td>
										<td align="center"><a href="?modul=upl_hasil&token=<?php echo "$s[token]"; ?>">
                                        <button type="button" class="btn btn-primary btn-sm" <?php echo $katapakai2; ?>><i class="fa fa-cloud-upload"></i></button></a></td>
                                          
                                    </tr>
  
                              <?php } ?>
                                   
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            <div class="well">
                            <p></p>
                                <h4><span style="color: #1B06CF;"><?php echo $skull; ?>-CBT</span></h4>
									<b>Upload Hasil ENABLE, apabila</b>
								<ul><li>Sudah ada Nilai di cbt_nilai, ada peserta yang mengambil tes</li>
                                	                                  
                                </ul>
                          </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
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
