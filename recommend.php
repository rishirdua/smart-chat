<!--
Smart Chat
Authors:
	Rishi Dua <https://github.com/rishirdua>
	Harvineet Singh <https://github.com/harvineet>
File Desciption: Calculates topic coherence in conversation. Shows recommendations to
	users if 3 consecutive chat messages belong to same category
This projected is licensed under the terms of the MIT license. See LICENCE.txt for details
-->

<?php

include("config.php");

$recommendations =  array_slice(file($recommend_file), -3); //last 3 recommendations

$reco1 =  explode("\t", $recommendations[0]);
$reco2 =  explode("\t", $recommendations[1]);
$reco3 =  explode("\t", $recommendations[2]);

if ( ($reco1[0]==$reco2[0]) && ($reco1[0]==$reco3[0]) ) {
	echo $reco3[1];
}

?>