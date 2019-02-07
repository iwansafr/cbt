<?php ob_start();
 include "../../config/server.php";
 mysqli_query($sqlconn,"delete from cbt_ujian where Urut='$_GET[urut]'");
 header('location:index.php');
?>