<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>

 <!-- /.row -->
            <div class="row"  >
                <div class="col-lg-10" style="margin-top:10px; ">
                    <div class="panel panel-green" style="background-color:#C4AAF7">
                        <div class="panel-heading">
                           Download File Excel (Template Administrasi User)
                        </div>
                        <div class="panel-body">
<div style="width: 20%; float:left">
  <img src="images/xls.png" style=" width:90%; max-width:100px;padding-right:10px;"/></a>
</div>
Upload Data Administrasi User untuk mempermudah pengelolaan user oleh admin yang meliputi 3 hak akses : 1. Administrator, 2. Guru dan 3. Siswa.
<br>1. Admin : Hak penuh seluruh Fitur 
<br> 2.Guru : Hak Fitur Edit Biodata, Bank Soal dan Analisa. 
<br> 3. Siswa : Hak Fitur Edit Biodata dan Daftar Nilai. 
<div style="width: 80%; float:right">
   
   
</div>
                        </div>
                        <div class="panel-footer" style="background-color:#F2DB63">
                                   <a href="../../file-excel/bee_user_temp.xls" target="_blank"><button class="btn btn-success btn-lg btn-small" id="baru" value="Buat" name="baru"><i class="fa fa-cloud-download"></i>
                            Download Template</button></a>
        
        <a href="?modul=data_user"><button class="btn btn-success btn-lg btn-small" id="baru" value="Buat" name="baru"><i class="fa fa-list"></i>
                            Lihat Data User</button></a>
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
            </div>
            <!-- /.row -->
            
            
              <div class="row" >
                <div class="col-lg-10" style="margin-top:10px; ">
                    <div class="panel panel-default" style="border:2px solid #F2DB63;">
                        <div class="panel-heading" style="background-color:#F2DB63">
                            Upload Template Excel - User
                        </div>
                        <div class="panel-body" style="background-color:#92F783">
						<form method="post" enctype="multipart/form-data" action="<?php echo "?modul=uploaduser"; ?>">
                        File Excel Daftar User  : 
                        <table border="0" width="78%" cellpadding="20px" cellspacing="20px"><tr><td width="30%"><input name="userfile" type="file" class="btn btn-default" style="width:250px"></td><td>
                        &nbsp;<input name="upload" type="submit" value="Import"  class="btn btn-info" style="margin-top:0px">
                        </td></tr></table>
                        </form>
                        <div style="margin-top:10px;" >Persentase Proses Upload <? echo $kata; ?> </div>
						
<!-- Progress bar holder -->
<div id="progress" style="width:75%; border:1px solid #ccc; padding:5px; margin-top:10px; height:33px; background-color:#D9D9D9"></div>
<!-- Progress information -->
<div id="information" style="width"></div>

<?php

if($_REQUEST['modul']=="uploaduser"){
// menggunakan class phpExcelReader
include "excel_reader2.php";

// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);

// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;

echo "<br><table>";

//$query0 = "TRUNCATE TABLE cbt_user";

//		  $hasil0 = mysqli_query($sqlconn,$query0);


for ($i=3; $i<=$baris; $i++)
{
  // membaca data soalid (kolom ke-1 FIELD)
  $fieldz = $data->val($i, 0);
  // membaca data pertanyaan (kolom ke-2 R)
  $Username 	= $data->val($i, 1);
  $Password  	= $data->val($i, 2);
  $xnik   	= $data->val($i, 3);
  $Nama  	= $data->val($i, 4);
  $Alamat 	= $data->val($i, 5);
  $HP 	= $data->val($i, 6);
  $Faxs 	= $data->val($i, 7);
  $Email 	= $data->val($i, 8);
  $login  	= $data->val($i, 9);
  $Status   	= $data->val($i, 10);
  $xfoto  	= $data->val($i, 11);
  $Password = md5($Password);
  $Nama  	= str_replace("'","\'",$Nama);
  $Nama  	= str_replace("'","`",$Nama);
 
 
 
if(!str_replace(" ","",$Username)==""){ 
 
		  $queryuser = "select Username from cbt_user where Username = '$Username' ";
		  $hasiluser = mysqli_num_rows(mysqli_query($sqlconn,$queryuser));  
		  if($hasiluser>0){ 
  echo "<tr><td>Gagal Insert data User <font color=blue> <b>$Username</b>&nbsp;&nbsp;</td><td><font color=red> Username $Username</font> Sudah Ada</td> </tr>";
		  $gagal++;
	} else {	  
  	  // setelah data dibaca, sisipkan ke dalam tabel mhs
		  $query = "INSERT INTO cbt_user 
					(Username, 		Password,		NIP,		Nama, 		Alamat,		HP, 	Faxs, 		Email, 		login, 		Status, 	XPoto) 
		  VALUES 	('$Username', 	'$Password',	'$xnik', 	'$Nama', 	'$Alamat',	'$HP',	'$Faxs',	'$Email',	'$login',	'$Status',	'$xfoto')";
		  $hasil = mysqli_query($sqlconn,$query);
  $sukses++;
   

} }
  
  //if ($hasil) $sukses++;
  //else $gagal++;

			// Calculate the percentation
			$percent = intval($i/$baris * 100)."%";
    
    // Javascript for updating the progress bar and information
    echo '<script language="javascript">
    document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.';background-image:url(images/pbar-ani1.gif);\">&nbsp;</div>";
    document.getElementById("information").innerHTML="  Proses Entri : '.$Nama.' ... <b>'.$i.'</b> row(s) of <b>'. $baris.'</b> processed.";
    </script>';
// This is for the buffer achieve the minimum size in order to flush data
    echo str_repeat(' ',1024*64);
    

// Send output to browser immediately
    flush();
// Tell user that the process is completed
   echo '<script language="javascript">document.getElementById("information").innerHTML=" Proses update database User : Completed"</script>';
  
  }
  // jika proses insert data sukses, maka counter $sukses bertambah
  // jika gagal, maka counter $gagal yang bertambah

  echo "</table>";
// tampilan status sukses dan gagal
?>
<div style="width:75%; margin-top:10px">
    <div class="alert alert-success">
    <?php
    echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
    ?>
    </div>
    
    <?php
        if($gagal>0){
        ?>
        <div class="alert alert-danger">
        <?php
        echo "Jumlah data yang gagal diimport : ".$gagal."</p>";
        ?></div>
        <?php
        }
    }
    ?>
    
	</div>
</div>

                    </div>
                    <!-- /.col-lg-4 -->
                </div>
            </div>
            <!-- /.row -->
            


<script src="../../mesin/js/jquery.js"></script>
