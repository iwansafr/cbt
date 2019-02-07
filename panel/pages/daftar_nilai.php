<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
		$user=$_COOKIE['beeuser'];
include "../../config/server.php";
$skulpic= $log['XLogo'];

$sqlsiswa = mysqli_query($sqlconn,"select * from cbt_siswa where XNomerUjian= '$user' ");
$sisw = mysqli_fetch_array($sqlsiswa);
$kelkel=$sisw['XKodeKelas'];
$jurjur=$sisw['XKodeJurusan'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $skull; ?>-CBT | Administrator</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>
	<div>
		<br>
	</div>
	<div class="row">
		<div class="col-lg-12" style="margin-top:0px;">
		<div class="panel panel-green">
		<div class="panel-heading">Daftar Nilai Semua Ujian</div>
			<div class="panel-body" align="center">
				<table border="0" >
					<tr>
						<td style="width:25%">
							<center><img src="../../images/<?php echo $skulpic; ?>" style=" width:100%; max-width:120px;padding-left:0px;"></center>
						</td>
						<td style="width:50%">
							<center> <span style="color: #ff0000" ><h3 style='margin-top:5px'>HASIL UJIAN BELUM FINAL<br> MASIH BISA BERUBAH</h3></span> 
							   <br><span style="color: #5D3B96" ><h4 style='margin-top:-10px'>Prosedur Perbaikan Nilai:</h4></span>
							   <br><span style="color: #0F07DE;" align="left"><ul><h5 style='margin-top:-10px'><li>Remidi (Ujian Perbaikan untuk Mencapai Nilai KKM).</li>
							   <li>Pengayaan (Ujian untuk Meningkatkan Nilai yang Suah Mencapai KKM).</li></h5></span>
							</center>
						</td>
						<td style="width:25%">
							<center><img src="../../fotosiswa/<?php echo $poto; ?>" style=" width:100%; max-width:120px;padding-left:0px;"></center>
						</td>
					</tr>
				</table>		
			</div>
            <!-- /.row -->
			<div class="row">
			<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<center><h4>Daftar Nilai Ananda : <span style="color: #BD1A0D " ><?php echo "$nama"; ?> </span> &nbsp; &nbsp; &nbsp; Kelas : <span style="color: #BD1A0D " ><?php echo "$kelkel - $jurjur"; ?></span></h4></center>
					<center> <span style="color: #ff0000;"><b>H </b></span>= Nilai Harian,<b> <span style="color: #ff0000;">UTS </span></b>= Nilai Ujian Tengah Semester, <span style="color: #ff0000;"><b>UAS </b></span>= Nilai Ujian Akhir Semester </span> dan <span style="color: #ff0000;"><b>TO </b></span>= Nilai Try-Out</span></center>
					<!--
					<table width="100%">
						<tr><td>Daftar Bank Soal</td>
							<td align="right">
									
							</td>
						</tr>
					</table>
					-->
				</div>
				<!-- panel-heading -->
				<div class="panel-body">
					<!-- table-responsive -->
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th width="4%">No</th>
								<th width="20%">User Name</th>
								<th width="20%">Kode Soal</th>
								<th width="20%">Nama Mapel</th>
								<th width="6%">KKM</th>	
								<th width="6%">Nilai</th>
								<th width="7%">Jenis Ujian</th>                                                                                                                        
								<th width="10%">Token</th>
							</tr>
						</thead>
						<tbody>
<?php 	
	$sqladmin = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_nilai where XNomerUjian= '$user'"));
	if($sqladmin<1){
		
	$no=1; 	
	
		$usernm="-";	
		$ku="-";	$nil="-";
		$kopel="-";	$kosal="-";
		$toku="-"; 	$kkm="-";
		
	}else{
		$query=mysqli_query($sqlconn,"SELECT * FROM cbt_nilai where XNomerUjian= '$user'");
		
	$no=0;
	
		while($var=mysqli_fetch_array($query)){
			$usernm=$var['XNomerUjian'];	
			$ku=$var['XKodeUjian']; 	$nil=$var['XTotalNilai'];
			$kopel=$var['XKodeMapel'];	$kosal=$var['XKodeSoal'];
			$toku=$var['XTokenUjian']; 

			$sql = mysqli_query($sqlconn,"select * from cbt_mapel where XKodeMapel = '$var[XKodeMapel]' ");
				$rr = mysqli_fetch_array($sql);		
				$kkm=$rr['XKKM'];		
				$napel=$rr['XNamaMapel'];
				
	$no++; ?>
							<tr class="odd gradeX">
								<td align="center"><?php echo $no; ?></td>
								<td align="center"><?php echo $usernm; ?></td>
								<td align="center"><?php echo $kosal; ?></td>
								<td align="center"><?php echo $napel; ?></td>
								<td align="center"><?php echo $kkm; ?></td>                                           
								<td align="center"><?php echo $nil; ?></td> 
								<td align="center"><?php echo $ku; ?></td>
								<td align="center"><?php echo $toku; ?></td>
							</tr>
 
				</div>
			</div>
<?php }} ?>
                                   
						</tbody>
					</table>
					<!-- /.table-responsive -->
				<div class="well">
					<p></p><h4><span style="color: #1B06CF;"><?php echo $skull; ?>-CBT</span></h4>
				</div>
			</div>
                        <!-- /.panel-body -->
			</div>
			<!-- /.row -->
		</div>
		</div>
            
    <script src="../vendor/jquery/jquery-1.12.3.js"></script>
    <script src="../vendor/jquery/jquery.dataTables.min.js"></script>
	<script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
	});
</script>

</body>

</html>
