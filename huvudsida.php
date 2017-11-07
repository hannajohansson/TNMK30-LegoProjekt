<?php
include "templates/header.php";
?>
	
<main> 
		<div class="center">
			<h1>Welcome!</h1>
			<br><img src="bildlego.jpg" alt="Lego pile"><br><br>
			
			<h3 class="onlycenter">Search for a Lego set by either number or name.</h3>
			
			<!-- anropar 'lego.php' med MYSQL-kod f�r att genomf�ra s�kningen -->
			<form id="form" action="lego.php" method="GET">
			
			<!-- tv� textrutor och tv� knappar, en knapp som raderar inneh�llet i textrutorna och en
			knapp som skickar inneh�llet i textrutorna till 'lego.php'-->
				<table class="searchtable">
							<tr>
								<td>
									 <!-- setID-->					
										SetID: &nbsp;
								</td>
								
								<td>
									<label>
										<input type="text" name="setnr" size="35" />
									</label>
								</td>
							</tr>
							
							<tr>
								<td>
									<!-- Setname-->								
									Setname: &nbsp;
								</td>
							
								<td>	
									<label>						
										<input type="text" name="setname" size="35" />
									</label>
								</td>
							</tr>
							<tr class="onlycenter">
								<td>
								
								</td>
								<td>
									<br>
									<input class="button redbutton" type="submit" value="Submit">
									<input class="button redbutton" type="reset" value="Clear">
								</td>
							</tr>
				</table>
			</form>		
		</div>
</main>


<?php
include "templates/footer.php";
?>

