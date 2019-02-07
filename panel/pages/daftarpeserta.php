<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
	include "../../config/server.php";
?>
 <script type="text/javascript" src="./js/jquery-1.4.js"></script>
 <script>    
$(document).ready(function(){
 $("#simpan").click(function(){
 //alert("hai");
 var nompes = $("#nompes").val();
 //alert(nompes);
 $.ajax({
     type:"POST",
     url:"resetlogin.php",    
     data: "aksi=simpan&nompes=" + nompes,
	 success: function(data){
	 $("#info").html(data);
	 tampildata();
	 }
	 });
	 });

});
</script>

<br>
<table class="table table-bordered" cellpadding="30px" width="100%" border="0">
	<tr style="color:#FFFFFF; font-style:normal; font-weight:normal; text-align:center" height="40px" bgcolor="#000">
			<th style="color:#FFFFFF; font-style:normal; font-weight:normal; text-align:center">&nbsp;No.</th>
			<th style="color:#FFFFFF; font-style:normal; font-weight:normal; text-align:center">Nomer Peserta</th>
			<th style="color:#FFFFFF; font-style:normal; font-weight:normal; text-align:center">Nama Siswa</th>
			<th style="color:#FFFFFF; font-style:normal; font-weight:normal; text-align:center">Kelas - <?php echo $rombel; ?></th>
			
			<th style="color:#FFFFFF; font-style:normal; font-weight:normal; text-align:center">NIS/NISN</th>
			<th style="color:#FFFFFF; font-style:normal; font-weight:normal; text-align:center">Status Tes Peserta</th>
	</tr>
	<?php
$sqlad = mysqli_query($sqlconn,"select * from cbt_admin");
$ad = mysqli_fetch_array($sqlad);
$tingkat=$ad['XTingkat'];
if ($tingkat=="MA" or $tingkat=="SMA" or $tingkat=="SMK"  ){$rombel="Jurusan";}else{$rombel="Rombel";}

			$sql = mysqli_query($sqlconn,"SELECT *,u.XStatusUjian as ujsta FROM cbt_siswa s LEFT JOIN `cbt_siswa_ujian` u ON u.XNomerUjian = s.XNomerUjian
				LEFT JOIN cbt_ujian c ON (u.XKodeSoal = c.XKodeSoal and u.XTokenUjian = c.XTokenUjian) WHERE c.XStatusUjian = '1'"); 
			$nom = 1;								
			while($s= mysqli_fetch_array($sql)){ 
			$nama = str_replace("  ","",$s['XNamaSiswa']); 
			$nouji = str_replace("  ","",$s['XNomerUjian']); 
			$kodekelas = str_replace("  ","",$s['XKodeKelas']); 
			$kodeNIK = str_replace("  ","",$s['XNIK']); 
			$kodeJUR = str_replace("  ","",$s['XKodeJurusan']); 
			$staujian = str_replace("  ","",$s['ujsta']); 
			if($staujian =='0'){$staujian = "Belum Login";}
			elseif($staujian =='1'){$staujian = "<font color='#629ad8'> Masih Dikerjakan </font>";}
			elseif($staujian =='9'){$staujian = "<font color='#be425f'> Tes SELESAI </font>";}		
			?>

	<tr height="40px">
			<td width="5%" align="center">&nbsp;<?php echo $nom ; ?></td>
			<td width="15%" align="center"><?php echo $nouji; ?></td>
			<td width="30%"><?php echo $nama; ?></td>
			<td width="15%" align="center"><?php echo $kodekelas; ?> - <?php echo $kodeJUR; ?></td>
			
			<td width="15%" align="center"><?php echo $kodeNIK; ?></td>
			<td width="15%" align="center"><?php echo "$staujian"; ?></td>
			</td>
	</tr>
                                
	<?php 	$nom++; } ?>
</table>