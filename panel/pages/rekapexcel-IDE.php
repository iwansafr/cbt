<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
include "../../config/server.php";	

//echo "SELECT * from cbt_ujian WHERE XKodeSoal = '$_REQUEST[soal]'";

				
$sqlujian = mysqli_query($sqlconn,"SELECT * from cbt_ujian WHERE XKodeSoal = '$_REQUEST[soal]'");
while($t = mysqli_fetch_array($sqlujian)){

$txt_kelas = $t['XKodeKelas'];
$txt_jurusan = $t['XKodeJurusan'];
$var_mapel = $t['XKodeMapel'];
$var_soal = $t['XKodeSoal'];
$var_jumsoal = $t['XJumSoal'];
$var_token = $t['XTokenUjian'];

}

if($txt_kelas == 'ALL' && $txt_jurusan == 'ALL'){
$h = "SELECT * FROM cbt_siswa "; }
elseif($txt_kelas == 'ALL' && $txt_jurusan !== 'ALL'){
$h = "SELECT * FROM cbt_siswa where XKodeJurusan = '$txt_jurusan'"; }
elseif( $txt_kelas !== 'ALL' && $txt_jurusan == 'ALL'){
$h = "SELECT * FROM cbt_siswa where XKodeKelas = '$txt_kelas'"; 
} else {
$h = "SELECT * FROM cbt_siswa where XKodeKelas = '$txt_kelas'";
}

echo "$txt_kelas == 'ALL' && $txt_jurusan == 'ALL'";

	$sqlpaket = mysqli_query($sqlconn,"select * from cbt_paketsoal p LEFT JOIN cbt_mapel m on m.XKodeMapel=p.XKodeMapel where p.XKodeSoal = '$var_soal'"); 	
	$p1 = mysqli_fetch_array($sqlpaket);
	$per_pil = $p1['XPersenPil'];
	$per_esai = $p1['XPersenEsai'];	
	$var_pil = $p1['XPilGanda'];	
	$var_esai = $p1['XEsai'];		
	$namamapel = $p1['XNamaMapel'];	

$hasil = mysqli_query($sqlconn,$h);
$baris = 4;
$no = 1;	
echo "<table><tr><th>Nomer Ujian</th><th>Name Peserta</th><th>Kelas</th><th>Jurusan</th><th>Jawab</th><th>Benar</th><th>Pilihan Ganda</th>
<th>Esai</th><th>Total Pilihan Ganda</th><th>Total Nilai Esai</th><th>Nilai Total</th><th>Token</th></tr>";
while($p = mysqli_fetch_array($hasil)){

$var_siswa = $p['XNomerUjian'];
$var_sesi = $p['XSesi'];

//ambil nilai esai masing2 siswa
$sqljumlah = mysqli_query($sqlconn,"select sum(XNilaiEsai) as hasil from cbt_jawaban where XKodeSoal = '$var_soal' and XUserJawab = '$var_siswa' and XTokenUjian = '$var_token'");
$o = mysqli_fetch_array($sqljumlah);
$nilai_esai = $o['hasil'];


$sqldijawab = mysqli_num_rows(mysqli_query($sqlconn,"SELECT * FROM `cbt_jawaban` WHERE XKodeSoal = '$var_soal' and XUserJawab = '$var_siswa' and XJawaban != ''"));
	$sqljawaban = mysqli_query($sqlconn," SELECT count( XNilai ) AS HasilUjian,XTokenUjian FROM `cbt_jawaban` WHERE XKodeSoal = '$var_soal' and XUserJawab = '$var_siswa' and XNilai = 
	'1' ");
	$sqj = mysqli_fetch_array($sqljawaban);
	$tokenujian = $sqj['XTokenUjian'];
	$jumbenar = $sqj['HasilUjian'];
	$nilai_pil = ($jumbenar/$var_pil)*100;	
	$total_pil = $nilai_pil*($per_pil/100);	
	$total_esai = $nilai_esai*($per_esai/100);	
	$total_nilai = $total_pil+$total_esai;	

// Miscellaneous glyphs, UTF-8
/*$objPHPExcel->setActiveSheetIndex(0)
            //->setCellValue('A4', 'Miscellaneous glyphs')
            //->setCellValue('A5', 'sfdsdf');
			->setCellValue("A$baris", $no)
			->setCellValue("B$baris", "$p[XNomerUjian]")
			->setCellValue("C$baris", "$var_sesi")			
			->setCellValue("D$baris", "$p[XNamaSiswa]")
			->setCellValue("E$baris", "$p[XKodeKelas]")
			->setCellValue("F$baris", "$p[XKodeJurusan]")
			->setCellValue("G$baris", "$namamapel")
			->setCellValue("H$baris", "$sqldijawab")
			->setCellValue("I$baris", "$jumbenar")
			->setCellValue("J$baris", "$nilai_esai")			
			->setCellValue("K$baris", "$total_pil")			
			->setCellValue("L$baris", "$total_esai")			
			->setCellValue("M$baris", "$total_nilai")
			->setCellValue("N$baris", "$var_token");			
*/			
	$no = $no +1;			
	$baris = $baris + 1;


echo "<tr>
<td>$p[XNomerUjian]</td><td>$p[XNamaSiswa]</td><td>$p[XKodeKelas]</td><td>$p[XKodeJurusan]</td>
<td>$sqldijawab</td><td>$jumbenar</td><td>$nilai_pil</td><td>$nilai_esai</td><td>$total_pil</td><td>$total_esai</td>
<td>$total_nilai</td><td>$tokenujian</td>
</tr>";



}
echo "</table>";


// Rename worksheet
//$objPHPExcel->getActiveSheet()->setTitle($namamapel);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
//$objPHPExcel->setActiveSheetIndex(0);




 ?>
