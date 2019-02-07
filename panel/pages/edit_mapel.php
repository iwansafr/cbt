<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<?php
include "../../config/server.php";
    if($_REQUEST['urut']) {
        $id = $_POST['urut'];
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = mysqli_query($sqlconn,"SELECT * FROM cbt_mapel WHERE Urut = '$id'");
        $r = mysqli_fetch_array($sql);
        ?>
 
        <!-- MEMBUAT FORM -->
        <form action="?modul=daftar_mapel&simpan=yes" method="post">
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
            </div>
            <div class="form-group">
 				<table width="100%" border="0" cellpadding="5px" cellspacing="5px">
                <tr>
                <td><label>Kode Mapel</label></td>
                <td>&nbsp;</td>
                <td><label>Nama Mapel</label></td>
                <td>&nbsp;</td>
                <td><label>Mapel Agama</label></td>
                <td>&nbsp;</td>
                </tr>
				<tr><td>
                <input type="text" class="form-control" name="txt_kokel" value="<?php echo $r['XKodeMapel']; ?>">                
                </td><td>&nbsp;</td><td>
                <input type="text" class="form-control" name="txt_nakel" value="<?php echo $r['XNamaMapel']; ?>">                
                </td>
                </td><td>&nbsp;</td><td>
                <select id="txt_mapelagama"  name="txt_mapelagama" class="form-control" >
						<option value='N'  <?php if ($r['XMapelAgama']=="N"){echo "selected";} ?>>MAPEL UMUM</option>
						<option value='Y' <?php if ($r['XMapelAgama']=="Y"){echo "selected";} ?>>PEMINATAN</option>                                
						<option value='A' <?php if ($r['XMapelAgama']=="A"){echo "selected";} ?>>PEND. AGAMA</option>                                             
				</select>                 
                </td>
                </td><td>&nbsp;</td>
                </tr>
                </table>
			</div>
<hr />
            <div class="form-group">
  				<table width="100%" border="0" cellpadding="5px" cellspacing="5px">
                <tr>
                <td><label>Persen Harian</label></td>
                <td>&nbsp;</td>
                <td><label>Persen UTS </label></td>
                <td>&nbsp;</td>
                <td><label>Persen UAS</label></td>
                <td>&nbsp;</td>
                <td><label>Nilai KKM </label></td>
                <td>&nbsp;</td>
                </tr>
				<tr>
                <td>
                <input type="text" class="form-control" name="txt_UH" value="<?php echo $r['XPersenUH']; ?>">                
                </td><td>&nbsp;</td><td>
                <input type="text" class="form-control" name="txt_UTS" value="<?php echo $r['XPersenUTS']; ?>">                
                </td>
                </td><td>&nbsp;</td>
                <td>
                <input type="text" class="form-control" name="txt_UAS" value="<?php echo $r['XPersenUAS']; ?>">                
                </td><td>&nbsp;</td><td>
                <input type="text" class="form-control" name="txt_KKM" value="<?php echo $r['XKKM']; ?>">                
                </td>
                </td><td>&nbsp;</td>
                </tr>
                </table>
            </div>
 
              <button class="btn btn-primary" type="submit">Update</button>
        </form>
 
        <?php } 
?>