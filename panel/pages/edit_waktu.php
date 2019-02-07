<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}

include "../../config/server.php";
    if($_REQUEST['urut']) {
        $id = $_POST['urut'];
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = mysqli_query($sqlconn,"SELECT * FROM cbt_ujian WHERE Urut = '$id'");
        $r = mysqli_fetch_array($sql);
		$nilai = $r['XTampil'];
		if ($nilai=='1') {$t="Tampil";}else{$t="Tidak";}
		$statustoken = $r['XStatusToken'];
		if ($statustoken=='1') {$tt="Tampil";}else{$tt="Tidak";}
		$statusujian = $r['XStatusUjian'];
		if ($statusujian=='1') {$tu="Sedang ujian";}else{$tu="Selesai Ujian";}
		$xpdf = $r['XPdf'];
		if ($xpdf=='1') {$pdf="Soal PDF";}else{$pdf="Bukan PDF";}
		$listen = $r['XListening'];
		if ($listen=='1') {$listenx="Sekali";}elseif($listen=='2'){$listenx="Dua Kali";}elseif($listen=='3'){$listenx="Terusan";}
        ?>
 
        <!-- MEMBUAT FORM -->
        <form action="?modul=daftar_waktu&simpan=yes" method="post">
            <input type="hidden" name="id" value="<?php echo $r['Urut']; ?>">
			<div class="form-group"><button class="btn btn-primary" type="submit">Update</button>&nbsp; &nbsp;<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button></div>
			
			<table width="100%" border="0" >
			<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>&nbsp;&nbsp;<td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>&nbsp;&nbsp;<td>
			</tr>
			<tr><td><b>KODE SOAL<td>:&nbsp;&nbsp;<td>
					<input type="text" class="form-control" name="txt_kodsoal" value="<?php echo $r['XKodeSoal']; ?>">
				<td> <b>&nbsp;&nbsp;LISTENING<td>:<td>
						<select class="form-control" name="txt_listen" id="txt_listen"> 
                            <option value="1" <?php if ($listen==1){echo "selected";}?>>Sekali</option>
                            <option value="2" <?php if ($listen==2){echo "selected";}?>>Dua Kali</option>  
                            <option value="3" <?php if ($listen==3){echo "selected";}?>>Terusan</option>
                        </select>
				</td>
			</tr>
			<tr><td><b>SOAL PDF <td>:<td>
					<select class="form-control" name="txt_xpdf" id="txt_xpdf"> 
                            <option value="1" <?php if ($xpdf==1){echo "selected";}?>>Soal PDF</option>
                            <option value="0" <?php if ($xpdf==0){echo "selected";}?>>Bukan PDF</option>  
                        </select>
				<td> <b>&nbsp;&nbsp;NILAI <td>:<td>
						<select class="form-control" name="txt_hasil" id="txt_hasil"> 
                            <option value="1" <?php if ($nilai==1){echo "selected";}?>>Tampil</option>
                            <option value="0" <?php if ($nilai==0){echo "selected";}?>>Tidak</option>  
                        </select></td>
			</tr>
		<tr><td><b>File PDF<td>:<td>
					<input type="text" class="form-control" name="txt_filepdf" value="<?php echo $r['XFilePdf']; ?>">
				<td> <b>&nbsp;&nbsp;TOKEN <td>: &nbsp;<td>
					<select class="form-control" name="txt_statustoken" id="txt_statustoken">    
                            <option value="1" <?php if ($statustoken==1){echo "selected";}?>>Tampil</option>
                            <option value="0" <?php if ($statustoken==0){echo "selected";}?>>Tidak</option>   
                        </select>	
				</td>
			</tr>
		<tr><td><b>STATUS<td>:<td>
					<select class="form-control" name="txt_suji" id="txt_suji"> 
                            <option value="1" <?php if ($statusujian==1){echo "selected";}?>>Sedang Ujian</option>
                            <option value="9" <?php if ($statusujian==9){echo "selected";}?>>Selesai Ujian</option>  
                            
                        </select>
				<td> <b>&nbsp;&nbsp;KODE KELAS&nbsp;&nbsp;<td>:<td>
						 <input type="text" class="form-control" name="txt_kodkel" value="<?php echo $r['XKodeKelas']; ?>">
				</td>
			</tr>
   <tr><td><b>SESI<td>:<td>
					 <input type="text" class="form-control" name="txt_sesi" value="<?php echo $r['XSesi']; ?>">
				<td><b> &nbsp;&nbsp;<?php echo $rombel; ?><td>:<td>
						  <input type="text" class="form-control" name="txt_jur" value="<?php echo $r['XKodeJurusan']; ?>">
				</td>
			</tr>
			<tr><td><b>UJIAN<td>:<td>
					<input type="text" class="form-control" name="txt_koduji" value="<?php echo $r['XKodeUjian']; ?>">
				<td> <b>&nbsp;&nbsp;TOKEN<td>:<td>
						<input type="text" class="form-control" name="txt_token" value="<?php echo $r['XTokenUjian']; ?>">
				</td>
			</tr>
			<tr><td><b>TGL UJIAN<td>:<td>
					 <input type="text" class="form-control" name="txt_tuji" value="<?php echo $r['XTglUjian']; ?>">
				<td> <b>&nbsp;&nbsp;JAM MULAI<td>:<td>
						  <input type="text" class="form-control" name="txt_juji" value="<?php echo $r['XJamUjian']; ?>">
				</td>
			</tr>
			
			<tr><td><b>DURASI<td>:<td>
					 <input type="text" class="form-control" name="txt_durasi" value="<?php echo $r['XLamaUjian']; ?>">
				<td><b> &nbsp;&nbsp;JAM TUTUP<td>:<td>
					  <input type="text" class="form-control" name="txt_bmasuk" value="<?php echo $r['XBatasMasuk']; ?>">	
				</td>
			</tr>

			
              
            
			  </table>
        </form>
   
                
         
           
			
        <?php } ?>