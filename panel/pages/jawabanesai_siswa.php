<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<style>
.left { float: left; width: 75%;}
.right {float: right;width: 23%;}
.group:after {content:"";display: table; clear: both;}
img {max-width: 100%; height: auto;}
@media screen and (max-width: 480px) {.left,.right {float: none;width: auto;margin-top:10px;}}
</style>
<script type="text/javascript" src="./js/jquery.gdocsviewer.min.js"></script> 
   <link href="css/nedna.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./js/jquery.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  
  <script type="text/javascript"  src="../../mesin/MathJax/MathJax.js?config=AM_HTMLorMML-full"></script>

<!-- script untuk refresh/reload mathjax setiap content baru !-->
   <script>
  MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
</script>
<!-- script untuk refresh/reload mathjax setiap content baru !-->
<iframe src="<?php echo "print_jawaban_esai.php?soal=$_REQUEST[soal]&siswa=$_REQUEST[siswa]"; ?>" style="display:none;" name="frame"></iframe>

<a href=?modul=analisajawaban&soal=<?php echo $_REQUEST['soal']; ?>>
<button type="button" class="btn btn-default btn-small" style="margin-top:5px; margin-bottom:5px"><i class="fa fa-arrow-circle-left"></i> Kembali ke Daftar</i></button></a>
<button type="button" class="btn btn-success btn-small" onClick="frames['frame'].print()" style="margin-top:5px; margin-bottom:5px"><i class="glyphicon glyphicon-print"></i> Cetak Hasil Ujian
</button>

<body style="width:90%; margin:0 auto;margin-top:50px; ">

<br />
<?php include "../../config/server.php";

 $hasil = mysqli_query($sqlconn,"SELECT *,u.XStatusUjian as ujsta FROM cbt_siswa s
LEFT JOIN cbt_siswa_ujian u ON u.XNomerUjian = s.XNomerUjian
LEFT JOIN cbt_ujian c ON (u.XKodeSoal = c.XKodeSoal and u.XTokenUjian = c.XTokenUjian)
LEFT JOIN cbt_paketsoal p ON (u.XKodeSoal = c.XKodeSoal and u.XTokenUjian = c.XTokenUjian)
WHERE c.XKodeSoal = '$_REQUEST[soal]' and p.XKodeSoal = '$_REQUEST[soal]' and u.XNomerUjian = '$_REQUEST[siswa]'
and c.XTokenUjian = '$_REQUEST[token]'");
$baris = 4;
$no = 0;	
while($p = mysqli_fetch_array($hasil)){
	$var_token = "$p[XTokenUjian]";
	$var_soal = "$p[XKodeSoal]";
	$var_mapel = "$p[XKodeMapel]";	
	$var_jumsoal = "$p[XJumSoal]";
	$var_pil = "$p[XPilGanda]";	
	$var_esai = "$p[XEsai]";	
	$per_pil = "$p[XPersenPil]";	
	$per_esai = "$p[XPersenEsai]";	
	$tglujian = "$p[XTglUjian]";		
}	
$var_siswa = "$_REQUEST[siswa]";

	$sqlujian = mysqli_query($sqlconn,"SELECT * FROM `cbt_jawaban` j left join cbt_soal s on s.XNomerSoal = j.XNomerSoal WHERE j.XKodeSoal = '$var_soal' and j.XUserJawab = '$var_siswa'
	and XTokenUjian = '$_REQUEST[token]'");
	
	$sqlmapel = mysqli_query($sqlconn,"select * from cbt_ujian c left join cbt_mapel m on m.XKodeMapel = c.XKodeMapel where c.XKodeSoal = '$var_soal'"); 
	$u = mysqli_fetch_array($sqlmapel);
	$namamapel = $u['XNamaMapel'];
	$kodemapel = $u['XKodeMapel'];
	
	$sqlsiswa = mysqli_query($sqlconn,"SELECT * FROM `cbt_siswa` WHERE XNomerUjian= '$var_siswa'");
	$s = mysqli_fetch_array($sqlsiswa);
	$namsis = $s['XNamaSiswa'];
	$namkel = $s['XNamaKelas'];
	$namjur = $s['XKodeJurusan'];
	$grup = "$s[XKodeKelas] - $s[XKodeJurusan]";
	$nomsis = $s['XNIK'];

$no = $no +1;

	$sqldijawab = mysqli_num_rows(mysqli_query($sqlconn," SELECT * FROM `cbt_jawaban` WHERE XKodeSoal = '$var_soal' and XUserJawab = '$var_siswa' and XJawaban != '' and XTokenUjian = '$var_token'"));

$sqljumlah = mysqli_query($sqlconn,"select sum(XNilaiEsai) as hasil from cbt_jawaban where XKodeSoal = '$var_soal' and XUserJawab = '$var_siswa' and XTokenUjian = '$var_token'");
$o = mysqli_fetch_array($sqljumlah);

$nilai_esai = round($o['hasil'],2);
	
$sqljawaban = mysqli_query($sqlconn,"SELECT count( XNilai ) AS HasilUjian FROM `cbt_jawaban` WHERE XKodeSoal = '$var_soal' and XUserJawab = '$_REQUEST[siswa]' and XNilai = '1' and XTokenUjian = '$var_token'");
	$sqj = mysqli_fetch_array($sqljawaban);
	$jumbenar = $sqj['HasilUjian'];
	$hasil_pil = $jumbenar;	
	$nilai_pil = round((($jumbenar/$var_pil)*$per_pil),2);		
	$total_pil = $nilai_pil;	
	$tot_pil = number_format($total_pil,2,',','.');	

$sqljawaban = mysqli_query($sqlconn,"SELECT sum( XNilaiEsai ) AS HasilEsai FROM `cbt_jawaban` WHERE XKodeSoal = '$var_soal' and XUserJawab = '$_REQUEST[siswa]' and XJenisSoal = '2' and XTokenUjian = '$var_token'");
	$sqj = mysqli_fetch_array($sqljawaban);
	if($var_esai<1){$total_esai = 0; $hasil_esai = 0; $nilai_esai = 0;} else {
	$hasil_esai = $sqj['HasilEsai'];
	$nilai_esai = round(($hasil_esai*($per_esai/100)),2);	
	//$total_esai = round(($nilai_esai/$per_esai)*100,2);	
	$total_esai = $nilai_esai;	
	$tot_esai = round($nilai_esai,2);	
	}

	$total_nilai = number_format(($total_pil+$total_esai),2,',','.');
	

$var_soal = "$_REQUEST[soal]";
$var_siswa = "$_REQUEST[siswa]";

//Soal Pilihan Ganda
$sqlsoal = mysqli_num_rows(mysqli_query($sqlconn,"select * from cbt_soal where XKodeSoal = '$var_soal' and XJenisSoal = '1'")); 
$sqltampil = mysqli_query($sqlconn,"select * from cbt_ujian where XKodeSoal = '$var_soal'"); 
$t1 = mysqli_fetch_array($sqltampil);
$t = $t1['XPilGanda'];

$sqlbenar = mysqli_query($sqlconn,"select * from cbt_nilai where XKodeSoal = '$var_soal' and XNomerUjian = '$var_siswa' and XTokenUjian = '$var_token'"); 
$b1 = mysqli_fetch_array($sqlbenar);
$b = $b1['XBenar'];

if($t > $sqlsoal){$jumsoal = $sqlsoal;} else {$jumsoal = $t;}
$nilai = ($b/$jumsoal)*100;
$nilaine = number_format($nilai, 2, ',', '.');

$xtokenujian = $var_token;
$sqlujian = mysqli_query($sqlconn,"select * from cbt_ujian c left join cbt_mapel m on m.XKodeMapel = c.XKodeMapel where c.XKodeSoal = '$var_soal' and c.XTokenUjian = '$var_token'"); 
$u = mysqli_fetch_array($sqlujian);
$namamapel = $u['XNamaMapel'];
$kodeujian = $u['XKodeUjian'];

if($kodeujian == "UH"){ $kodeujian = "Harian";} 
elseif($kodeujian == "UTS"){ $kodeujian = "UTS";} 
elseif($kodeujian == "UAS"){ $kodeujian = "UAS";} 
else {$kodeujian = "TRY OUT";}
//$xtokenujian = $u['XTokenUjian'];

$nom = 1;			
$betul = 0;					

$sqljur = mysqli_query($sqlconn,"SELECT * FROM `cbt_siswa` WHERE XNomerUjian= '$var_siswa' ");
$sjur = mysqli_fetch_array($sqljur);
$kojur = $sjur['XKodeJurusan'];

$sqlsiswa = mysqli_query($sqlconn,"SELECT * FROM `cbt_siswa` s left join cbt_kelas k on k.XKodeKelas = s.XKodeKelas WHERE XNomerUjian= '$var_siswa'");
$s = mysqli_fetch_array($sqlsiswa);
$namsis = $s['XNamaSiswa'];
$kokel = $s['XKodeKelas'];
$nomsis = $s['XNIK'];
$namjur = $s['XKodeJurusan'];
$fotsis = $s['XFoto'];
$var_sesi = $s['XSesi'];
	
if(str_replace(" ","",$fotsis)==""){
$foto = "nouser.png";} else { $foto = "$fotsis";}

$sqlad = mysqli_query($sqlconn,"select * from cbt_admin");
$ad = mysqli_fetch_array($sqlad);
$tingkat=$ad['XTingkat'];
if ($tingkat=="MA" or $tingkat=="SMA" or $tingkat=="SMK"  ){$rombel="Jurusan";}else{$rombel="Rombel";}

?>
<div class="group">
    <div >
             <div class="panel panel-default">
                                          <div class="panel-heading">
                                           <h3 class="panel-title">Data Peserta Ujian : </h3>
                                          </div>
                                          <div class="panel-body">
                                            <table border="0" width="100%">                              
                                             <tr>
              <td rowspan="6" width="150px"><img src="../../fotosiswa/<?php echo $foto; ?>" width="60%" /></td></td>
                <td width="30%">Nomer Ujian </td><td width="40%">: <?php echo "$var_siswa ($xtokenujian | Sesi $var_sesi)"; ?></td>
                
              </tr>
                                                <tr><td>Nomer Induk Siswa(NIS)</td><td>: <?php echo $nomsis; ?></td></tr>
                                                <tr><td>Nama Lengkap </td><td>: <?php echo $namsis; ?></td></tr>
                                                <tr><td>Kelas - <?php echo $rombel; ?> </td><td>: <?php echo "$kokel-$kojur | $namkel"; ?></td></tr>
                                                <tr><td>Mata Pelajaran</td><td>: <?php echo $namamapel; ?></td></tr>
                                                <tr><td>Tgl Pelaksanaan</td><td>: <?php echo $tglujian; ?></td></tr>                                                
                                            </table>    
                                          </div>
            </div>
     </div>
      <div >
				 
      					<div class="panel panel-default">
      									  <div class="panel-body">
                                           <h3 class="panel-title"><?php echo "Ujian : $kodeujian"; ?></h3>
                                          </div>
                         </div>


	  </div>
     
</div>

<link href="../../mesin/css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../mesin/lib/jquery.min.js"></script>
<script type="text/javascript" src="../../mesin/dist/jplayer/jquery.jplayer.min.js"></script>

<div class="panel-body">
<table>
<?php
$nomer = 1;
$sql = mysqli_query($sqlconn,"
SELECT * FROM `cbt_jawaban` j left join cbt_soal s on s.XNomerSoal = j.XNomerSoal 
left join cbt_ujian u on (u.XKodeSoal = s.XKodeSoal and u.XTokenUjian = j.XTokenUjian)
WHERE j.XKodeSoal = '$var_soal' and  s.XKodeSoal = '$var_soal' and  j.XUserJawab = '$var_siswa' 
and j.XJenisSoal = '2' and j.XTokenUjian = '$xtokenujian' order by j.Urut");

while($r = mysqli_fetch_array($sql)){
$jumpil = $r['XJumPilihan'];
$nosoal = $r['XNomerSoal'];
$nil = $r['XNilaiEsai'];

echo "<tr><td width=50px>$nomer.</td><td>$r[XTanya] </td></tr>
<tr><td width=50px colspan=2>&nbsp;</td></tr>
";

if(str_replace("  ","",$r['XGambarTanya']!=="")){
echo "
<tr><td width=30px colspan=2>&nbsp; </td></tr>
<tr><td colspan=2><img src=../../pictures/$r[XGambarTanya] width=150px></td></tr>";}
echo "<tr><td width=50px colspan=2>&nbsp;</td></tr>";

$jawab = $r['XJawabanEsai'];
echo "
<tr><td width=30px colspan=2><b>Jawaban : </b></td></tr>
<tr><td colspan=2>$jawab</td></tr>

";	

echo "</td></tr><tr><td colspan=2><hr></td></tr>";



$nomer++;


}
?>    </div>
    </div>
</table>                              
	</div>                           
    </div>



</body>
</html>

