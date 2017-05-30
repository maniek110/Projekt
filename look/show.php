<?require('auth.php')?>
<!DOCTYPE HTML> 
<html> 
<head> 

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="template.css" type="text/css">
    <link rel="stylesheet" href="images.css"> 
	</head> 
 
<body> 

<div id="top">
	<div class="container">
        <a href="index2.php" id="logo"><h2>Biblioteka Publiczna <br>w Ciechocinku</h2></a>
		<div class="clear"></div>
	</div>
</div>

<div id="topmenu">
	<div class="container">
		<ul><li><a href="index.php">Home</a></li>
		    <li><a href="index2.php">Wyszukiwanie</a></li>
		    <li><a href="add.php">Dodawanie</a></li>
		    <li><a href="show.php">Zbiór książek</a></li>
		    <li><a href="logout.php">Wyloguj</a></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>

<div id="main">
	<div class="container">
        <div id="content" class="height" style="width:100%">
        <center><?php
            require "db.php";
 $query = "SELECT * FROM test";
		$result = mysqli_query($con,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
        if($rows > 0)
		{
			
			 while($row = $result->fetch_assoc()) 
			 {
				echo "
				<table>
  <tr>
    <th width=10%>Tytuł: ".$row["tytul"]."</th>
    <th width=10% rowspan='2'><img onclick='onClick(this)' src='uploads/".$row["okladka"]."' alt='' height='50%' width='100px'></th>
  </tr>
  <br>
  <tr>
    <td width=10%>  Autor: ".$row["autor"]."</td>
  </tr>
</table>
<br>
  ";
			 }
		}
		else
		{
			echo "Brak rekordów!";		}



?>
            </center>
        </div>
		<div class="clear"></div>
	</div>
</div>
	<div id="modal01" class="w3-modal" onclick="this.style.display='none'">
  <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
  <div class="w3-modal-content w3-animate-zoom">
    <img id="img01" style="width:100%">
  </div>
</div>

<script>
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
}
</script>
</body> 
 
</html> 