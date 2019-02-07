<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}

include "../../config/server.php";
	$xadm = mysqli_fetch_array(mysqli_query($sqlconn,"select * from cbt_admin"));
	$skul_tkt= $xadm['XTingkat']; 
	if ($skul_tkt=="SMA" || $skul_tkt=="MA"||$skul_tkt=="STM"){$rombel="Jurusan";}else{$rombel="Rombel";}

    if($_REQUEST['urut']) {
        $id = $_POST['urut'];
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = mysqli_query($sqlconn,"SELECT * FROM cbt_kelas WHERE Urut = '$id'");
        $r = mysqli_fetch_array($sql);
        ?>
 
        <!-- MEMBUAT FORM -->
        <form action="?modul=daftar_kelas&simpan=yes" method="post">
            <input type="hidden" name="id" value="<?php echo $r['Urut']; ?>">
			<div class="form-group">
                <label>Kode Sekolah</label><br>
                <select class="form-control" name="txt_kodesek" id="txt_kodesek">
                                <?php 
								$sqle = mysqli_query($sqlconn,"SELECT * FROM server_sekolah WHERE XServerId = '$r[XKodeSekolah]'");
								$re = mysqli_fetch_array($sqle);
								echo "<option value='$r[XKodeSekolah]' selected >$r[XKodeSekolah] $re[XSekolah]</option>";
                                $sqlsek = mysqli_query($sqlconn,"select * from server_sekolah order by XServerId");
                                while($sek = mysqli_fetch_array($sqlsek)){
                                echo "<option value='$sek[XServerId]'>$sek[XServerId] $sek[XSekolah]</option>";
                                }
                                ?>
								<option value='ALL'>SEMUA / ALL</option>
								</select>
            </div><p>
            <div class="form-group">
                <label>Kode Kelas</label>
                <input type="text" class="form-control" name="txt_kodkel" value="<?php echo $r['XKodeKelas']; ?>">
            </div>

            <div class="form-group">
                <label>Nama Kelas</label>
                <input type="text" class="form-control" name="txt_namkel" value="<?php echo $r['XNamaKelas']; ?>">
            </div>
            <div class="form-group">
                <label>Kode Level</label>
                <input type="text" class="form-control" name="txt_kodlev" value="<?php echo $r['XKodeLevel']; ?>">
            </div>
            <div class="form-group">
                <label><?php echo $rombel;?></label>
					<?php 
						echo "<input type='text' class='form-control' name='txt_jur' value=' $r[XKodeJurusan]'>";
					?>
            </div>

              <button class="btn btn-primary" type="submit">Update</button>
        </form>
 
        <?php } 
?>