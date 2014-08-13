<!--
Smart Chat
Authors:
  Rishi Dua <https://github.com/rishirdua>
  Harvineet Singh <https://github.com/harvineet>
File description: validates the username and checks the password if the username is a variation on the admin username and creates config.php (requires write permissions).
This projected is licensed under the terms of the MIT license. See LICENCE.txt for details
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Smart Chat</title>
    <meta charset="utf-8">
	<!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen">   
    <script src="js/jquery-1.4.4.js" type="text/javascript"></script>
    <script src="js/cufon-yui.js" type="text/javascript"></script>
    <script src="js/cufon-replace.js" type="text/javascript"></script>
    <script src="js/Lora_400.font.js" type="text/javascript"></script>
    <script src="js/FF-cash.js" type="text/javascript"></script> 
	<!--[if lt IE 7]>
        <div style=' clear: both; text-align:center; position: relative;'>
            <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/images/upgrade.jpg" border="0"  alt="" /></a>
        </div>
	<![endif]-->
    <!--[if lt IE 9]>
   		<script type="text/javascript" src="js/html5.js"></script>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
	<![endif]-->
	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	

	
</head>
<body id="page2">
<!-- header -->
    <?php include "header.php" ?>
    <div class="ic"></div>
<!-- content -->
    <section id="content">
        <div class="bg-2">
        	<div class="main">
            	<?php


if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

$path = getcwd();

$number = rand(1000,10000);

// set a new admin number
$admin = $number*100000;
$admin_num = $admin + 1;

// set the path_to_chat
$path_to_chat = $_POST['path'];

// set an admin nick
$admin_nick = $_POST['admin_nick'];

// set an admin password
$admin_password = $_POST['password'];

// generate a short random number to generate to filenames
$b = "b".$number.".txt";
$u = "u".$number.".txt";
$p = "p".$number.".txt";

$e = $_POST['email_address'];

$line = array();

array_unshift( $line, "\$path_to_chat = '" .$path_to_chat . "'; ?>" );
array_unshift( $line, "\$admin_nick = '" . $admin_nick . "';" );
array_unshift( $line, "\$admin_password = '" . $admin_password . "';" );
array_unshift( $line, "\$pings_file = '" . $p . "';" );
array_unshift( $line, "\$users_file = '" . $u . "';" );
array_unshift( $line, "\$buffer_file = '" . $b . "';" );
array_unshift( $line, "\$timeout = '62';" );
array_unshift( $line, "\$maxlines = '20';" );
array_unshift( $line, "\$admin = ".$admin.";" );
array_unshift( $line, "\$admin_num = ".$admin_num.";" );
array_unshift( $line, "<?php \$email_addr = '" . $e . "';" );
 

$file = implode("\n",$line);

$credits = "<!--
Smart Chat
Authors:
  Rishi Dua <https://github.com/rishirdua>
  Harvineet Singh <https://github.com/harvineet>
File description: Generates the configuration file
-->
";

$fp = @fopen("config.php", "w");
if ($fp) {
  fwrite($fp, $credits);
  fwrite($fp, $file);
  
  @fclose($fp);
}

header("location: index.php?alert=4");
}
?>



<form action="install.php" method="post">
  <p class="style1">Welcome to Smart Chat Installation. <br>
    <br>
  This page will help you configure your installation with this one form. After this, you'll be open for chat. </p>
  <p class="style1">When entering your chat, the user may choose any nick except those based on the administrator's.</p>
  <table width="812" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="294" class="style1">Please enter the administrator nick: <br>
      <br></td>
      <td width="518" valign="top" class="style1"><input name="admin_nick" type="text" id="admin_nick"></td>
    </tr>
    <tr>
      <td class="style1">Choose a password: <br>
        <br>
      </td>
      <td class="style1"><input name="password" type="password" id="password">
      <br></td>
    </tr>
    <tr>
      <td class="style1">Enter the fully qualified path to your chat folder including the trailing slash:<br>
(example: http://www.rishidua.com/chat/)<br>
<br></td>
      <td valign="top" class="style1"><input name="path" type="text" id="path" value="http://" size="80"></td>
    </tr>
    <tr>
      <td class="style1">Notification email address. Sent when anyone enters your chatroom. Enter your cellphone email address for maximal effect. (optional) </td>
      <td valign="top" class="style1"><input name="email_address" type="text" id="email_address" value="none" size="50"></td>
    </tr>
  </table>
  <p class="style1">
    <input type="submit" name="Submit" value="Submit">
    <input type="reset" name="Reset" value="Reset">
</p>
</form>



            </div>
        </div>
    </section>
<?php include "footer.php" ?>
	<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
