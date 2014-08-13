<!--
Smart Chat
Authors:
  Rishi Dua <https://github.com/rishirdua>
  Harvineet Singh <https://github.com/harvineet>
File description: if called with a valid user this script returns the latest chat text that should be displayed in the main chat window.
This projected is licensed under the terms of the MIT license. See LICENCE.txt for details
-->
<?php
//error_reporting(0);

include("config.php");

if (isset($_GET['u'])) {
	$userid = $_GET['u'];
}
else {
	$userid = "default";
}
if (isset($_GET['d'])) {
$d = $_GET['d'];
}
else $d=0;

$type = 0;

$users = @file_get_contents($users_file);
if( strstr($users, $userid) == 0 ) {

  echo $userid."timeout<br><br><br><br><br><br><br><br><br><center><li class='servermsg'>You have timed out, please <a href='".$path_to_chat."' target='_top'>login</a> again</li></center>";
# i want to stop the incessant requests on the client side...if I send you back your own id, your client stops updating.
  exit();
}

$file = file_get_contents($buffer_file);
$lines = explode("\n",$file);
$num = count($lines);
$num--; #cuz there's always a whitespace line at the end.
if( $num < $maxlines * 2 || $d == 1 ) { $start = 0; }
else { $start = $num - ($maxlines  * 2) ; }
if ( $d == 1 ) { echo "<html><head><title>Chat Archive</title><link rel='stylesheet' href='css/style.css' type='text/css' ></head><body style='width:620px'><div id='chatpane'><ul id='chatbuffer'>"; }
echo "<div width='50%'>";
for($i = $start; $i < $num; $i = $i + 2) {
  $lines[$i+1] = stripslashes($lines[$i+1]);
  
  $type = rtrim($lines[$i]);
  if( $type == '0') { 
    echo "<li class='usermsg'>" . $lines[$i+1] . "</li>";
  }
  else if ( $type == '1' ) { 
    echo "<li class='servermsg'>" . $lines[$i+1] . "</li>";
  }
  else if ( $type == '2' ) { 
    echo "<li class='actionmsg'>" . $lines[$i+1] . "</li>";
  } 
}
echo "</div>";
if ( $d == 1 ) {
  echo "</div></ul></body></html>";
}
?>
