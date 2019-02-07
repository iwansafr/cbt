<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}

	include "../../config/server.php";
    if($_REQUEST['urut']) {
        $id = $_POST['urut'];
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = mysqli_query($sqlconn,"SELECT * FROM cbt_siswa WHERE Urut = '$id'");
        $r = mysqli_fetch_array($sql);
		$kos=$r['XKodeSekolah'];
		$sqlad = mysqli_query($sqlconn,"select * from cbt_admin");
$ad = mysqli_fetch_array($sqlad);
$tingkat=$ad['XTingkat'];
if ($tingkat=="MA" or $tingkat=="SMA" or $tingkat=="SMK"  ){$rombel="Jurusan";}else{$rombel="Rombel";}

        ?>
 
        <!-- MEMBUAT FORM -->
<form action="?modul=daftar_siswa&simpan=yes" method="post">
            <input type="hidden" name="id" value="<?php echo $r['Urut']; ?>">
			<div class="form-group">
                <label>Kode Sekolah</label><br>
                <select class="form-control" name="txt_kodesek" id="txt_kodesek">
                                <?php
								$sqle = mysqli_query($sqlconn,"SELECT * FROM server_sekolah WHERE XServerId = '$r[XKodeSekolah]'");
								$re = mysqli_fetch_array($sqle);
								if ($kos=="ALL"){echo "<option value='ALL' selected >SEMUA / ALL</option>";}
								else {echo "<option value='$kos' selected >$kos - $re[XSekolah]</option>";}
                                $sqlsek = mysqli_query($sqlconn,"select * from server_sekolah order by XServerId");
                                while($sek = mysqli_fetch_array($sqlsek)){
                                echo "<option value='$sek[XServerId]'>$sek[XServerId] $sek[XSekolah]</option>";
                                }
                                ?>
								<option value='ALL'>SEMUA / ALL</option>
								</select>
            </div>
            <div class="form-group">
                <label>Nama Pesertas</label>
                <input type="text" class="form-control" name="txt_nam" value="<?php echo $r['XNamaSiswa']; ?>">
            </div>
            <div class="form-group">
                <label>Nomer Peserta</label>
                <input type="text" class="form-control" name="txt_nom" value="<?php echo $r['XNomerUjian']; ?>">
            </div>
            <div class="form-group">
                <table width="100%" border="0" cellpadding="5px" cellspacing="5px">
                <tr>
                <td><label>Level</label></td>
                <td>&nbsp;</td>
                <td><label>Kelas</label></td>
                <td>&nbsp;</td>
                <td><label><?php echo $rombel; ?></label></td>
                </tr>
				<tr><td>
                				<select id="txt_level"  name="txt_level" class="form-control" >
								<?php 
								echo "<option value='$r[XKodeLevel]' selected >$r[XKodeLevel]</option>";
								$sqk = mysqli_query($sqlconn,"select * from cbt_kelas group by XKodeLevel");
								while($rs = mysqli_fetch_array($sqk)){
                             	echo "<option value='$rs[XKodeLevel]' class='form-control' >$rs[XKodeLevel]</option>";} ?>                                
                                </select>     
                </td><td>&nbsp;</td><td>
                				<select id="txt_kelas"  name="txt_kelas" class="form-control" >
								<?php 
								echo "<option value='$r[XKodeKelas]' selected >$r[XKodeKelas]</option>";
								$sqk = mysqli_query($sqlconn,"select * from cbt_kelas group by XKodeKelas");
								while($rs = mysqli_fetch_array($sqk)){
                             	echo "<option value='$rs[XKodeKelas]' class='form-control' >$rs[XKodeKelas]</option>";} ?>                                
                                </select>              
                </td>
                </td><td>&nbsp;</td><td>
                				<select id="jur2"  name="jur2" class="form-control">
								<?php 
								echo "<option value='$r[XKodeJurusan]' selected >$r[XKodeJurusan]</option>";
								$sqk = mysqli_query($sqlconn,"select * from cbt_kelas group by XKodeJurusan");
								while($rs = mysqli_fetch_array($sqk)){
                             	echo "<option value='$rs[XKodeJurusan]' class='form-control'>$rs[XKodeJurusan]</option>";
								} ?>                                
                                </select>                
                </td>
                
                </tr>
                </table>
            </div>

            <div class="form-group">
 
                 <table width="100%" border="0" cellpadding="5px" cellspacing="5px">
                <tr>
				<td><label>Nomer Induk</label></td>
                <td>&nbsp;</td>
                <td><label>Foto Peserta</label></td>
                <td>&nbsp;</td>                
                <td><label>Jenis Kelamin</label></td>
                </tr>
                <tr><td>
                <input type="text" class="form-control" name="txt_nisn" value="<?php echo $r['XNIK']; ?>" size="5">
                </td><td>&nbsp;</td><td>
                <input type="text" class="form-control" name="txt_potret" value="<?php echo $r['XFoto']; ?>">                
                </td><td>&nbsp;</td><td>
              
                				<select id="txt_jekel"  name="txt_jekel" class="form-control">
								<option value='L' <?php if($r['XJenisKelamin']=="L"){echo "selected";} ?>>Laki-laki</option>
								<option value='P' <?php if($r['XJenisKelamin']=="P"){echo "selected";} ?>>Perempuan</option>                                
                                </select>                
                </td>                                
                </td></tr>
                </table>
            </div>
            <div class="form-group">
                
                          <table width="100%" border="0" cellpadding="5px" cellspacing="5px">
                <tr>
				<td><label>Password</label></td>
                <td>&nbsp;</td>
                <td><label>Sesi Ujian</label></td>
                <td>&nbsp;</td>                
                <td><label>Ruang Ujian</label></td>
                <td><label>Agama</label></td>
                </tr>
                <tr><td>
                <input type="text" class="form-control" name="txt_pas" value="<?php echo $r['XPassword']; ?>" size="5">
                </td><td>&nbsp;</td><td>
                 <select id="txt_sesi"  name="txt_sesi" class="form-control">
								<?php 
								//echo "<option value='$r[XSesi]' selected>$r[XSesi]</option>";
								?> 
								<option value='1'>1</option>
								<option value='2'>2</option>
								<option value='3'>3</option>
								<option value='4'>4</option>
								<option value='5'>5</option>
                                </select>  
																
                </td><td>&nbsp;</td><td>
				<input type="text" class="form-control" name="txt_ruang" value="<?php echo "$r[XRuang]"?>" size="5">
                                           
               
                </td> <td>
                                <select id="txt_agama"  name="txt_agama" class="form-control">
								<?php 
								echo "<option value='$r[XAgama]' selected >$r[XAgama]</option>";
								?>    
								<option value='ISLAM'>ISLAM</option>
								<option value='KRISTEN'>KRISTEN</option>  
								<option value='PROTESTAN'>PROTESTAN</option>
								<option value='HINDU'>HINDU</option>
								<option value='BUDHA'>BUDHA</option>
								<option value='KONGHUCU'>KONGHUCU</option>
								<option value=''>MAPEL UMUM</option>								
                                </select>                   
               
                </td>                                  
                </td></tr>
                
                
                <tr>
				<td>&nbsp;</td>
                </tr>
                <tr>
				<td><label>Mapel Pilihan</label></td>
				<td>&nbsp;</td>
				<td><label>Mama Kelas</label></td>
                </tr>
                <tr><td>
              
                				<select id="txt_pilih"  name="txt_pilih" class="form-control">
								<?php 
								echo "<option value='$r[XPilihan]' selected >$r[XPilihan]</option>";
								$sqk = mysqli_query($sqlconn,"select * from cbt_mapel where XMapelAgama='Y'");
								while($rs = mysqli_fetch_array($sqk)){
                             	echo "<option value='$rs[XNamaMapel]'>$rs[XNamaMapel]</option>";} 
								?>     
								
								<option value=''>NON PILIHAN</option>
								                            
                                </select>                
                </td>                                               
                                
                
				<td>&nbsp;</td>
				<td>	
					<select id="txt_namakelas"  name="txt_namakelas" class="form-control">
							<?php echo "<option value='$r[XNamaKelas]'> $r[XNamaKelas]</option>"; ?>
							<?php 								
								$sqnk = mysqli_query($sqlconn,"select * from cbt_kelas group by XNamaKelas");
								while($rsnk = mysqli_fetch_array($sqnk)){echo "<option value='$rsnk[XNamaKelas]'>$rsnk[XNamaKelas]</option>";} 
							?> 			
					</select>
                </td>	
				</tr> 
                </table>
                
                   
                
            </div>

              <button class="btn btn-primary" type="submit">Update</button>
			   
</form>
 
<?php } ?>