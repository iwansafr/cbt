
<?php
include "../../config/server.php";
$userid=$_COOKIE['beeuser'];
$users=$_REQUEST[photo];
$nfoto="photo/".$userid.".jpg";
$nfhoto=$userid.".jpg";

$sql = mysqli_query($sqlconn,"update cbt_user set Xpoto = '$nfhoto' WHERE Username='$_COOKIE[beeuser]'");
$namafile = basename($_FILES['uploadfile']['name']);
$file = $uploaddir . basename($_FILES['uploadfile']['name']); 
 if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 
 
	rename ($file, $nfoto);
  echo "success"; 
} else {
	echo "error";
}

?>