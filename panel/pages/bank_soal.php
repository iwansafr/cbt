<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}

if(isset($_REQUEST['aksi'])&&$_REQUEST['aksi']=="simpan"){
$sss= str_replace("'","\'",$_REQUEST['tanyasoal']);
	$sql0 = mysqli_query($sqlconn,"update cbt_soal set XTanya = '$sss' where XKodeSoal = '$_REQUEST[soal]' and Urut = '$_REQUEST[nom]'");
	
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

	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
 
</head>

<script type="text/javascript" src="./js/jquery-1.4.js"></script>
<script>    
$(document).ready(function(){
	$("#txt_durasi").change(function(){
		var txt_durasi = $("#txt_durasi").val();
		$.ajax({
			url: "ambil_token.php",
			data: "txt_ujian="+txt_durasi,
			cache: false,
			success: function(msg){$("#txt_token").val(msg);}
		});
	});

	$("#kirim").click(function(){
		var ed = tinyMCE.get('tanyasoal');
		ed.setProgressState(1); // Show progress
		window.setTimeout(function() {
			ed.setProgressState(0); // Hide progress
		}, 2000);

		var a = tinymce.get('tanyasoal').getContent();
		var b6 = $("#gambar").val();
		var b7 = $("#audio").val();
		var b8 = $("#video").val();
		var c = $("#nom").val();
		var d = $("#soal").val();
		var e = $('input[name=radio1]:checked').val();
		var f = $("#map").val();
		var i = $("#txt_kate").val();
		var j = $("#txt_kes").val();
		var k = $("#txt_aca").val();
		var m = $("#txt_ag").val();
		 
		$.ajax({
			type:"POST",
			url:"simpan_soal_edit.php",    
			data: "aksi=simpan&txt_tanya=" + encodeURIComponent(a) + "&txt_gbr=" + b6  + "&txt_aud=" + b7  + "&txt_vid=" + b8 + "&txt_kunci=" + e + "&txt_soal=" + d + "&txt_nom=" + c + "&txt_mapel=" + f + "&txt_kate=" + i + "&txt_kes=" + j + "&txt_aca=" + k + "&txt_ag=" + m ,
			success: function(data){ alert("Update Soal Sukses"); }
		});
	});
});
</script> 

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="js/lc_switch.js" type="text/javascript"></script>
<link rel="stylesheet" href="js/lc_switch.css">
<script type="text/javascript">
var $jnoc = jQuery.noConflict();
          
$jnoc(document).ready(function(e) {
	$jnoc ('input').lc_switch();
	$jnoc('body').delegate('.lcs_check', 'lcs-statuschange', function() {
		var status = ($(this).is(':checked')) ? 'checked' : 'unchecked';
		console.log('field changed status: '+ status );
	});
	
	// triggered each time a field is checked
	$jnoc('body').delegate('.lcs_check', 'lcs-on', function() {
		console.log('field is checked');
	});
	
	// triggered each time a is unchecked
	$jnoc('body').delegate('.lcs_check', 'lcs-off', function() {
		console.log('field is unchecked');
	});
});
</script>

<body>
	<form  method="post"> 
		<div class="panel panel-info">
		<div class="panel-heading">Data Bank Soal (Esai) &nbsp; &nbsp; | &nbsp; &nbsp; 
			<?php echo "<a href=?modul=edit_soal&jum=$_REQUEST[jum]&soal=$_REQUEST[soal]><button type='button' class='btn btn-info'><i class='fa fa-arrow-left'></i> Kembali ke Bank Soal</button></a>"; ?>	
		</div>

		<script type="text/javascript" src="jscripts/tiny_mce/plugins/asciimath/js/ASCIIMathMLwFallback.js"></script>
		<script type="text/javascript">
			var AMTcgiloc = "http://www.imathas.com/cgi-bin/mimetex.cgi";  		//change me
			//var AMTcgiloc = "http://localhost:8090/cgi-bin/mimetex.cgi";  		//change me
		</script>

	<!-- TinyMCE -->
	<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
			mode : "textareas",
			theme : "advanced",
			theme_advanced_buttons1 : "fontselect,fontsizeselect,formatselect,bold,italic,underline,strikethrough,separator,sub,sup,separator,cut,copy,paste,undo,redo",
			theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,separator,numlist,bullist,outdent,indent,separator,forecolor,backcolor,separator,hr,link,unlink,image,media,table,code,separator,asciimath,asciimathcharmap,asciisvg",
			theme_advanced_buttons3 : "",
			theme_advanced_fonts : "Arial=arial,helvetica,sans-serif,Courier New=courier new,courier,monospace,Georgia=georgia,times new roman,times,serif,Tahoma=tahoma,arial,helvetica,sans-serif,Times=times new roman,times,serif,Verdana=verdana,arial,helvetica,sans-serif",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			plugins : 'asciimath,asciisvg,table,inlinepopups,media',
			AScgiloc : 'http://www.imathas.com/editordemo/php/svgimg.php',			      //change me  
			ASdloc : 'http://www.imathas.com/editordemo/jscripts/tiny_mce/plugins/asciisvg/js/d.svg',  //change me  	
			content_css : "./jscripts/tiny_mce/plugins/media/css/content.css"
		});
	</script><!-- /TinyMCE -->

<!-- TinyMCE 4.x -->
<!-- 
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
 
tinymce.init({
  selector: "textarea",
  
  // ===========================================
  // INCLUDE THE PLUGIN
  // ===========================================
	
  plugins: [
    "eqneditor advlist lists charmap anchor",
    "code fullscreen",
    "table contextmenu paste jbimages"
  ],
	
  // ===========================================
  // PUT PLUGIN'S BUTTON on the toolbar
  // ===========================================
	
  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
	
  // ===========================================
  // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
  // ===========================================
	
  relative_urls: false,
 forced_root_block : "", 
    force_br_newlines : true,
    force_p_newlines : false,
});
 
</script>
<!-- -->
<?php
	$sql0 = mysqli_query($sqlconn,"select * from cbt_soal where XKodeSoal= '$_REQUEST[soal]' and Urut = '$_REQUEST[nomer]'");
	$s=mysqli_fetch_array($sql0);
?>	
    <div class="panel-body">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td colspan="2"  style="font-size:18px"> &nbsp;Soal No <?php echo $_REQUEST['nomer']; ?></td>

<td align="right">
<button type="submit" class="btn btn-success btn-small" id="kirim"><i class='fa fa-save'></i> Update Soal</button>     
	<input type="hidden" id="nom" name="nom" value="<?php echo $_REQUEST['nomer']; ?>" />
    <input type="hidden" id="soal" name="soal" value="<?php echo $_REQUEST['soal']; ?>" />
    </strong></td>
  </tr>
  <tr>
<tr><td colspan="3"><hr></td></tr>
<tr><td colspan="3">
<div class="col-sm-12"><label style="width:100px; font-style:normal; font-weight:normal">Jenis Soal</label>
<input type="text" id="txt_kate" name="txt_kate" value="2" readonly size="1" style="margin-bottom:5px" >
 </div>
<div class="col-sm-12"><label style="width:100px; font-style:normal; font-weight:normal">Mapel Agama </label>
<select id="txt_ag" name="txt_ag" class="input-sm"  style="margin-bottom:5px" />
<option value="" <?php if($s['XAgama']==''){echo "selected";}?>>Mapel Umum</option>
<option value="ISLAM" <?php if($s['XAgama']=='ISLAM'){echo "selected";}?>>Agama ISLAM</option>
<option value="KRISTEN" <?php if($s['XAgama']=='KRISTEN'){echo "selected";}?>>Agama KRISTEN</option>
<option value="HINDU" <?php if($s['XAgama']=='HINDU'){echo "selected";}?>>Agama HINDU</option>
<option value="BUDA" <?php if($s['XAgama']=='BUDA'){echo "selected";}?>>Agama BUDA</option>
<option value="KONGHUCU" <?php if($s['XAgama']=='KONGHUCU'){echo "selected";}?>>Agama KONGHUCU</option>
<?php
$sqlpil = mysqli_query($sqlconn,"select * from cbt_siswa group by XPilihan");
while($xpil = mysqli_fetch_array($sqlpil)){ 
$p=$xpil['XPilihan'];?>	
<option value=<?php echo "'".$p."'"." ";  if ($s['XAgama']==$p){echo 'selected';}?>> Pilihan <?php echo $p; echo "</option>";
}?>
</select>
 </div>
<div class="col-sm-12"><label style="width:100px; font-style:normal; font-weight:normal">Tk. Kesulitan</label>
<select id="txt_kes" name="txt_kes" class="input-sm"  style="margin-bottom:5px" />
<option value="1" <?php if($s['XKategori']=='1'){echo "selected";}?>>Mudah</option>
<option value="2" <?php if($s['XKategori']=='2'){echo "selected";}?>>Sedang</option>
<option value="3" <?php if($s['XKategori']=='3'){echo "selected";}?>>Sulit</option>
</select>
 </div>
<div class="col-sm-12"><label style="width:100px; font-style:normal; font-weight:normal">Acak Soal</label>
<select id="txt_aca" name="txt_aca" class="input-sm"/>
<option value="A" <?php if($s['XAcakSoal']=='A'){echo "selected";}?>>Acak</option>
<option value="T" <?php if($s['XAcakSoal']=='T'){echo "selected";}?>>Tidak</option>
</select>
 </div>


</td>
  </tr>  
    
  
<tr><td colspan="3">&nbsp;</td></tr>    
    <td colspan="3" align="right">
    <textarea name="tanyasoal"  id="tanyasoal" style="font-size:18px; width:100%; height:300px"><?php 
	$sql0 = mysqli_query($sqlconn,"select * from cbt_soal where XKodeSoal= '$_REQUEST[soal]' and Urut = '$_REQUEST[nomer]'");
	$s=mysqli_fetch_array($sql0);
	echo "$s[XTanya]"; ?></textarea>
        <input type="hidden" id="map" name="map" value="<?php echo $s['XKodeMapel']; ?>" />
    
    </td>
  </tr>
  
<tr><td colspan="3"><hr></td></tr>
<tr bgcolor="#507db3"><td colspan="3" style="padding:10px"><font color="#FFFFFF" size="5"><b>&nbsp;File Pendukung Soal</b></font></td></tr>
<tr><td colspan="3"><hr></td></tr>  
  
<tr><td colspan="3" ><br>

<script type="text/javascript" src="js/jquery-1.3.2.js" ></script>
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<!-- <link rel="stylesheet" type="text/css" href="./styles.css" /> -->
<script type="text/javascript" >
	$(function(){
		var btnUpload=$('#upload');
		var status=$('#status');
		new AjaxUpload(btnUpload, {
			action: 'upload_gambar.php',
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
				$('#upload').html('<img src="../../pictures/'+file+'"  width="130" alt="" />').addClass('success');
				document.getElementById("gambar").value = file;
//					$('<li></li>').appendTo('#files').html('<img src="./uploads/'+file+'" alt="" /><br />'+file).addClass('success');
				} else{
					$('<li></li>').appendTo('#files').text(file).addClass('error');
				}
			}
		});
		
	});
</script>

<script type="text/javascript" >
	$(function(){
		var btnUpload2=$('#upload2');
		var status2=$('#status2');
		new AjaxUpload(btnUpload2, {
			action: 'upload_audio.php',
			name: 'uploadfile2',
			onSubmit: function(file2, ext2){
				 if (! (ext2 && /^(mp3|wav)$/.test(ext2))){ 
                    // extension is not allowed 
					status2.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				status2.text('Uploading...');
			},
			onComplete: function(file2, response2){
				//On completion clear the status
				status2.text('');
				//Add uploaded file to list
				
				if(response2==="success"){
				$('#upload2').html('<img src="images/mp3.png"  width="130" alt="" />').addClass('success');
		 		document.getElementById("audio").value = file2;		
//					$('<li></li>').appendTo('#files').html('<img src="./uploads/'+file+'" alt="" /><br />'+file).addClass('success');
				} else{
					$('<li></li>').appendTo('#files2').text(file2).addClass('error');
				}
			}
		});
		
	});
</script>

<script type="text/javascript" >
	$(function(){
		var btnUpload3=$('#upload3');
		var status3=$('#status3');
		new AjaxUpload(btnUpload3, {
			action: 'upload_video.php',
			name: 'uploadfile3',
			onSubmit: function(file3, ext3){
				 if (! (ext3 && /^(mp4|avi)$/.test(ext3))){ 
                    // extension is not allowed 
					status3.text('Upload file dengan format mp4');
					return false;
				}
				status3.text('Uploading...');
			},
			onComplete: function(file3, response3){
				//On completion clear the status
				status3.text('');
				//Add uploaded file to list
				
				if(response3==="success"){
				$('#upload3').html('<img src="images/vid.png"  width="130" alt="" />').addClass('success');
//					$('<li></li>').appendTo('#files').html('<img src="./uploads/'+file+'" alt="" /><br />'+file).addClass('success');
				var henti = document.getElementById("fileUpload");
		 		document.getElementById("video").value = file3
				} else{
					$('<li></li>').appendTo('#files3').text(file3).addClass('error');
				}
			}
		});
		
	});
</script>

<?php 
if($s['XAudioTanya']==""){$ico_audx="images/no_aud.png";$file_audx="";}else {$ico_audx="images/mp3.png";$file_audx="$s[XAudioTanya]";}
if($s['XVideoTanya']==""){$ico_vidx="images/no_vid.png";$file_vidx="";}else {$ico_vidx="images/vid.png";$file_vidx="$s[XVideoTanya]";}
if($s['XGambarTanya']==""){$ico_gbrx="images/no_pic.png";$file_gbrx="";}else {$ico_gbrx="../../pictures/$s[XGambarTanya]";$file_gbrx="$s[XGambarTanya]";}
?>
       <table cellpadding="10" width="70%" align="center" cellspacing="10">
         <tr height="40"><td align="center">Gambar Soal</td><td align="center">Audio Soal</td><td align="center">Video Soal</td></tr>
         <tr><td align="center"><br>               
         <div id="upload" style="text-align:center; padding-right:10;"><img src="<?php echo $ico_gbrx; ?>" width="130" style="margin-top:10"/></div><span id="status" ></span>
                        <ul id="files"></ul>
           				</div>
                        <?php echo $file_gbrx; ?><br>
                        <input type="text" id="gambar" name="gambar" readonly>
         </td><td align="center">   <br>            
                        <div id="upload2" style="text-align:center"><img src="<?php echo $ico_audx; ?>" width="130"/></div><span id="status2" ></span>
                        <ul id="files2"></ul>
           				</div>
                        <?php echo $file_audx; ?><br>
                        <input type="text" id="audio" name="audio" readonly>
         </td>
         
         <td align="center">  <br>             
                        <div id="upload3" style="text-align:center"><img src="<?php echo $ico_vidx; ?>" width="130"/></div><span id="status3" ></span>
                        <ul id="files3"></ul>
           				</div>
                        <?php echo $file_vidx; ?><br>
                        <input type="text" id="video" name="video" readonly>
         </td>
         </tr></table>


</td>
  </tr>

   <tr><td colspan="2">&nbsp;</td></tr>
 </table>
	</form> 
</div></div> 

                        
                        
  <!-- Button trigger modal -->
  <!-- Modal -->
                            <div class="modal fade" id="myModal<?php echo $s['XNomerUjian']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><?php echo "Peserta Ujian : $s[XNomerUjian]"; ?></h4>
                                        </div>
                                        <div class="modal-body" style="text-align:center">
                                        
                                               <?php 
												if(file_exists("../../fotosiswa/$s[XFoto]")&&!$gbr==''){ ?>
                                                <img src="../../fotosiswa/<?php echo $s['XFoto']; ?>" width="400px">
                                                <?php 
												} else {
												echo "<img src=../../fotosiswa/nouser.png>";
												}
												?>
                                       

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal --> 
                                           
<script>    
$(document).ready(function(){

});

function confirmDialog(message, onConfirm){
    var fClose = function(){
        modal.modal("hide");
    };
    var modal = $("#confirmModal");
    modal.modal("show");
    $("#confirmMessage").empty().append(message);
    $("#confirmOk").one('click', onConfirm);
    $("#confirmOk").one('click', fClose);
    $("#confirmCancel").one("click", fClose);
}

</script>
                                                     
  <!-- Modal confirm -->
<div class="modal" id="confirmModal" style="display: none; z-index: 1050;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="confirmMessage">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="confirmOk">Ok</button>
                <button type="button" class="btn btn-default" id="confirmCancel">Cancel</button>
            </div>
        </div>
    </div>
</div>
                            <!-- /.table-responsive -->
                            <div class="well">
                            <p></p>
                                
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
    
 
<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Buat Bank Soal Baru</h4>
      </div>
      <div class="modal-body">
        <?php include "buat_banksoalbaru.php";?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
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
