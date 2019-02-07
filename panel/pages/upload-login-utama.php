<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}

include "../../config/server.php";
$uploaddir = '../../images/'; 


$namafile4 = basename($_FILES['uploadfile4']['name']);
$file4 = $uploaddir . basename($_FILES['uploadfile4']['name']); 
 if (move_uploaded_file($_FILES['uploadfile4']['tmp_name'], $file4)) { 
$sql = mysqli_query($sqlconn,"update cbt_admin set XLoginUtama = '$namafile4'");
  echo "success"; 
} else {
	echo "error";
}
