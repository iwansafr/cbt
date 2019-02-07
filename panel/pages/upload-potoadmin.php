
<?php
include "../../config/server.php";
$sql2 = mysqli_query($sqlconn,"select * from cbt_siswa WHERE XNomerUjian='$_COOKIE[beeuser]'");
$sis = mysqli_fetch_array($sql2);
$userid = $sis['XNamaSiswa'];
//$userid=$_COOKIE['beeuser'];
$users=$_REQUEST[photo];
$nfoto="../../fotosiswa/".$userid.".jpg";
$nfhoto=$userid.".jpg";

$sql = mysqli_query($sqlconn,"update cbt_siswa set XFoto = '$nfhoto' WHERE XNomerUjian='$_COOKIE[beeuser]'");
$namafile1 = basename($_FILES['uploadfile1']['name']);
$file1 = $uploaddir . basename($_FILES['uploadfile1']['name']); 
 if (move_uploaded_file($_FILES['uploadfile1']['tmp_name'], $file)) { 
 
	rename ($file1, $nfoto);
  echo "success"; 
} else {
	echo "error";
}

?>