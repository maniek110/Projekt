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
			<li><a href="rented.php">Wypożyczone ksiązki</a></li>
		    <li><a href="logout.php">Wyloguj</a></li>
		</ul>
		<div class="clear"></div>
	</div>
	</div>

<div id="main">
	<div class="container">
        <div id="content" class="height" style="width:100%">
        <center><?php
					
					function normalize($tekst)
{
  $tabela = Array(
	" " => "-",
  //WIN
"\xb9" => "a", "\xa5" => "A", "\xe6" => "c", "\xc6" => "C",
"\xea" => "e", "\xca" => "E", "\xb3" => "l", "\xa3" => "L",
"\xf3" => "o", "\xd3" => "O", "\x9c" => "s", "\x8c" => "S",
"\x9f" => "z", "\xaf" => "Z", "\xbf" => "z", "\xac" => "Z",
"\xf1" => "n", "\xd1" => "N",
  //UTF
"\xc4\x85" => "a", "\xc4\x84" => "A", "\xc4\x87" => "c", "\xc4\x86" => "C",
"\xc4\x99" => "e", "\xc4\x98" => "E", "\xc5\x82" => "l", "\xc5\x81" => "L",
"\xc3\xb3" => "o", "\xc3\x93" => "O", "\xc5\x9b" => "s", "\xc5\x9a" => "S",
"\xc5\xbc" => "z", "\xc5\xbb" => "Z", "\xc5\xba" => "z", "\xc5\xb9" => "Z",
"\xc5\x84" => "n", "\xc5\x83" => "N",
  //ISO
"\xb1" => "a", "\xa1" => "A", "\xe6" => "c", "\xc6" => "C",
"\xea" => "e", "\xca" => "E", "\xb3" => "l", "\xa3" => "L",
"\xf3" => "o", "\xd3" => "O", "\xb6" => "s", "\xa6" => "S",
"\xbc" => "z", "\xac" => "Z", "\xbf" => "z", "\xaf" => "Z",
"\xf1" => "n", "\xd1" => "N");

  return strtr($tekst,$tabela);
}
					
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
    <th width=15%>Tytuł:<br>".$row["tytul"]."</th>
    <th width=15% rowspan='2'><img onclick='onClick(this)' src='uploads/".$row["okladka"]."' alt='' height='315px' width='221px'></th>
  </tr>
  <tr>
    <td width=30%>  Autor:<br> ".$row["autor"]."</td>
  </tr>
	<tr>
    <td >ISBN:<br>".$row["isbn"]."</td>
     <td >
								Dostępne: ".$row['dostepne']."/".$row['ilosc']."
								<form name='registration' action='reservation.php?kek=".$row['tytul']."' method='post'>
								<select name='get-".strtolower(normalize($row['tytul']))."'>
								<option>Wypożycz</option>
								<option>Oddaj</option>
								</select>
								<input type='submit' name='submit' value='Wyślij!' />
								</form>
								
								</td>
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