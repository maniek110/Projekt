<?php
include("auth.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Zbiór</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="script.js"></script>
<style>

table, th, td {
    border: 1px solid black;
}
	</style>

<div class="show">
<?php
	
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
    <th width=15%>".$row["tytul"]."</th>
    <th width=15% rowspan='2'><img src='uploads/".$row["okladka"]."' alt='' height='594' width='420'></th>
  </tr>
  <tr>
    <td width=30%>  ~ ".$row["autor"]."</td>
  </tr>
	<tr>
    <td >".$row["isbn"]."</td>
     <td >
								Dostępne:".$row['dostepne']."/".$row['ilosc']."
								<form name='registration' action='reservation?kek=".$row['tytul']."' method='post'>
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
<p><a href="index.php">Strona główna</a></p>
<a href="logout.php">Wyloguj</a>
</div>
</body>
</html>
