<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>AJAX File Upload - Web Developer Plus Demos</title>
<script type="text/javascript" src="js/jquery-1.3.2.js" ></script>
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<!--<link rel="stylesheet" type="text/css" href="./styles.css" />-->

<script type="text/javascript" ></script>
<script>
		$(function(){
		var btnUpload=$('#upload');
		var status=$('#status');
		new AjaxUpload(btnUpload, {
			action: 'upload-potosiswa.php',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				//On completion clear the status
				status.text('');
				//Add uploaded file to list
				
				if(response==="success"){
				$('#upload').html('<img src="../../fotosiswa/'+file+'"  width="200" alt="" />').addClass('success');
//					$('<li></li>').appendTo('#files').html('<img src=".photo/'+file+'" alt="" /><br />'+file).addClass('success');
				} else{
					$('<li></li>').appendTo('#files').text(file).addClass('error');
				}
			}
		});
		
	});

</script>


<style>
.left {
    float: left;
    width: 73%;
}
.right {
    float: right;
    width: 25%;
}
.group:after {
    content:"";
    display: table;
    clear: both;
}
img {
    max-width: 100%;
    height: auto;
}
@media screen and (max-width: 480px) {
    .left, 
    .right {
        float: none;
        width: auto;
		margin-top:10px;		
    }
	
}
</style>
</head>

<body>
<script type="text/javascript" src="../js/jquery.js"></script>

<script type="text/javascript">
$(document).ready(function(){
 	var loading = $("#loading");
	var tampilkan = $("#tampilkan");

	loading.hide()
	$("#simpansiswa").click(function(){
	var txt_namasiswa = $("#namasiswa").val();
	var txt_nik = $("#nik").val();
	var txt_pilihan = $("#pilihan").val();
	var txt_agama = $("#agama").val(); 
	var txt_kelamin = $("#kelamin").val(); 
	$.ajax({
    type:"POST",
    url:"ubahbiodata.php",    
	data: "aksi=simpansiswa&txt_namasiswa=" + txt_namasiswa + "&txt_nik=" + txt_nik + "&txt_pilihan=" + txt_pilihan
	+ "&txt_agama=" + txt_agama + "&txt_kelamin=" + txt_kelamin,
	success: function(data){
		loading.fadeOut();
		$("#info").html(data);
		$("#info").fadeOut(2000);
	 }
	 });
	 });
});
 
</script>
<div id="mainbody" >
<?php 
include "../../config/server.php";

	$sql = mysqli_query($sqlconn,"select * from cbt_siswa WHERE XNomerUjian='$_COOKIE[beeuser]'");
	$xadm = mysqli_fetch_array($sql);
	$nama= $xadm['XNamaSiswa'];
	$nik= $xadm['XNIK'];
	$poto= $xadm['XFoto'];
	$kelas=$xadm['XKodeKelas'];
	$jurusan=$xadm['XKodeJurusan'];
	$jeniskelamin=$xadm['XJenisKelamin'];
	$agama=$xadm['XAgama'];
	$pilihan=$xadm['XPilihan'];
	

?>

<br />
<span>
    <div class="left">
    				<div class="panel panel-primary">
                        <div class="panel-heading">
                            Edit Biodata
                        </div>
                        <div class="panel-body">
                            <table width="100%" border="0px">
                            <tr height="42px"><td width="30%">Username&nbsp;</td><td>: <td> &nbsp;&nbsp;&nbsp;<?php echo "$_COOKIE[beeuser]"; ?></td><td width="20%"></tr>
							<tr height="42px"><td width="30%">Kelas - <?php echo $rombel;?>&nbsp;</td><td>: <td>&nbsp;&nbsp;&nbsp;<?php echo "$kelas - $jurusan"; ?></td></tr>
                            <tr height="42px"><td width="30%">Nama&nbsp;</td><td>: <td>
								<input type="text" class="form-control" id="namasiswa" value="<?php echo "$nama"; ?>"/></td></tr>
                            <tr height="42px"><td width="30%">NIS/NISN&nbsp;</td><td>: <td>
								<input type="text" class="form-control" id="nik" value="<?php echo "$nik"; ?>" /></td></tr>
							<tr height="42px"><td width="30%">Mapel Umum/Agama&nbsp;</td><td>: <td>
								<select id="agama" type="text" class="form-control" >
															
									<option value='ISLAM' <?php if ($agama=="ISLAM"){echo "selected";} ?>>ISLAM</option>
									<option value='KRISTEN' <?php if ($agama=="KRISTEN"){echo "selected";} ?>>KRISTEN</option>  
									<option value='PROTESTAN' <?php if ($agama=="PROTESTAN"){echo "selected";} ?>>PROTESTAN</option>
									<option value='HINDU' <?php if ($agama=="HINDU"){echo "selected";} ?>>HINDU</option>
									<option value='BUDHA' <?php if ($agama=="BUDHA"){echo "selected";} ?>>BUDHA</option>
									<option value='KONGHUCU' <?php if ($agama=="KONGHUCU"){echo "selected";} ?>>KONGHUCU</option>
									<option value='' <?php if ($agama==""){echo "selected";} ?>>Mapel UMUM</option>
								</select>   						
							</td></tr>
							<tr height="42px"><td width="30%">Mapel Pilihan/Non Pilihan&nbsp;</td><td>: <td>
								<select id="pilihan" type="text" class="form-control">
									
								<?php $x= mysqli_query($sqlconn,"select * from cbt_mapel where XMapelAgama='Y'");
								while($rs = mysqli_fetch_array($x)){$sd=$rs['XNamaMapel'];?>
                             	<option value=<?php echo $sd ;echo" "; if ($pilihan==$sd){echo "selected";}?> ><?php echo $sd;?></option>									
								<?php } ?>
									<option value='' <?php if ($pilihan==""){echo "selected";} ?>>Non Pilihan</option>
								</select>   						
							</td></tr>
							<tr height="42px"><td width="30%">Jenis Kelamin&nbsp;</td><td>: <td>
								<select id="kelamin" type="text" class="form-control" >
									<?php if ($jeniskelamin == "L"){$jenis ="Laki-Laki";} else{$jenis ="Perempuan";} ?>
									<option value='<?php echo $jeniskelamin; ?>'><?php echo $jenis.' ('.$jeniskelamin.')'; ?>	</option> 								
									<option value='L'>Laki-Laki (L)</option>
									<option value='P'>Permpuan (P)</option>
									
								</select>   						
							</td></tr>                       
                            
                            </table>
                        </div>
						
                        <div class="panel-footer">
                            <input type="submit"  class="btn btn-info btn-lg btn-small" id="simpansiswa" name="simpansiswa" value="Simpan">
                            <div id="info"></div><div id="loading"><img src="images/loading.gif" height="10"></div>
                        </div>
                    </div>
			
			</div>
<div class="group">
    <div class="right">
             <div class="panel panel-info" style="padding-top:20">
                        <div class="panel-heading" style=" text-align:center">
                            Upload Photo : 
                        </div>
                        <div class="panel-body">
                          
                        <!-- Upload Button, use any id you wish-->
                        <div id="upload" style="text-align:center"><img src="../../fotosiswa/<?php echo "$poto"; ?>" width="100"/></div><span id="status1" ></span>
           				</div>
               			<div class="panel-footer" style=" text-align:center">Update Foto Anda Kemudain Refresh / Reload (F5)
                        </div>
               
            </div>


                

    </div>	
</div>  
               
</body>
<?php

?>