
var table = document.getElementById("tablewidth");
var rows = table.getElementsByTagName("tr");

for (var i = 1; i < rows.length; i++) 
{
	var row = rows[i];
	var link = row.getElementsByTagName("a")[0];
	
	console.log(link.href);
	
	function goToLink() {
		window.location = link.href;
	}
	
	//Man kan klicka på hela raden i tabellen, hela raden fungerar som en länk.
	row.onclick = goToLink;
}
