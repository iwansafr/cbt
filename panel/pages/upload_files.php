<?php 
//session_start();
//$session_id='1'; //$session id
?>
<html>
<head>
<title>BeeSMART-CBT | UPLOAD</title>
</head>

<script src="js/jquery.min.js"></script>
<script src="js/jquery.wallform.js"></script>
<script>
var $jnoc = jQuery.noConflict(); 
 $jnoc(document).ready(function() { 
		
            $jnoc('#photoimg').die('click').live('change', function()			{ 
			           //$("#preview").html('');
			    
				$jnoc("#imageform").ajaxForm({target: '#preview', 
				     beforeSubmit:function(){ 
					
					console.log('ttest');
					$jnoc("#imageloadstatus").show();
					$jnoc("#imageloadbutton").hide();
					 }, 
					success:function(){ 
				    console.log('test');
					 $jnoc("#imageloadstatus").hide();
					 $jnoc("#imageloadbutton").show();
					}, 
					error:function(){ 
					console.log('xtest');
					$jnoc("#imageloadstatus").hide();
					$jnoc("#imageloadbutton").show();
					} }).submit();
					
		
			});
        }); 
</script>

<style>

body
{
font-family:arial;
}

#preview
{
color:#cc0000;
font-size:12px
}
.imgList 
{
max-height:150px;
margin-left:5px;
border:1px solid #dedede;
padding:4px;	
float:left;	
}

</style>
<body>

<div class="row">
<div class="panel panel-default panel-small" style="margin-top:20px; width:95%">
                        <div class="panel-heading" >
                        <b>Upload File-File Pendukung Soal</b>
						</div>
    <div class="panel-body">       

<form id="imageform" method="post" enctype="multipart/form-data" action='upload_file_proses.php' style="clear:both">
		<div class="alert alert-danger"  id="ndelik" style="width:100%">
        <ul>
        	<li>Pastikan File PHP.ini sudah di Set (upload_max_filesize=3000M, post_max_size = 3000M) !!!!</li>
        	<li>Pergunakan huruf dan angkat (A-Z, a-z, 0-9) untuk Nama File </li>            
        	<li>Tidak boleh memakai Spasi</li>                        
        </ul>
        </div>

        Upload File pendukung soal adalah proses pengcopyan file-file pendukung ke dalam Server, proses ini berpengaruh pada sinkronsisasi server sekolah ke server pusat. 
		Data file pendukung akan terbentuk hanya bila pengcopyan file ke folder melalui proses Uploading.
	<br>File-file pendukung akan dicopy ke dalam folder-folder pendukung, Extensi File yang suport adalah: <br><br>
        <div style="width: 15%; float:left">
		<ul><li> mp3, wav </li>
        <li> mp4, avi  </li>
        <li> jpg, png, gif </li>
		 <li> pdf </li>
        </ul>
		</div>
		<div style="width: 85%; float:right">
		=>: ke folder .../../audio/ 
        <br> =>: ke folder .../../video/ 
        <br> =>: ke folder .../../pictures/ 
		<br> =>: ke folder .../../file-pdf/ 
        </ul>
		</div></div>
		<br></div>
         oO <b>Pilih File-File yang akan diUpload</b> Oo 
		<br>-------------------------------------------------------
 
<div id='imageloadstatus' style='display:none'><img src="../../images/loader1.gif" alt="Uploading...."/></div>
<div id='imageloadbutton'>
<input type="file" name="photos[]" id="photoimg" multiple="true" />
</div> <br>
</form><br>
<div id='preview'></div>
	</div>
	</div>
</div>
</div>
</body>
</html>