<!--
Smart Chat
Authors:
	Rishi Dua <https://github.com/rishirdua>
	Harvineet Singh <https://github.com/harvineet>
File Desciption: Calls file to add new lines to training data
This projected is licensed under the terms of the MIT license. See LICENCE.txt for details
-->
<?php
shell_exec("python train/trainmodel.py \"" . $_GET['text'] . "\" \"" . $_GET['label'] . "\"")
?>