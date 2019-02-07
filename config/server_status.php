<?php
// 1. Connect ke database
//$sqlconn=mysqli_connect("localhost:3306","root","");
// 2. Pilih database
include "ipserver.php";
 
$link = @mysqli_connect($host_name, $user_name, $password, $database);

if(!$link){
$status_konek = "0";
}
else {
$status_konek = "1";
// mysqli_select_db($database, $link) or die('<b><span style="color: #ff0000;">SERVER tidak terhubung ke DataBase SERVER PUSAT</span><br><br>SOLUSI : <br></br>Edit koneksi database BEESMART-CBT dengan tepat</b> >> Langkah :
// <li>Klik <span style="color: #0A7BFF;">Setting Server</span> => <span style="color: #CCA600;">Setting Server Pusat</span> => ubah nama Database, Username Db dan Password dengan tepat sesuai database Server Pusat</li>
// <br><b>Edit Id/Kode Sekolah dengan tepat </b> >> Langkah :
// <li> Klik <span style="color: #0A7BFF;">Data Sekolah </span> => <span style="color: #CCA600;">Identitas Sekolah </span>=> ubah data dengan tepat sesuai data yang ada di Sever Pusat');
//echo "Koneksi Terbuka";

}


date_default_timezone_set("$zo");

//date_default_timezone_set("Asia/Jakarta");
//mysqli_select_db("beesmartv3_rev1", $sqlconn);
//tambahkan IPPublic ke Remote MySQL di CPanel hosting


?>
