
<?php
include "templates/header.php";
?>

<?php
   mysql_connect("mysql.itn.liu.se","lego");
   mysql_select_db("lego");
   // Om användaren trycker på länken (ett legoset) kommer variabeln $setID från sökresultatet
   // att sparas i variabeln $setnr.
	$setnr = $_GET["setID"];
	$setname = $_GET["setname"];
	$page = $_GET["page"];
	$limit = 10;
	$offset = $page*$limit;
	$side = $page+1;
?>

<main class="wrapper">
<div class="center">
		
<h1> Set: <?php print $setname ?> (<?php print $setnr ?>) </h1>

<!-- Visa en bild på satsen -->
<?php
	// Skapa länk till sökt bild
	$img_dir = "http://webstaff.itn.liu.se/~stegu/img.bricklink.com/";
	$gif_url = $img_dir . "SL/" . "$setnr" . ".gif";
	$jpg_url = $img_dir . "SL/" . "$setnr" . ".jpg";

   // Öppna/hämta/stänga bilden
	if (fclose(fopen($gif_url, "r")))
		{	
			print("<p><img src='$gif_url' alt='gif-image' /></p>");
		}
	else if (fclose(fopen($jpg_url, "r")))
		{
			print("<p><img src='$jpg_url' alt='jpg-image' /></p>");
		}
	else
		{
			print("<p>" . " " . "</p>"); 
		}
?>

<!-- Bitar i en viss sats -->
<p>
<?php
	
//Avgränsar sökområdet när du kommer till vilka delar satserna innehåller
	
    $totalCountpartsQuery = mysql_query("SELECT COUNT(*) as count FROM inventory WHERE inventory.SetID LIKE '%$setnr%'");
	$totalcountparts = mysql_fetch_array($totalCountpartsQuery);
    $contents = mysql_query("SELECT inventory.SetID, inventory.Quantity, colors.Colorname, parts.Partname, parts.partID, inventory.colorID
      FROM inventory
      JOIN parts ON inventory.ItemID = parts.PartID
      JOIN colors ON inventory.ColorID = colors.ColorID
      WHERE inventory.SetID LIKE '%$setnr%'
	  LIMIT $offset, $limit");
	
	//Om inget innehåll finns för den sökta satsen, meddelas användaren
   if(mysql_num_rows($contents) == 0)
   {
      print("No information found!");
   }
   
   else
   {
        echo ('<h2> Parts in this set:</h2>');
		//Skriver ut en tabell med information om delarna i satsen
		print("<table class='legotable' id='tablewidth' border=1><tr>");
			for($i=0; $i<(mysql_num_fields($contents) - 2); $i++)
			{
				$fieldname = mysql_field_name($contents, $i);
				print("<th>$fieldname</th>");
			}
			
			//Tillhörande bilder till varje satsdel
			print("<th>Image</th>");
			print "</tr>";

			while($row = mysql_fetch_row($contents))
			{
				print("<tr class='rowheight'>");
				
				for($i=0; $i<(mysql_num_fields($contents) - 2); $i++)
				{
					print("<td>$row[$i]</td>");
				}

					// Länkar till bilderna som tillhör delarna i satsen
					$img_dir = "http://webstaff.itn.liu.se/~stegu/img.bricklink.com/";
					$gif_url = $img_dir . "P/" . "$row[5]/" . "$row[4]" . ".gif";
					$jpg_url = $img_dir . "P/" . "$row[5]/" . "$row[4]" . ".jpg";

					if (fclose(fopen($gif_url, "r")))
					{
						print("<td><img src='$gif_url' alt='gif-image' /></td>");
					}
					else if (fclose(fopen($jpg_url, "r")))
					{
						print("<td><img src='$jpg_url' alt='jpg-image' /></td>");
					}
					else
					{
						print("<td>" . "No image." . "</td>"); 
					}
		
		print "</tr>";
		}
		
	  // Tabellen tar slut.
      print("</table>\n");
   }
  
?>
<div class="onlycenter">
<?php
//Pagination
$ratio = ((($totalcountparts[0]) / $limit) -1);
$totalpages = floor(($totalcountparts[0]/ $limit)) ;

    if(mysql_num_rows($contents) != 0)
	{
	
		if ($page != 0)
			{
				//Knapp för att gå till föregående sida, dvs 'previous page'
				echo '<a class="button nextprev redbutton" href="?setID='.$setnr.'&setname='.$setname.'&page='.($page-1).'">Previous page</a> &nbsp'; 
			}
		else
			{
				echo '';
			}
				echo "$side / $totalpages";
			

		if ($page != floor($ratio))
			{
				//Knapp för att gå till nästa sida, dvs 'next page'
				echo '<a class="button nextprev redbutton" href="?setID='.$setnr.'&setname='.$setname.'&page='.($page+1).'">Next page</a>';
			}
		else 
			{
				echo '';
			}		
	}
?>
</div>
</p>
</div>
</main>


<?php
include "templates/footer.php";
?>