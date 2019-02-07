<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<?php
include "../../config/server.php";
$uploaddir = 'images/'; 
$nfoto1="images/headerlogin.png";

$namafile4 = basename($_FILES['uploadfile4']['name']);
$file4 = $uploaddir . basename($_FILES['uploadfile4']['name']); 
 if (move_uploaded_file($_FILES['uploadfile4']['tmp_name'], $file4)) { 
 
	rename ($file4, $nfoto1);
  echo "success"; 
} else {
	echo "error";
}

?>