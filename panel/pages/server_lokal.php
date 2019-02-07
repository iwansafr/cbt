<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<?php
// Connect to MySQL
include "../../config/server.php";

// Name of the file
$filename = '../../config/ubkmadiplokal.sql';
$mysqli_database = 'ubkmadiplokal';

// Connect to MySQL server
//mysqli_connect($mysqli_host, $mysqli_username, $mysqli_password) or die('Error connecting to MySQL server: ' . mysqli_error());
// Select database
mysqli_select_db($mysqli_database) or die('Error selecting MySQL database: ' . mysqli_error());

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysqli_query($sqlconn,$templine);// or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
header('location:../pages/login.php');
 //echo "Tables imported successfully";
?>