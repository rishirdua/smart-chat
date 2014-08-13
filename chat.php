<!--
Smart Chat
Authors:
	Rishi Dua <https://github.com/rishirdua>
	Harvineet Singh <https://github.com/harvineet>
File description: presents the user interface after login.php has been called by a submit on index.php
This projected is licensed under the terms of the MIT license. See LICENCE.txt for details
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Smart Chat</title>
    <meta charset="utf-8">
	<!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

<script type="text/javascript" src="js/md4.js"></script>	
<script type="text/javascript" src="chatclient.js"></script>
<script language="JavaScript">
<!--
function setsmiley(what){
	tmp=document.getElementById("mytext");
    tmp.value = tmp.value+" "+what+" ";
    tmp.focus();
}
//-->
</script>
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
    <div class="ic">Smart Chat</div>
<!-- content -->
    <section id="content">
        <div class="bg-2">
        	<div class="main">
            	<div class="wrapper margin-bot">
                	<h3>Welcome to chat</h3><br />
					
					
					<div class="form">
					
		<div id="chatpane">
		  <ul id="chatbuffer"></ul>
		</div>

		<div id="userpane">
			<ul id="userlist"></ul>
		</div>
				
		<p class="clear">
		
		<div id="recommendations" style="border-color: red; border-width: 2px;">
		<h4>Recommended for you!</h4>
		<div id="recotext"></div>
		<div id="feedbacktext">
		<h5>Are you looking for?</h5>
			<input type="button" class="feedbacklink" category="movie" value="movies">
			<input type="button" class="feedbacklink" category="product" value="products">
			<input type="button" class="feedbacklink" category="restaurant" value="restaurants">
			<input type="button" class="feedbacklink" category="car" value="car">
			<input type="button" class="feedbacklink" category="hotel" value="hotels">
		</div>
		
		</div>
		<p class="clear">
		<div id="actions">
		<a href="javascript:setsmiley(':)')"><img src="images/smile.PNG" border="0" alt=":)" align="bottom" width="40px"></a>
		<a href="javascript:setsmiley(':D')"><img src="images/laugh.PNG" border="0" alt=":D" align="bottom" width="40px"></a>
		<a href="javascript:setsmiley(':p')"><img src="images/tongue.PNG" border="0" alt=":p" align="bottom" width="40px"></a>
		<a href="javascript:setsmiley(';)')"><img src="images/wink.PNG" border="0" alt=";)" align="bottom" width="40px"></a>
		<a href="javascript:setsmiley(':kiss')"><img src="images/kiss.PNG" border="0" alt=":kiss" align="bottom" width="40px"></a>
		<a href="javascript:setsmiley(':(')"><img src="images/sad.PNG" border="0" alt=":(" align="bottom" width="40px"></a><br />
		</div>		
		
				
		<input class="mytext" id="mytext" name="mytext" type="text" onFocus="textFocus=true" onBlur="textFocus=false">	
		<div class="myimage" id="myimage" name="myimage"></div>
				
		</p><p id="charcount">0 characters</p> <?php
		//error_reporting(0);

  include("config.php");
  if( $_SERVER['QUERY_STRING'] == $admin_num ) {
	echo "<a href='".$buffer_file."' target='_blank'>buffer</a> <a href='".$pings_file."' target='_blank'>pings</a> <a href='".$users_file."' target='_blank'>users</a>";
  }
?>
		<p id="stats"><strong>Quick Stats</strong> Pings: 0 Requests: 0 Posts: 0 </p>
				
	<div id="archivelink"><strong><a href="buffertext.php?u=<?php echo $_SERVER['QUERY_STRING']; ?>&d=1" target="_blank">View Archive</a></strong></div>
	
	</div>
	
			
    <p>
      <script type="text/javascript">startChat();</script>

    <p align="center"></p>
    <p>&nbsp;</p>
            </div>
        </div>
    </section>
    <?php include "footer.php" ?>
	<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
