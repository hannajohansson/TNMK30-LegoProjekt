<?php
	//H�mtar information fr�n textfilen till g�stboken
	$json_string = file_get_contents("textfile.json");
	$assoc_arr = json_decode($json_string, true);
?>	
	
	
	