
<?php
include "templates/header.php";
?>

<?php
   mysql_connect("mysql.itn.liu.se","lego");
   mysql_select_db("lego");
   // Från formuläret, om man trycker på "submit"-knappen, kommer
   // variablen $_POST["setnr"] som innehåller texten i fältet "setnr".
	$setnr = $_GET["setnr"];
	$setname = $_GET["setname"];
	$page = $_GET["page"];
	$limit = 10;
	$offset = $page*$limit;
	$side = $page+1;
?>


<main class="wrapper">
<div class="databas">

<!-- Sökning på SetID eller Setname -->
<p>

<?php
//plockar från setID och setname, avgränsar sökområdet

	if ($setname== "") //Om 'setname' är tomt, dvs sökningen sker på 'setnr'.

		{   
			$totalCountQuery = mysql_query("SELECT COUNT(*) as count FROM sets WHERE Setname LIKE '%$setnr%'");
			$totalcount = mysql_fetch_array($totalCountQuery);
			$contents = mysql_query("SELECT SetID, Setname
									FROM sets
									WHERE SetID LIKE '$setnr%'
									LIMIT $offset, $limit");

		}
  
	if ($setnr== "") //Om 'setnr' är tomt, dvs sökningen sker på 'setname'
		{
			$totalCountQuery = mysql_query("SELECT COUNT(*) as count FROM sets WHERE Setname LIKE '%$setname%'");
			$totalcount = mysql_fetch_array($totalCountQuery);
			$contents = mysql_query("SELECT SetID, Setname
									FROM sets
									WHERE Setname LIKE '%$setname%'
									LIMIT $offset, $limit");
																			
	} 
	 else //sökningen sker på både 'setname' och 'setnr'
		{
			$contents = mysql_query("SELECT SetID, Setname
									FROM sets
									WHERE SetID LIKE '$setnr%' AND Setname LIKE '%$setname%'
									LIMIT $offset, $limit");
																				
		}

//Om satsen inte finns, meddelas användaren
 if(mysql_num_rows($contents) == 0)
	   {
		  print("No sets found!");
	   }
	   
 else
 {
 
 
	print '<br><h3>Matching Lego-sets</h3>
			<p>Choose a set to see more details.</p><br>';
	
	//Skriver ut tabellen med sökresultatet
	print("<table class='legotable tableline' id='tablewidth' border=1><tr>");
		for($i=0; $i<mysql_num_fields($contents); $i++)
		{
			$fieldname = mysql_field_name($contents, $i);
			print("<th>$fieldname</th>");
		}
		
		//Bild på legoset, om bild finns
		print("<th>Image</th>");
		print "</tr>";

		while($row = mysql_fetch_row($contents))
		{
			print("<tr class='rowheight'>");
			print("<td>$row[0]</td>");
			print("<td> &nbsp; <a class='tablelink' href='http://www.student.itn.liu.se/~hanjo306/PROJEKT/parts.php?setID=$row[0]&setname=$row[1]'>$row[1]</a></td>");

				// Länkar till bilderna som tillhör delarna i satsen
				$img_dir = "http://webstaff.itn.liu.se/~stegu/img.bricklink.com/";
				$gif_url = $img_dir . "S/" . "$row[0]" . ".gif";
				$jpg_url = $img_dir . "S/" . "$row[0]" . ".jpg";
		
				if (fclose(fopen($gif_url, "r")))
				{
					print("<td class='onlycenter'><img src='$gif_url' alt='gif-image'/></td>");
				}
				else if (fclose(fopen($jpg_url, "r")))
				{
					print("<td class='onlycenter'><img src='$jpg_url' alt='jpg-image'/></td>");
				}
				else
				{
					print("<td class='onlycenter'>" . "No image." . "</td>"); 
				}
				
			print "</tr>";
		} 
		  
	//Tabellen tar slut
	print("</table>\n");
 }
 ?>
 
 <div class="onlycenter">
 
 <?php
 
 //Pagination
 $totalpages = (floor(($totalcount[0]) / $limit)+1);
 
	if ($page != 0)
		{
			//Knapp för att gå till föregående sida, dvs 'previous page'
			echo '<a class="button nextprev redbutton" href="?setnr='.$setnr.'&setname='.$setname.'&page='.($page-1).'">Previous page</a> ';		
		}
	else
		{
			echo '';
		}
 	 if(mysql_num_rows($contents) != 0)
	   {
		  	print "$side / $totalpages";
	   }		

    if ($page != floor($totalcount[0]/ $limit))
		{
			//Knapp för att gå till nästa sida, dvs 'next page'
			echo '<a class="button nextprev redbutton" href="?setnr='.$setnr.'&setname='.$setname.'&page='.($page+1).'">Next page</a>';
		}
	else
		{
			echo '';
		}
		
?>
</div>
</div> 
</main>

<script src="javascript.js"></script>

<?php
include "templates/footer.php";
?>

