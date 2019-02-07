<?php
include "../../config/server.php";

// Name of the file
$filex = "$_REQUEST[anu]";
$filename = 'C:/CBT-Backup/'.$db_server.'/'.$filex;

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
		mysqli_query($sqlconn, $templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error() . '<br /><br />');
		// Reset temp variable to empty
		$templine = '';
	}
}

echo"
<br />
							<div class='alert alert-success alert-dismissable' id='ndelik'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                Data telah direstore.
                            </div>";