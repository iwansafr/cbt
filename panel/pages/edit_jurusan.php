<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<?php
include "../../config/server.php";
    if($_REQUEST['id']) {
        $id = $_POST['id'];
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = mysqli_query($sqlconn,"SELECT * FROM cbt_jurusan WHERE id = '$id'");
        $r = mysqli_fetch_array($sql);
        ?>
 
        	<form action="?modul=set_jurusan&simpan=yes" method="post">
            <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
			<div class="form-group">
			 <div style="width:100%; background-color:#28b2bc; color:#FFFFFF; padding:10px; margin-top:10px; font-size:22px">Edit Data Jurusan</div>
                <label></label>
            </div>
            <table width="100%" >
            <tr><td><label>Nama Sekolah</label></td><td width="5%"><br><br></td><td>
                <select name="txt_kodesek" class="form-control" id="txt_kodesek">
                                <?php 
                                $sqlsek = mysqli_query($sqlconn,"select * from server_sekolah order by XServerId");
                                while($sek = mysqli_fetch_array($sqlsek)){
                                echo "<option value='$sek[XServerId]'>$sek[XServerId] $sek[XSekolah]</option>";
                                }
                                ?>
            </td></tr>
			<tr><td><label>Kode Jurusan</label></td><td width="5%"><br><br></td><td>
                <input type="text" class="form-control" name="txt_kode" value="<?php echo $r['XKodeJurusan']; ?>">
            </td></tr>
            <tr><td><label>Nama Jurusan</label></td><td width="5%"><br><br></td><td>
                <input type="text" class="form-control" name="txt_jur"value="<?php echo $r['XNamaJurusan']; ?>">
            </td></tr></table>
			<input class="btn btn-primary" name="upload" type="submit" value="Simpan"  class="btn btn-danger" style="margin-top:0px">
        </form>
 
        <?php } 
?>