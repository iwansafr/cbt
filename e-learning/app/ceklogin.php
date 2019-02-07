<?php
if(isset($_POST['userz'], $_POST['passz'])) {
		include "../../config/server.php";
		require("../../config/fungsi_thn.php");		
		$userz = mysqli_real_escape_string($sqlconn, $_REQUEST['userz']);
		$passz = mysqli_real_escape_string($sqlconn, $_REQUEST['passz']);		
		$loginz = mysqli_real_escape_string($sqlconn, $_REQUEST['loginz']);
		
		if($loginz == "admin"){$peran = "1"; $pass = md5($passz);} 
		else if($loginz == "guru"){$peran = "2"; $pass = md5($passz); }
		else if($loginz == "siswa"){$peran = "3"; $Login ="3";} 
		else {$peran="0";}
		
		$sqladmin = mysqli_num_rows(mysqli_query($sqlconn, "select * from cbt_user where Username = '$userz' and Password = '$pass' and login = '$peran'  and Status = '1'"));		
		$sqladmin2 = mysqli_num_rows(mysqli_query($sqlconn, "select * from cbt_siswa where XNomerUjian = '$userz' and XPassword = '$passz' and '$Login' = '$peran'  "));
		if($sqladmin>0){$sqltahun = mysqli_query($sqlconn, "select * from cbt_setid where XStatus = '1'");
						$st = mysqli_fetch_array($sqltahun);
						$tahunz = $st['XKodeAY'];
						$sqlsekolah = mysqli_query($sqlconn, "select * from cbt_admin");
						$sk = mysqli_fetch_array($sqlsekolah);
					
						setcookie('beeuser',$userz);
						setcookie('beelogin',$loginz);
						setcookie('beepassz',$passz);
						setcookie('beetahun',$tahunz);
						setcookie('beesekolah',$sk['XKodeSekolah']);
						$_COOKIE['beeuser']==$userz;
						$_COOKIE['beelogin']==$loginz;
						$_COOKIE['beepassz']==$passz;
						$_COOKIE['beetahun']==$tahunz;
						$_COOKIE['beesekolah']==$sk['XKodeSekolah'];						
						header("Location: ./?");
						} 
		else if($sqladmin2>0){$sqltahun = mysqli_query($sqlconn, "select * from cbt_setid where XStatus = '1'");
						$st = mysqli_fetch_array($sqltahun);
						$tahunz = $st['XKodeAY'];
						$sqlsekolah = mysqli_query($sqlconn, "select * from cbt_admin");
						$sk = mysqli_fetch_array($sqlsekolah);
					
						setcookie('beeuser',$userz);
						setcookie('beelogin',$loginz);
						setcookie('beetahun',$tahunz);
						setcookie('beesekolah',$sk['XKodeSekolah']);
						$_COOKIE['beeuser']==$userz;
						$_COOKIE['beelogin']==$loginz;
						$_COOKIE['beetahun']==$tahunz;
						$_COOKIE['beesekolah']==$sk['XKodeSekolah'];						
						header("Location: ./?");
						} 	

		
		else { header("Location: login.php"); }} 
else {header("Location: login.php");}