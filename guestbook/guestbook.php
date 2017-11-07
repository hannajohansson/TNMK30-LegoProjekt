
<?php
include "../templates/header.php";
?>


<main>
	<div class="databas">
	
		<h1>Guestbook</h1>
			
		<table class="tableguestbook">
		<?php 
		require "entries.php";
		for ($i = 0; $i < count($assoc_arr); $i++)
			{
				//skriver ut namn och g�stboksinl�ggen
				print ("<tr><td><b>");
				echo $assoc_arr [$i]["name"];
				echo ": ";
				print ("</b><br><br>");
				echo $assoc_arr [$i]["text"];
				print ("<br><p><i>");
				echo $assoc_arr [$i]['date'];
				print ("</i></p></td></tr>");
			}
		?>
		</table>
	
		<br><br>
		<!--Skickar texten i formul�ret till save_entry som behandlar den -->
		<form method="post" action="save_entry.php">
			
			<table class="top">
				
				<tr>
					<td>		
						<label for="name">Name:</label>		
					</td>
				
					<td> 
					    <!--Vi anv�nder denna ruta h�r d� det r�cker med en rad f�r namn -->
						<input id="name" type="text" name="input_name" size="54">
					</td>
				</tr>
				
				<tr>	
					<td class="top">
						<label for="text"> Message:</label>
					</td>
					
					<td>
					    <!--Vi valde denna ruta h�r s� att meddelandet inte skulle skickas n�r anv�ndaren klickar enter -->
						<textarea id="text" name="text" cols="40" rows="7"></textarea>		
					</td>					
				</tr>
			
				<tr>
					<td>
					</td>
				
					<td id="left">
						<!-- submit & reset -->
						<input class="button yellowbutton" type="submit" name="submit" value="Submit">
						<input class="button yellowbutton" type="reset" name="reset" value="Reset">
					</td>
				</tr>
			
			</table>
			
			<p>

			</p>
		</form>
	</div>
</main>

 
 <?php
 include "../templates/footer.php";
?>
