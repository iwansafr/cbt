<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>

<html>
  <head>
    <title>BEESMART-CBT | Administrator</title>
</head>
  <body>

<!-- <link rel="stylesheet" type="text/css" href="./styles.css" /> -->

<style>
.left {
    float: left;
    width: 35%;
}
.right {
    float: right;
    width: 63%;
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

.switch-field {
  font-family: "Lucida Grande", Tahoma, Verdana, sans-serif;
	overflow: hidden;
}

.switch-title {
  margin-bottom: 6px;
}

.switch-field input {
  display: none;
}

.switch-field label {
  float: left;
}

.switch-field label {
  display: inline-block;
  width: 60px;
  background-color: #e4e4e4;
  color: rgba(0, 0, 0, 0.6);
  font-size: 14px;
  font-weight: normal;
  text-align: center;
  text-shadow: none;
  padding: 6px 14px;
  border: 1px solid rgba(0, 0, 0, 0.2);
  -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
  -webkit-transition: all 0.1s ease-in-out;
  -moz-transition:    all 0.1s ease-in-out;
  -ms-transition:     all 0.1s ease-in-out;
  -o-transition:      all 0.1s ease-in-out;
  transition:         all 0.1s ease-in-out;
}

.switch-field label:hover {
	cursor: pointer;
}

.switch-field input:checked + label {
  background-color: #A5DC86;
  -webkit-box-shadow: none;
  box-shadow: none;
}

.switch-field label:first-of-type {
  border-radius: 4px 0 0 4px;
}

.switch-field label:last-of-type {
  border-radius: 0 4px 4px 0;
}
#ingat{width:84%; height:90px; background-color:#FBECF0; border:0; border-left:thick #FF0000 solid; padding-left:10; padding-top:15}

</style>
<script>    
$(document).ready(function(){
document.getElementById("ndelik").style.display = "none";
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


$("#baru").click(function(){
 var txt_ujian = $("#txt_ujian").val();
 var txt_jawab = $("#txt_jawabz").val();
 var txt_kelas = $("#txt_kelasz").val();
 var txt_jurusan = $("#txt_jurusanz").val();
 var txt_soal = $("#txt_soalz").val();  
 var txt_mapel = $("#txt_mapelz").val();
 var txt_level = $("#txt_levelz").val(); 
 var txt_nama = $("#txt_namaz").val();  
 var txt_jumsoal1 = $("#txt_jumsoalz1").val();  
 var txt_jumsoal2 = $("#txt_jumsoalz2").val(); 
 var txt_bobotsoal1 = $("#txt_bobotsoalz1").val();  
 var txt_bobotsoal2 = $("#txt_bobotsoalz2").val();   
  
 
 var txt_kodesek = $("#txt_kodesek").val(); 


var n = txt_nama.includes(" ");
if(n==true){
alert("Kode Bank Soal mengandung Spasi");
return false;
}

if(txt_nama==""){
alert("Isikan Kode Bank Soal");
return false;
}

if(txt_kelas=="Pilih Kelas"){
alert("Belum Pilih Kelas ");
return false;
}
 
//alert(txt_mapel);   
 $.ajax({
     type:"POST",
     url:"database_soal_simpan.php",    
     data: "aksi=simpan&txt_ujian=" + txt_ujian + "&txt_jawab=" + txt_jawab + "&txt_kelas=" + txt_kelas + "&txt_jurusan=" + txt_jurusan + 
	 "&txt_soal=" + txt_soal + "&txt_level=" + txt_level + "&txt_mapel=" + txt_mapel + "&txt_nama=" + txt_nama + "&txt_jumsoal1=" + txt_jumsoal1  + "&txt_jumsoal2=" + 
	 txt_jumsoal2 + "&txt_soal=" + txt_soal + "&txt_bobotsoal1=" + txt_bobotsoal1  + "&txt_bobotsoal2=" + txt_bobotsoal2 + "&txt_kodesek=" + txt_kodesek,
	 success: function(data){
	 document.getElementById("ndelik").style.display = "block";
		loading.fadeOut();
		tampilkan.html(data);
		tampilkan.fadeIn(100);
	 	tampildata();
	 }
	 });
	 });

});

</script>
<div id="mainbody" >
 
				<div class="alert alert-success alert-dismissable" id="ndelik" align="center">
				
					
					<span style="color: #ff0000;"> --=== <b>Bank Soal Baru sukses dibuat .... Tambah Lagi?</b> ===--</span>
                </div>  
 				
                <div class="panel panel-primary">
                        <div class="panel-heading">
                            Tambah Bank Soal 
                </div>
                <div class="panel-body">
                    <table width="100%" border="0px">
                        <tr height="32px">
							<td width="30%">Kode Sekolah&nbsp;</td>
							<td>: &nbsp;
							<td><select class="form-control" name="txt_kodesek" id="txt_kodesek">
							<option value='ALL' selected>SEMUA</option>
                                <?php 
                                $sqlsek = mysqli_query($sqlconn,"select * from server_sekolah order by XServerId");
                                while($sek = mysqli_fetch_array($sqlsek))
								{echo "<option value='$sek[XServerId]'>$sek[XServerId] </option>"; }
                                ?>
								
								</select>
							<td>	</td>
						</tr>
						<tr height="32px">
							<td>Mata Pelajaran</td>
							<td>: &nbsp; 
							<td><select class="form-control" name="txt_mapelz" id="txt_mapelz">
                                <?php 
                                $sqlkelas = mysqli_query($sqlconn,"select * from cbt_mapel order by XKodeMapel");
                                while($sk = mysqli_fetch_array($sqlkelas)){echo "<option value='$sk[XKodeMapel]'>$sk[XKodeMapel] - $sk[XNamaMapel]</option>";}
                                ?></select>
								<?php 
								//$sqladmin = mysqli_query($sqlconn,"select * from cbt_admin a left join cbt_kelas k on k.XLevelKelas = a.XTingkat");
								$sqladmin = mysqli_query($sqlconn,"select * from cbt_admin");
								$sa = mysqli_fetch_array($sqladmin);
								$skul = $sa['XTingkat'];
								?> 
							</td><td>	</td>
						</tr>   
                        <tr height="32px">
							<td>Tingkat Sekolah&nbsp;</td>
							<td>: &nbsp;
							<td><select class="form-control" id="txt_levelz">
								                           
								<option value="SD" <?php if($skul=='SD'){echo "selected";} ?>>SD</option>
								<option value="MI" <?php if($skul=='MI'){echo "selected";} ?>>MI</option>                            
								<option value="SMP" <?php if($skul=='SMP'){echo "selected";} ?>>SMP</option>
								<option value="MTs" <?php if($skul=='MTs'){echo "selected";} ?>>MTs</option>                            
								<option value="SMA" <?php if($skul=='SMA'){echo "selected";} ?>>SMA</option>
								<option value="MA" <?php if($skul=='MA'){echo "selected";} ?>>MA</option>                            
								<option value="SMK" <?php if($skul=='SMK'){echo "selected";} ?>>SMK</option>                            
								</select>
                            </td><td>	</td>
						</tr>
                           
                        <tr height="32px"><td>Jurusan&nbsp;</td>
						   <td>: 
						   <td><select class="form-control" id="txt_jurusanz">
							<option value="ALL" selected>SEMUA</option>
                             <?php 
							 $sqljur = mysqli_query($sqlconn,"select * from cbt_kelas group by XKodeJurusan");
							  while($j = mysqli_fetch_array($sqljur))
							 {echo "<option value='$j[XKodeJurusan]' >$j[XKodeJurusan]</option>";}
							 ?></select>
							</td><td>	</td>
						</tr>

                        <tr height="32px">
							<td >Kelas&nbsp;
							</td>
							<td>: &nbsp;
							<td><select class="form-control" id="txt_kelasz">
								<option value='ALL' selected>SEMUA</option>
								<?php 
								$sqlkelas = mysqli_query($sqlconn,"select * from cbt_kelas group by XKodeKelas");
								while($k = mysqli_fetch_array($sqlkelas))
								{echo "<option value='$k[XKodeKelas]' selected>$k[XKodeKelas]</option>";}
								?>
								</select>
							</td><td>	</td>
						</tr>
						<tr height="32px">
							<td >Kode Bank Soal&nbsp;</td>
							<td>: &nbsp;
							<td><input class="form-control" type="text" id="txt_namaz"/>  <span style="color: #ff0000;"> </span></td>
							<td>	</td>
						</tr>
						
                        <tr height="32px">
							<td >Jumlah Opsi Jawaban&nbsp;
							</td>
							<td>: 	&nbsp;
							<td><select class="form-control"id="txt_jawabz">
									<option value= '5' selected>5</option>
									<option value='4'>4</option>
									<option value='3'>3</option>
								</select>
								
							<!--<input size="2" type="text" id="txt_jawabz"/> * Default 5 Pilihan !-->
                            </td><td>	</td>
						</tr>
						
                        <tr height="32px">
							<td >Pilihan Ganda &nbsp;
							</td>
							<td>: &nbsp;
							<td><input  class="form-control"size="2" type="text" id="txt_jumsoalz1"/>  
                            </td><td>&nbsp;&nbsp;* Jml yg Ditampilkan	</td>
						</tr>                            
						<tr height="32px">
							<td >Bobot Pilihan &nbsp;
							</td>
							<td>: &nbsp;
							<td><input  class="form-control"size="2" type="text" id="txt_bobotsoalz1"/>  
                            </td><td>&nbsp;&nbsp;%</td>
						</tr>                            
                        <tr height="32px">
							<td >Essai &nbsp;
							</td>
							<td>: &nbsp;
							<td><input  class="form-control"size="2" type="text" id="txt_jumsoalz2"/>  
                            </td><td>&nbsp;&nbsp; * Jml yg Ditampilkan	</td>
						</tr>                            
                        <tr height="32px">
							<td >Bobot Essai &nbsp;
							</td>
							<td>: &nbsp;
							<td><input  class="form-control"size="2" type="text" id="txt_bobotsoalz2"/> 
                            </td><td> &nbsp;&nbsp;%	</td>
						</tr> 
										
                    </table>
                </div>
				             
				<div style="width: 78%; float:left">
                                <h4><font color="#FF0000">Keterangan: *</font></h4>
                                <ul><li>JANGAN ada SPASI, BISA gunakan tanda sambung (-)</li>
								<li>Hindari Kode Bank Soal yang Terlalu Panjang </li>
								<li>Contoh nama yang baik: BING-11IPA-UAS1</li>
                                </li></ul>   
		</div>
</body>
</html>
