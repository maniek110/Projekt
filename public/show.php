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
body
	{
		font-size:50px;
	}
table, th, td {
    border: 1px solid black;
}
</style>

<div class="show">
<?php
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
