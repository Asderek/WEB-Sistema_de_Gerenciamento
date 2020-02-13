<?php

	$option = $_POST['option'];
	$show = $_POST['show'];
	
	include ('modes/mode_sistema.php');
	echo "<br><br>";
	embedSite($option);
?>