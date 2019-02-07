<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
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

   
</head>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="./js/jquery-1.4.js"></script>

 <?php 
 $tgljam = date("Y/m/d H:i");  
 $tgl = date("Y/m/d"); 
 ?>
  <link rel="stylesheet" type="text/css" href="./css/jquery.datetimepicker.css"/>
<style type="text/css">

.custom-date-style {
	background-color: red !important;
}

.input{	
}
.input-wide{
	width: 500px;
}

</style>
<style>
.asd {
  display: inline-block;
  width: 50%;
}
</style>
<?php 
$tgx = 29;
$blx = '09';
$thx = 2016;

$tglx = date("Y/m/d");
$jamx = date("H:i:s");
?>
<script src="date/jquery.js"></script>
<script src="./js/jquery.datetimepicker.full.js"></script>
<?php
$sql = mysqli_query($sqlconn,"select p.*,m.*,p.Urut as Urutan,p.XKodeKelas  as kokel from cbt_paketsoal p left join cbt_mapel m on m.XKodeMapel = p.XKodeMapel where p.XStatusSoal='Y' and p.Urut = '$_REQUEST[idtes]'");
$s = mysqli_fetch_array($sql);
?>

<body>

            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Aktifasi Jadwal Ujian</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

<script>/*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}*/
$.noConflict();
jQuery( document ).ready(function( $ ) {
$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker<?php echo $s['Urutan']; ?>').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1986/01/05'
});
$('#datetimepicker<?php echo $s['Urutan']; ?>').datetimepicker({value:'2015/04/15 05:03',step:10});
$('.some_class').datetimepicker();
$('#default_datetimepicker<?php echo $s['Urutan']; ?>').datetimepicker({
	formatTime:'H:i',
	//formatDate:'d.m.Y',
	formatDate:'Y.m.d',
	//defaultDate:'8.12.1986', // it's my birthday
	defaultDate:'+03.01.1970', // it's my birthday
	defaultTime:'10:00',
	timepickerScrollbar:false
});
$('#datetimepicker10').datetimepicker({
	step:5,
	inline:true
});
$('#mulai2').datetimepicker({
	datepicker:false,
	format:'H.i',
	step:5
});
$('#datetimepicker_mask<?php echo $s['Urutan']; ?>').datetimepicker({
	mask:'9999/19/39 29:59'
});
$('#datetimepicker_mask<?php echo $s['Urutan']; ?>').datetimepicker({value:'<?php echo "$tglx $jamx"; ?>',step:10});
$('#datetimepicker_dark').datetimepicker({theme:'dark'})
        }); 
</script>       			
                          
<script>    
$(document).ready(function(){
	$("#txt_durasi<?php echo $s['Urutan']; ?>").change(function(){
		var txt_durasi = $("#txt_durasi<?php echo $s['Urutan']; ?>").val();
		$.ajax({
		url: "ambil_token.php",
		data: "txt_ujian="+txt_durasi,
		cache: false,
		success: function(msg){
		$("#txt_token<?php echo $s['Urutan']; ?>").val(msg);
		}
		});
	});

 $("#kirim<?php echo $s['Urutan']; ?>").click(function(){
 //alert("tes");
 var txt_ujian = $("#txt_ujian<?php echo $s['Urutan']; ?>").val();
 var txt_semester = $("#txt_semester<?php echo $s['Urutan']; ?>").val();
 var txt_waktu = $("#datetimepicker_mask<?php echo $s['Urutan']; ?>").val();
 var txt_token = $("#txt_token<?php echo $s['Urutan']; ?>").val();
 var txt_durasi = $("#txt_durasi<?php echo $s['Urutan']; ?>").val();
 var txt_kodesoal = $("#txt_kodesoal<?php echo $s['Urutan']; ?>").val();
 var txt_sesi = $("#txt_sesi<?php echo $s['Urutan']; ?>").val();
 var txt_hasil = $("#txt_hasil<?php echo $s['Urutan']; ?>").val();
 var txt_statustoken = $("#txt_statustoken<?php echo $s['Urutan']; ?>").val();
 var mulai2 = $("#mulai2").val();
 var txt_pdf = $("#txt_pdf<?php echo $s['Urutan']; ?>").val();
 var txt_filepdf = $("#txt_filepdf<?php echo $s['Urutan']; ?>").val();
 var txt_listen = $("#txt_listen<?php echo $s['Urutan']; ?>").val();
 
 if(txt_durasi==""){
 alert("Durasi Ujian masih KOSONG");
 return false;
 }
  
 $.ajax({
     type:"POST",
     url:"simpan_jadwal.php",    
     data: "aksi=simpan&txt_ujian=" + txt_ujian + "&txt_waktu=" + txt_waktu + "&txt_token=" + txt_token + "&txt_durasi=" + txt_durasi  + "&txt_filepdf=" + txt_filepdf + "&txt_pdf=" + txt_pdf+ "&txt_listen=" + txt_listen
	  + "&txt_kodesoal=" + txt_kodesoal + "&txt_semester=" + txt_semester + "&txt_hasil=" + txt_hasil + "&txt_sesi=" + txt_sesi + "&txt_statustoken=" + txt_statustoken + "&mulai2=" + mulai2,
	 success: function(data){
	  $("#infoz").html(data);
	  document.getElementById("ndelik").style.display = "block";
	  //alert(txt_waktu);
		//tampildata();
	 }
	 });
	 });
	

});
</script>                            

<script>
function myFunction() {
   document.location.reload();
}
</script>

<div id="infoz" class="infoz"></div>
	<table width="100%" border="0" >
		<tr><td>Jenis Ujian <td>: &nbsp; &nbsp;<td>
			<select class="form-control" id="txt_ujian<?php echo $s['Urutan']; ?>">
				<?php	$sqlkelas = mysqli_query($sqlconn,"select * from cbt_tes order by Urut");
						while($k = mysqli_fetch_array($sqlkelas)){
							echo "<option value='$k[XKodeUjian]'>$k[XNamaUjian]</option>";
				} ?>
			</select>
			<td> &nbsp;&nbsp; Semester <td>:&nbsp; &nbsp;<td>        
			<select class="form-control" id="txt_semester<?php echo $s['Urutan']; ?>">
				<?php	echo "<option value='1'>Ganjil</option>";
						echo "<option value='2'>Genap</option>";
				?></td>
		</tr>
		<tr><td>Pemutaran Listening <td>: &nbsp; &nbsp;<td>        
			<select class="form-control" id="txt_listen<?php echo $s['Urutan']; ?>">
				<?php	echo "<option value='1'>Sekali</option>";
						echo "<option value='2'>Dua Kali</option>";
						echo "<option value='3'>terusan</option>";
				?>
		<td>&nbsp;&nbsp; Sesi Ujian <td>: &nbsp; &nbsp;<td>
			<select class="form-control" id="txt_sesi<?php echo $s['Urutan']; ?>">
				<?php	$sqlsesi = mysqli_query($sqlconn,"select * from cbt_siswa group by XSesi");
						while($sk = mysqli_fetch_array($sqlsesi)){echo "<option value='$sk[XSesi]'>$sk[XSesi]</option>";}
				?>
			<option value='ALL'>Semua</option>
			</select></td>
		</tr>
		<tr><td>Soal PDF  <font color="#cd0202"><b>*</b></font><td>: <td>                                 
			<select class="form-control" class="form-control" id="txt_pdf<?php echo $s['Urutan']; ?>">
				<?php 	echo "<option value='0'>Bukan PDF</option>";
						echo "<option value='1'>Soal PDF</option>";
				 ?>
		<td>&nbsp;&nbsp; Nama File PDF <font color="#cd0202"><b>*</b></font><td>: <td> 
			<input class="form-control" type="text" size="25" id="txt_filepdf<?php echo $s['Urutan']; ?>">
			<td></td>
		</tr>
		<tr><td>Waktu Pelaksanaan <td>:<td>  
			<input class="form-control" type="text" size="25" value="" id="datetimepicker_mask<?php echo $s['Urutan']; ?>"/>
		<td><td><td>&nbsp;&nbsp; <font color="#cd0202">Contoh penulisan : soal1.pdf</font></td>
		</tr>
		<tr><td>Durasi Tes (menit) <td>: <td>  	
			<input class="form-control" type="text" size="10" id="txt_durasi<?php echo $s['Urutan']; ?>"> 
		<td></td>
		</tr>
		<tr><td>Ujian ditutup <font color="#cd0202"><b>*</b></font> <td>: <td> 		
			<input class="form-control" type="text" size="10" value='' id="mulai2">
			<td>&nbsp;&nbsp; NILAI<td>: &nbsp; &nbsp;<td>	
			<select class="form-control" id="txt_hasil<?php echo $s['Urutan']; ?>">
				<?php 	echo "<option value='1'>NILAI Ditampilkan</option>";	
						echo "<option value='0'>NILAI Tidak Ditampilkan </option>";
				?> 
			</select>
		</td></tr>
		<tr><td>TOKEN <td>:<td >       
			<input class="form-control"type="text" size="10" id="txt_token<?php echo $s['Urutan']; ?>">
		<td>&nbsp;&nbsp; Status TOKEN <td>: &nbsp; &nbsp;<td>	    
			<input class="form-control" type="hidden" size="3" id="txt_kodesoal<?php echo $s['Urutan']; ?>" value="<?php echo $s['XKodeSoal']; ?>">
				<select class="form-control" id="txt_statustoken<?php echo $s['Urutan']; ?>">
                    <?php	echo "<option value='0'>TOKEN Tidak Ditampilkan </option>";
							echo "<option value='1'>TOKEN Ditampilkan</option>";	 
					?>
				</select></td>
		</tr>
	</table>
	<br>
        <p>	<button type="button" class="btn btn-info btn-small" id="kirim<?php echo $s['Urutan']; ?>"> Rilis Token </i>
			</button><a href="?modul=daftar_tesbaru">
            <button type="button" class="btn btn-default" data-dismiss="modal" >Kembali
			</button></a>	
		</p>

       
       <div style="background-color:#f2f1e8; padding:5px;"> 
       <p><b><font color="#cd0202">* PERHATIAN </font></b></p>
	    <font color="#2D5405"><p>- Pada <b>Mode Soal PDF </b>form template soal hanya perlu isi kunci jawaban, soal dan jawaban tidak boleh diacak</p>
		<p>- Penggunaan<b> Soal PDF </b>belum didukung untuk Android dan masih terbatas untuk desktop/laptop saja.</p>
		<p>- File PDF harus diupload ke folder "file-pdf", - Hindari penggunaan nama yang panjang dan SPASI</p>
		<p>- Pastikan pada Komputer Klien telah diinstall PDF Reader.
       <p>- <b>Peserta dianggap terlambat </b>apabila ada dua jawal bersamaan, - Jika waktu buka lebih pendek dari durasi ujian</p>
       <p>- Dinyatakan terlambat bila login dilakukan setelah waktu Ujian ditutup</p></font>
       </div>

     
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
</div>
</div>
</body>
</html>
