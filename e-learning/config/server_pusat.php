<?php
include "ipserver.php";
$link = @mysqli_connect($ipserver, $db_userm, $db_pasw);
mysqli_select_db($db_nama, $link) or die('Koneksi-2 BEESMART-CBT belum di setting');
date_default_timezone_set("$zo");