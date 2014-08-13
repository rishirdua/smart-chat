<!--
Smart Chat
Authors:
	Rishi Dua <https://github.com/rishirdua>
	Harvineet Singh <https://github.com/harvineet>
File Desciption: runs timeout.php and returns the number of users in the chat room. Include into another page on your site for best effect.
This projected is licensed under the terms of the MIT license. See LICENCE.txt for details
-->
<?php

include("config.php");

include("timeout.php");

$lines = file ($users_file);
$num_lines = count ($lines);

echo "<a class='chatcount' href='".$path_to_chat."'>Smart Chat: (".$num_lines.")</a>";

?>
