<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        Data Peserta
						</div>
                        <div class="panel-body">
								<?php include "../../config/server.php"; ?>
								<?php 
								if(isset($_REQUEST['beeuser'])){
									$siswa = mysqli_real_escape_string($_REQUEST['beeuser']);
									$sql = mysqli_query($sqlconn,"select * from cbt_siswa where XNomerUjian = '$_REQUEST[beeuser]'");
									$s = mysqli_fetch_array($sql); 
									$gbr=str_replace(" ","",$s['XFoto']);
									?>
									
                                    <table width="100%" border="0">
                                          <tr>
                                            <td rowspan="6" width="25%">
                                            	<?php 
												if(file_exists("../../fotosiswa/$s[XFoto]")&&!$gbr==''){ ?>
                                                <img src="../../fotosiswa/<?php echo $s['XFoto']; ?>" width="200px">
                                                <?php 
												} else {
												echo "<img src=../../fotosiswa/nouser.png>";
												}
												?>
                                                
                                                </td>
                                            <td width="25%">Nama <?php echo "$_REQUEST[idstu]|$gbr-$siswa|"; ?></td>
                                            <td width="50%">: <?php echo $s['XNamaSiswa']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>NIS </td>
                                            <td>: <?php echo $s['XNIK']; ?></td>
                                          </tr>

                                          <tr>
                                            <td>Nomer Ujian </td>
                                            <td>: <?php echo $s['XNomerUjian']; ?></td>
                                          </tr>

                                          <tr>
                                            <td>Password </td>
                                            <td>: <?php echo $s['XPassword']; ?></td>
                                          </tr>


                                          <tr>
                                            <td>Kelas</td>
                                            <td>: <?php echo $s['XKodeKelas']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>: <?php echo $s['XJenisKelamin']; ?></td>
                                          </tr>
                                    </table>

									<?php 
									
								} ?>
                                   
						</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>                        
      </div>               