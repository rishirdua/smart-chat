<!--
Smart Chat
Authors:
	Rishi Dua <https://github.com/rishirdua>
	Harvineet Singh <https://github.com/harvineet>
File Desciption: returns the list of active users to be displayed by the chat client
This projected is licensed under the terms of the MIT license. See LICENCE.txt for details
-->
<?php

include("config.php");

$file = file_get_contents($users_file);
$lines = explode("\n",$file);
$num = count($lines);

for( $i = 0; $i < $num; $i++ ) {
  $data = explode(",",$lines[$i]); 
  if( count($data) > 1 ) { echo "<li>" . $data[1] . "</li>"; }
}

?>