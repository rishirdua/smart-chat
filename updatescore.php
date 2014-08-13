<!--
Smart Chat
Authors:
	Rishi Dua <https://github.com/rishirdua>
	Harvineet Singh <https://github.com/harvineet>
File Desciption: Updates score
This projected is licensed under the terms of the MIT license. See LICENCE.txt for details
-->
<?php

$array = array(
    "imdb" => 1,
	"bookmyshow" => 2,
	"amazon" => 3,
	"ebay" => 4,
	"yelp" => 5,
	"zomato" => 6,
	"edmunds" => 7,
	"car" => 8,
	"tripadvisor" => 9,
    "hotels" => 10,
);

$scoreArray = explode("\n",file_get_contents('scores.txt'));
$scoreArray[$array[$_GET['cat']]-1] = (int)$scoreArray[$array[$_GET['cat']]-1]+1;

file_put_contents("scores.txt",rtrim(implode("\n",$scoreArray)));
shell_exec("python train/trainmodel.py \"" . $_GET['text'] . "\" \"" . $_GET['label'] . "\"");

?>