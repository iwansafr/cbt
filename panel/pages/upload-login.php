<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<?php
include "../../config/server.php";
$uploaddir = 'images/'; 

$namafile3 = basename($_FILES['uploadfile3']['name']);
$file3 = $uploaddir . basename($_FILES['uploadfile3']['name']); 
 if (move_uploaded_file($_FILES['uploadfile3']['tmp_name'], $file3)) { 
$sql = mysqli_query($sqlconn,"update cbt_admin set XLogin = '$namafile3'"); 
	
  echo "success"; 
} else {
	echo "error";
}

?>