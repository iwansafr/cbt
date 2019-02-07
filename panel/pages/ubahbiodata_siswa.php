<?php
include "../../config/server.php";

if($_COOKIE['beelogin']=="guru"){
			
	$sql = mysqli_query($sqlconn,"update cbt_user set
	Username = '$_REQUEST[txt_user]',
	Nama = '$_REQUEST[txt_nama]',
	NIP = '$_REQUEST[txt_nip]',
	Alamat = '$_REQUEST[txt_alamat]',
	HP = '$_REQUEST[txt_telp]',
	Faxs = '$_REQUEST[txt_facs]',
	Email = '$_REQUEST[txt_email]'
	WHERE Username='$_COOKIE[beeuser]'");

	
}else{
		
	$sql = mysqli_query($sqlconn,"update cbt_siswa set 
	XNamaSiswa = '$_REQUEST[txt_namasiswa]',
	XAgama= '$_REQUEST[txt_agama]',
	XPilihan = '$_REQUEST[txt_pilihan]',
	XJenisKelamin = '$_REQUEST[txt_kelamin]',
	XNIK = '$_REQUEST[txt_nik]'
	WHERE XNomerUjian='$_COOKIE[beeuser]'");
	}




echo "Ubah data berhasil !"; 
?>