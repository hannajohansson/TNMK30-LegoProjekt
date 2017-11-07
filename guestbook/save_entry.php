<?php
		//Fil som sparar och skriver in i json filen i gästboken
		$content = array();
		$content["name"] = $_POST["input_name"];
		$content["text"] = $_POST["text"];
        $content['date'] = date("Y\-m\-j  H:i");
		
		
		$guestbook = json_decode(file_get_contents("textfile.json"), true);
		
		if(!$guestbook)
			{
				$guestbook = array();
			}
			
		$guestbook[] = $content;
		$json_string = json_encode($guestbook);	
		file_put_contents("textfile.json",  $json_string);
			
		header("Location: guestbook.php");

?>