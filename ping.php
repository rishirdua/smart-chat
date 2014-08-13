<!--
Smart Chat
Authors:
  Rishi Dua <https://github.com/rishirdua>
  Harvineet Singh <https://github.com/harvineet>
File Desciption: updates a users entry in the pings text file to keep them logged in
This projected is licensed under the terms of the MIT license. See LICENCE.txt for details
-->
<?php

include("config.php");

$userid = $_GET['u'];

if($userid < 100000000 or $userid > 1000000000) die ("invalid user id");

$file = @file_get_contents($pings_file);
if( $file ) { $line = explode("\n",$file); }
$now = time();

$found = 0;
$num = count($line);
for( $i = 0; $i < $num; $i++ ) {
  $data = explode(",",$line[$i]);
  if( strstr($data[0],$userid) ) { 
    $found = 1;
	$data[1] = $now;  
    $line[$i] = implode(",",$data);
  }
}

// make sure a new file has at least one \n in it
if( !isset($line) ) { $line[0] = " "; }

// if the user doesn't have one, create a line for them
if( $found == 0 ) {
  array_unshift( $line, $userid.",".time() );
  //$line[$num] = $userid.",".time();
}  

$file = implode("\n",$line);

$fp = @fopen($pings_file, "w");
if ($fp) {
  fwrite($fp, $file);
  @fclose($fp);
}

include("timeout.php");

?>
