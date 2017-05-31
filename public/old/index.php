<?php
require('auth.php')?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Wyszukiwanie</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<style>

table, th, td {
    border: 1px solid black;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="script.js"></script>

<div class="form">
<h1>Wyszukiwanie</h1>
Witaj <?php echo $_SESSION['username']; ?>!
	<br>
	<br>
<form name="registration" action="" method="post">
<input type="text" name="search" placeholder="" required />
<select name="cat">
		<option>Tytuł</option>
		<option>Autor</option>
	<option>ISBN</option>
	</select>
<input type="submit" name="submit" value="Wyszukaj!" />
</form>
<p><a href="add">Dodawanie pozycji</a></p>
</div>
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
		
	
	function no_pl($tekst)
{
  $tabela = Array(
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
	
	
	require('db.php');
	setlocale(LC_COLLATE, "pl_PL");
	
	//$query ="INSERT INTO `test` (tytul) VALUES ('Bałwan')";
	//mysqli_query($con,$query);
	

    if (isset($_REQUEST['search'])&& $_REQUEST['search']!='')
	{
		//$search = stripslashes($_REQUEST['search']); 
		$search = $_REQUEST['search'];
		$search = trim($search);
		
		$cat = $_REQUEST['cat'];
		$cat = trim($cat);
		
		switch ($cat) {
    case "Autor":
       $cat='autor';
        break;
    case "Tytuł":
        $cat='tytul';
        break;
		 case "ISBN":
        $cat='isbn';
        break;
}

		//$search = mysqli_real_escape_string($con,$search);
		$search = no_pl($search);
		$search = strtolower($search);
		$slenght = strlen($search);
		
		$query = "SELECT * FROM test";
		$result = mysqli_query($con,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
		$arr = array();
		$in = 0;
		$books = array();
		$bo = 0;
		
        if($rows > 0)
		{
			
			 while($row = $result->fetch_assoc()) 
			 {
				 
				 $boTitle=$row['tytul'];
				 $boAuthor=$row['autor'];
				 $boOkladka=$row['okladka'];
				 $boISBN=$row['isbn'];
				 $boIlosc=$row['ilosc'];
				 $boDostepnosc=$row['dostepne'];
				 $books[$bo]=array($boTitle,$boAuthor,$boOkladka,$boISBN,$boIlosc,$boDostepnosc);
				
				$name = no_pl($row[$cat]);
				$name = strtolower($name);
				$nlenght = strlen($name);
				$long = $nlenght-$slenght+1;
				for($i=0;$i<=$long;$i++)
				{
					$part=substr($name,$i,$slenght);
				
				 
					
					if(strcmp($search,$part)==0)
					{
						//echo $row['tytul'];
						//echo '<br>';
						$arr[$in]=$row[$cat];
						$in++;
						break;
					}
			    }
				 $bo++;
			 }
	    }
		else
		{
			echo "Brak wyników!";		
		}
		foreach($arr as $titlee)
		{
			$titlee = no_pl($titlee);
			
		}
		sort($arr);
		foreach($arr as $title)
		{
		
				for($i=0;$i<=$bo;$i++)
				{
					for($j=0;$j<=2;$j++)
					 {
						 $var =  $books[$i][$j];
				    if($title== $var)
				    {	
							/*
			  			echo $books[$i][0];
							echo ' ~ ';
							echo $books[$i][1];
							echo ' ';
							echo $books[$i][2];
							*/
							echo "
								<table>
                <tr>
                <th width=15%>".$books[$i][0]."</th>
                <th width=15% rowspan='2'><img src='uploads/".$books[$i][2]."' alt='' height='594' width='420'></th>
                </tr>
                <tr>
                <td width=30%>  ~ ".$books[$i][1]."</td>
                </tr>
               	<tr>
                <td >".$books[$i][3]."</td>
                <td >
								Dostępne:".$books[$i][5]."/".$books[$i][4]."
								<form name='registration' action='reservation?kek=".$books[$i][0]."' method='post'>
								<select name='get-".strtolower(normalize($books[$i][0]))."'>
								<option>Wypożycz</option>
								<option>Oddaj</option>
								</select>
								<input type='submit' name='submit' value='Wyślij!' />
								</form>
								
								</td>
                </tr>
               </table>
               <br>";
			    	}
				   }
				}
			
			echo "<br>";
		}
		
		
	}
		else
	{
			
	}
?>
</body>
</html>
