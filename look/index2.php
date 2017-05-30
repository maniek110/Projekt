<?require('auth.php')?>
<!DOCTYPE HTML> 
<html> 
<head> 

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="template.css" type="text/css"> 
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
        <div id="content" style="width:100%"><center><br><br><h1>Wyszukiwanie</h1>
Witaj <?php echo $_SESSION['username']; ?> !
	<br>
	<br>
<form name="registration" action="" method="post">
<input type="text" name="search" placeholder="" required />
<select name="cat">
		<option>Tytuł</option>
		<option>Autor</option>
	</select>
<input type="submit" name="submit" value="Wyszukaj!" />
</form><?php
	require('db.php');
	setlocale(LC_COLLATE, "pl_PL");
	
	//$query ="INSERT INTO `test` (tytul) VALUES ('Bałwan')";
	//mysqli_query($con,$query);
	

    if (isset($_REQUEST['search'])&&$_REQUEST['search']!='')
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
}

		//$search = mysqli_real_escape_string($con,$search);
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
				 $books[$bo]=array($boTitle,$boAuthor);
				
				$name = strtolower($row[$cat]);
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

		sort($arr);
		foreach($arr as $title)
		{
		
				for($i=0;$i<=$bo;$i++)
				{
					for($j=0;$j<=2;$j++)
					 {
				    if($title == $books[$i][$j])
				    {
			  			echo $books[$i][0];
							echo ' ~ ';
							echo $books[$i][1];
			    	}
				   }
				}
			
			echo "<br>";
		}
		
		
	}
		else
	{
			
	}
?></center></div>
		<div class="clear"></div>
	</div>
</div>
	
</body> 
 
</html> 