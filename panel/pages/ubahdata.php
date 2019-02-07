<?php
include "../../config/server.php";

$sekolah=addslashes($_REQUEST['txt_nama']);
$sql = mysqli_query($sqlconn,"update cbt_admin set 
XSekolah = '$sekolah',
XTingkat = '$_REQUEST[txt_ting]',
XAlamat = '$_REQUEST[txt_alam]',
XProp = '$_REQUEST[txt_prop]',
XKab = '$_REQUEST[txt_kab]',
XKec = '$_REQUEST[txt_kec]',
XTelp = '$_REQUEST[txt_telp]',
XFax = '$_REQUEST[txt_facs]',
XEmail = '$_REQUEST[txt_emai]',
XWeb = '$_REQUEST[txt_webs]',
XAdmin = '$_REQUEST[txt_adm]',
XWarna = '$_REQUEST[txt_col]',
XKodeSekolah = '$_REQUEST[txt_kode]',
XNIPKepsek = '$_REQUEST[txt_nip1]',
XNIPAdmin = '$_REQUEST[txt_nip2]',
XKepSek = '$_REQUEST[txt_ip]',
XH1 = '$_REQUEST[txt_h1]',
XH2 = '$_REQUEST[txt_h2]',
XH3 = '$_REQUEST[txt_h3]'

");



$sql5 = mysqli_query($sqlconn,"select * from cbt_server");
$xadm5 = mysqli_fetch_array($sql5);
$xserver= $xadm5['XServer'];

if ($xserver=="pusat"){
$sql = mysqli_query($sqlconn,"update server_pusat set 
XSekolah = '$sekolah',
XServerId = '$_REQUEST[txt_kode]'");
}
echo "Ubah data berhasil !"; 
?>