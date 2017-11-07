<?php
	//Hämtar information från textfilen till gästboken
	$json_string = file_get_contents("textfile.json");
	$assoc_arr = json_decode($json_string, true);
?>	
	
	
	