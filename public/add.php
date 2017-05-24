<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Dodawanie pozycji</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="script.js"></script>
<?php
	require('db.php');
    if (isset($_REQUEST['add'])){
		$add = stripslashes($_REQUEST['add']); // removes backslashes
		$add = mysqli_real_escape_string($con,$add); //escapes special characters in a string
    $add = trim($add);

        $query = "INSERT into `test` (tytul ) VALUES ('$add')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'><h3>Poprawnie dodano.</h3><br/>Przejdź do <a href='index.php'>strony głównej</a></div>";
        }
    }else{
?>
<div class="form">
<h1>Dodawanie pozycji</h1>
<form name="registration" action="" method="post">
<input type="text" name="add" placeholder="" required />
<input type="submit" name="submit" value="Dodaj!" />
</form>
<p><a href="index.php">Strona główna</a></p>
</div>
<?php } ?>
</body>
</html>
