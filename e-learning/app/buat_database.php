<?php
include "../../config/server.php";
if(!isset($_COOKIE['beeuser'])){
header("Location: login.php");}

//Membuat DATABASE//
if (!$db_selected) {$sql = 'CREATE DATABASE'.' '. $db;	 if (mysqli_query($sqlconn,$sql, $sqlconn)) { } else { }}
$filename = '../../config/'.$teks3.'.sql';
$mysqli_database = $db;
mysqli_select_db($mysqli_database) or die('Error selecting MySQL database: ' . mysqli_error());
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
header('location:../app/login.php');
 //echo "Tables imported successfully";
?>