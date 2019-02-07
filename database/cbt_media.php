<?php
function &backup_tables($host, $user, $pass, $name, $tables = '*'){
  $data = "\n/*---------------------------------------------------------------".
          "\n  SQL DB BACKUP ".date("d.m.Y H:i")." ".
          "\n  HOST: {$host}".
          "\n  DATABASE: {$name}".
          "\n  TABLES: {$tables}".
          "\n  ---------------------------------------------------------------*/\n";
  $link = @mysqli_connect($host,$user,$pass, $name);
  // mysqli_select_db($name,$link);
  mysqli_query($sqlconn,  "SET NAMES `utf8` COLLATE `utf8_general_ci`" , $link ); // Unicode

  if($tables == '*'){ //get all of the tables
    $tables = array();
    $result = mysqli_query($sqlconn, "SHOW TABLES");
    while($row = mysqli_fetch_row($result)){
      $tables[] = $row[0];
    }
  }else{
    $tables = is_array($tables) ? $tables : explode(',',$tables);
  }

  foreach($tables as $table){
    $data.= "\n/*---------------------------------------------------------------".
            "\n  TABLE: `{$table}`".
            "\n  ---------------------------------------------------------------*/\n";           
    $data.= "DROP TABLE IF EXISTS `{$table}`;\n";
    $res = mysqli_query($sqlconn, "SHOW CREATE TABLE `{$table}`", $link);
    $row = mysqli_fetch_row($res);
    $data.= $row[1].";\n";

    $result = mysqli_query($sqlconn, "SELECT * FROM `{$table}`", $link);
    $num_rows = mysqli_num_rows($result);    

    if($num_rows>0){
      $vals = Array(); $z=0;
      for($i=0; $i<$num_rows; $i++){
        $items = mysqli_fetch_row($result);
        $vals[$z]="(";
        for($j=0; $j<count($items); $j++){
          if (isset($items[$j])) { $vals[$z].= "'".mysqli_real_escape_string( $items[$j], $link )."'"; } else { $vals[$z].= "NULL"; }
          if ($j<(count($items)-1)){ $vals[$z].= ","; }
        }
        $vals[$z].= ")"; $z++;
      }
      $data.= "INSERT INTO `{$table}` VALUES ";      
      $data .= "  ".implode(";\nINSERT INTO `{$table}` VALUES ", $vals).";\n";
    }
	if($_REQUEST['aksi']=='2'){
	$sql = mysqli_query($sqlconn, "TRUNCATE TABLE $table");	
	}
  }
  mysqli_close( $link );
  return $data;
}

// create backup
//////////////////////////////////////

if (!file_exists('C:/CBT-Backup/'.$db_server)) {
    mkdir('C:/CBT-Backup/'.$db_server, 0777, true);
}

$tabel = "cbt_upload_file";

$backup_file = 'C:/CBT-Backup/'.$db_server.'/db-media_'.date("dmY-hi").'.sql';
// get backup
$mybackup = backup_tables("localhost:3306","root","",$db_server,$tabel);

// save to file
$handle = fopen($backup_file,'w+');
fwrite($handle,$mybackup);
fclose($handle);

echo "

<br /><div class='alert alert-success alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                Tabel ".$tabel." telah di Backup<br />
                                Lokasi file Backup, Silahkan Lihat folder C:/CBT-Backup/".$db_server."/
                            </div>";