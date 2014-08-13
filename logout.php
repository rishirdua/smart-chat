<!--
Smart Chat
Authors:
	Rishi Dua <https://github.com/rishirdua>
	Harvineet Singh <https://github.com/harvineet>
File description: Removes user from list of logged in users
This projected is licensed under the terms of the MIT license. See LICENCE.txt for details
-->
<?php
	include "config.php";
	if (empty($_GET)) {
		echo "You have been logged out";
	}
	else {
		$userid = $_SERVER['QUERY_STRING'] ;
		$file = file_get_contents($users_file);
		$lines = explode("\n",$file);
		$num = count($lines);
		
		echo $num;
		file_put_contents($users_file, "");
	  	for ($i = 0; $i < $num; $i++) {
		    $data = explode(",",$lines[$i]); 
		    $uid = $data[0];
			if( $userid != $uid) {
				file_put_contents($users_file, $lines[$i]."\n", FILE_APPEND);
			}
		}
		header("location: index.php?alert=5");

	}
?>