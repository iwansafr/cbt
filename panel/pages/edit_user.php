<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}

	include "../../config/server.php";
    if($_REQUEST['urut']) {
        $id = $_POST['urut'];
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = mysqli_query($sqlconn,"SELECT * FROM cbt_user WHERE Urut = '$id'");
        $r = mysqli_fetch_array($sql);
?>
 
        	<form action="?modul=data_user&simpan=yes" method="post">
            <input type="hidden" name="id" value="<?php echo $r['Urut']; ?>">
			<div class="form-group">
			<div style="width:100%; background-color:#28b2bc; color:#FFFFFF; padding:10px; margin-top:10px; font-size:22px">Edit Data User</div>
            </div><table><table width="100%" >
			<tr><td><label>Level</label></td><td width="5%"><br><br></td><td>
			<select class="form-control" name="txt_login">
			<?php 							
				$log = $r['login'];
				if ($log =="1"){$logview="ADMIN";} else if ($log =="2"){$logview="GURU";} else if($log =="3"){$logview="Siswa";}else{$logview="";}
			?>
					
					<option value="1" <?php if ($log=="1"){echo "selected";} ?>>ADMIN</option>
					<option value="2" <?php if ($log=="2"){echo "selected";} ?>>GURU</option>
					<!--
					<option value="3">Siswa</option>
					!-->
				</select>
				</tr></td>
            <tr><td><label>Username</label></td><td width="5%"><br><br></td><td>
                <input type="text" class="form-control" name="txt_usern" value="<?php echo $r['Username']; ?>">
            </td></tr>
            <tr><td><label>Password</label></td><td width="5%"><br><br></td><td>
                <input type="password" class="form-control" name="txt_pass">
            </td></tr>
            <tr><td><label>Nama</label></td><td width="5%"><br><br></td><td>
                <input type="text" class="form-control" name="txt_nama" value="<?php echo $r['Nama']; ?>">
            </td></tr>
            <tr><td><label>NIP</label></td><td width="5%"><br><br></td><td>
                <div><input type="text" class="form-control" name="txt_nip" value="<?php echo $r['NIP']; ?>">
            </td></tr>
            <tr><td><label>Alamat</label></td><td width="5%"><br><br></td><td>
                <input type="text" class="form-control" name="txt_alamat" value="<?php echo $r['Alamat']; ?>">
            </td></tr>
            <tr><td><label>HP/Telp</label></td><td width="5%"><br><br></td><td> 
                <input type="text" class="form-control" name="txt_hp" value="<?php echo $r['HP']; ?>">
            </td></tr>
            <tr><td><label>Email</label></td><td width="5%"><br><br></td><td>
                <input type="text" class="form-control" name="txt_email" value="<?php echo $r['Email']; ?>">
            </td></tr>
			</table>
			
			<button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
			<button class="btn btn-primary" type="submit">Update Data User</button>
        </form>
 
<?php } ?>