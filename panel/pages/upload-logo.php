<?php
include "../../config/server.php";
$uploaddir = '../../images/'; 
$namafile = basename($_FILES['uploadfile5']['name']);
$file = $uploaddir . basename($_FILES['uploadfile5']['name']); 
 if (move_uploaded_file($_FILES['uploadfile5']['tmp_name'], $file)) { 
$sql = mysqli_query($sqlconn,"update cbt_admin set XLogo = '$namafile'");
  echo "success"; 
} else {
//	echo "error";
}

?>