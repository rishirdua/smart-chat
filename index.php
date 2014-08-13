<!--
Smart Chat
Authors:
  Rishi Dua <https://github.com/rishirdua>
  Harvineet Singh <https://github.com/harvineet>
File description: the introductory page with the login form, a submit here redirects to login.php to validate the input and start the chat session
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
            	<div class="wrapper margin-bot">
                	<h3>Enter nick</h3><br />
					
					<div id="janrainEngageEmbed"></div>
					<p>
<?php
//error_reporting(0);

// errors 
if (isset($_GET['alert'])) {
	if ( $_GET['alert'] == 1 ) {
	  echo "That username already exists.<br>";
	} else if ( $_GET['alert'] == 2 ) {
	  echo "The username may not contain spaces or html, and must be between 1 and 20 characters in length.<br />"; 
	} else if ( $_GET['alert'] == 3 ) {
	  echo "If you're the administator, please enter the correct password. Otherwise, enter another name.<br />";
    } else if ( $_GET['alert'] == 4 ) {
      echo "Smart chat has been installed.<br />";
    
     } else if ( $_GET['alert'] == 5 ) {
      echo "You have been logged out.<br />";
    }
}
?> 
</p>

<form name="form1" method="post" action="login.php">
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>Username:</td>
      <td><input type="text" name="u" id="u"></td>
    </tr>
    
  </table>
  <p>
	<input type="submit" name="Submit" value="Login">
  </p>
  To login as admin, <a href="admin.php">click here</a>
            </div>
        </div>
    </section>
<?php include "footer.php" ?>
	<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
