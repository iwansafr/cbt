<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

</head>

<body>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#gambar">Gambar</a></li>
  <li><a data-toggle="tab" href="#audio">Audio</a></li>
  <li><a data-toggle="tab" href="#video">Video</a></li>
  <li><a data-toggle="tab" href="#pdf">PDF</a></li>
</ul>

<div class="tab-content">
	<div id="gambar" class="tab-pane fade in active">
		<h3>Gambar</h3><p><?php include "daftar_gambar.php";?></p>
	</div>
	<div id="audio" class="tab-pane fade">
		<h3>Audio</h3><p><?php include "daftar_audio.php";?></p>
	</div>
	<div id="video" class="tab-pane fade">
		<h3>Video</h3><p><?php include "daftar_video.php";?></p>
	</div>
	<div id="pdf" class="tab-pane fade">
		<h3>PDF</h3><p><?php include "daftar_pdf.php";?></p>
	</div>
</div>
</body>
</html>
