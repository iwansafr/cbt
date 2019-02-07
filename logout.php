<?php 
include "config/server.php"; 
// ===============================
// Status Ujian XStatusUjian = 1 Aktif
// Status Ujian XStatusUjian = 0 BelumAktif
// Status Ujian XStatusUjian = 9 Selesai

$tgl = date("H:i:s");
$tgl2 = date("Y-m-d");
if(isset($_COOKIE['PESERTA'])){
$user = $_COOKIE['PESERTA'];

  $sqlgabung = mysqli_query($sqlconn,"
SELECT * FROM `cbt_siswa_ujian` s LEFT JOIN cbt_jawaban j ON j.XUserJawab = s.XNomerUjian and j.XTokenUjian = s.XTokenUjian WHERE XNomerUjian = '$user' and s.XStatusUjian = '1'
  ");
  


}

if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $user = trim($parts[0]);
        setcookie($user, '', time()-1000);
        setcookie($user, '', time()-1000, '/');
		setcookie("user", '', time()-1000);
		setcookie("apl", '', time()-1000);		
    	unset($_COOKIE['user']);
    	setcookie('user', '', time() - 3600, '/'); // empty value and old timestamp

    }
}


header('location:./login.php');

?>
<!DOCTYPE html>
<html class="no-js" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $skull;?>  | UJIAN BERBASIS KOMPUTER</title>
    
	<script language="JavaScript">
	var txt="<?php echo $skull;?>  | UJIAN BERBASIS KOMPUTER......";
	var kecepatan=100;var segarkan=null;function bergerak() { document.title=txt;
	txt=txt.substring(1,txt.length)+txt.charAt(0);
	segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
	</script>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='images/icon.png' rel='icon' type='image/png'/>
    <script>
        function disableBackButton() {
            window.history.forward();
        }
        setTimeout("disableBackButton()", 0);
    </script>
    
<style>
    .no-close .ui-dialog-titlebar-close {
        display: none;
    }
</style>

<main>
<header>
<div class="group">
    <div class="left"><img src="images/logo.png" style=" margin-left:0px;">
    </div>
    	<div class="right"><table width="100%" border="0" cellspacing="5px;" style="margin-top:10px">   
     					<tr><td rowspan="3" width="100px" align="center"><img src="images/avatar.gif" style=" margin-left:0px; margin-top:5px" class="foto"></td>
						<td><span  style=" margin-left:0px; margin-top:5px">Selamat Datang</span></td></tr>
                        <tr><td><span class="user"><?php echo "$val_siswa ($xkodekelas)"; ?></span></td></tr>
                        <tr><td><span class="log"><a href="logout.php">Logout</a><span></td></tr>
						</table>
                        </div>
           
      	</div>
	</div> 
</div>         
</header>


    <link rel="stylesheet" href="mesin/css/bootstrap.min.css">
    <script src="mesin/js/jquery.min.js"></script>
    <script src="mesin/js/bootstrap.min.js"></script>
	<link href="mesin/css/klien.css" rel="stylesheet">
 <div class="main-content">
                

<div class="page-column">
   

    <div class="page-col-small col-centered login-wrapper">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title page-label">Konfirmasi Tes</h1>
            </div>

                    <div class="panel-body">
                        <div class="inner-content">
                            <div class="wysiwyg-content">
                                <p>
                                    Terimakasih telah berpartisipasi dalam tes ini.<br>
                                    Silahkan klik tombol LOGOUT untuk mengakhiri test.
                                </p>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-xs-offset-3 col-xs-6"><a href="logout.php">
                                    <button type="submit" class="btn btn-success btn-block" data-dismiss="modal">LOGOUT</button>
                                </div>
                            </div>
                        </div>                   
                    </div>

    </div>
</div>

</body>
</html>