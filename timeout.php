<!--
Smart Chat
Authors:
  Rishi Dua <https://github.com/rishirdua>
  Harvineet Singh <https://github.com/harvineet>
File Desciption: checks the pings file and users file for timed out users. Removes timed out users from the users file.
-->
<?php

include("config.php");

$file = file_get_contents($pings_file);
$lines = explode("\n",$file);
$num = count($lines);

$now = time();

//read the users data once
$userfile = file_get_contents($users_file);
$userline = explode("\n",$userfile);
$jnum = count($userline);

// interate through pings to see if one has timed out
for( $i = 0; $i < $num; $i++ ) {
  if( strlen($lines[$i]) < 1 ) continue;
  $data = explode(",",$lines[$i]); 
  $ping_uid = $data[0];
  $timestamp = $data[1];
  // transfer all lines but the timed out ones
  for( $j = 0; $j < $jnum; $j++) {
	$userdata = explode(",",$userline[$j] );
	$users_uid = $userdata[0];
	if( $users_uid == $ping_uid ) {
       if( $timestamp >= $now - $timeout ) {
	    $newuserlines[] = $userline[$j];
	   } else {
	    // give message that user timed out to the room
	    $usertodrop = $userdata[1];
        $drop = 1;
	  }
	}
  }
 
}

if( $drop ) {
$fu = @fopen($users_file,"w+");
if( $newuserlines ) { 
  $newfile = implode("\n",$newuserlines); 
  fopen($path_to_chat."posttext.php?u=".$admin_id."&t=User%20".$usertodrop."%20timed%20out","r");
}
fwrite($fu,$newfile);
fclose($fu);
}

// section to stop buffertext and pings from growing too large
if( filesize($buffer_file) > 100000 ) {
  rename($buffer_file,$buffer_file.$now);
}

if( filesize($pings_file) > 5000 ) {
  $file = @file_get_contents($pings_file);
  if( $file ) { 
    $line = explode("\n",$file); 
    $line = array_slice($line,0,100);  // take the first hundred lines
    array_push($line,"\n");
    $file = implode("\n",$line);

    $fp = @fopen($pings_file, "w");
    if ($fp) {
      fwrite($fp, $file);
      @fclose($fp);
    }
  }
}

?>
