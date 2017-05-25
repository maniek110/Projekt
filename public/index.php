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
	</select>
<input type="submit" name="submit" value="Wyszukaj!" />
</form>
<p><a href="add">Dodawanie pozycji</a></p>
</div>
<?php
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
				    if($title==$books[$i][$j])
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
?>
</body>
</html>
