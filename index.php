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
<form name="registration" action="" method="post">
<input type="text" name="search" placeholder="" required />
<input type="submit" name="submit" value="Wyszukaj!" />
</form>
<p><a href="add.php">Dodawanie pozycji</a></p>
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
		//$search = mysqli_real_escape_string($con,$search);
		$search = strtolower($search);
		$slenght = strlen($search);
		
		$query = "SELECT * FROM test";
		$result = mysqli_query($con,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
		$arr = array();
		$in = 0;
		
        if($rows > 0)
		{
			
			 while($row = $result->fetch_assoc()) 
			 {
				$name = strtolower($row['tytul']);
				$nlenght = strlen($name);
				$long = $nlenght-$slenght+1;
				for($i=0;$i<=$long;$i++)
				{
					$part=substr($name,$i,$slenght);
				
				 
					
					if(strcmp($search,$part)==0)
					{
						//echo $row['tytul'];
						//echo '<br>';
						$arr[$in]=$row['tytul'];
						$in++;
						break;
					}
			    }
			 }
	    }
		else
		{
			echo "Brak wyników!";		
		}

		sort($arr);
		foreach($arr as $title)
		{
			echo $title;
			echo "<br>";
		}
	}
		else
	{
			
	}
?>
</body>
</html>
