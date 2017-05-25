<?php
require('auth.php')?>
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
    if (isset($_REQUEST['title'])){
		$title = stripslashes($_REQUEST['title']); // removes backslashes
		$title = mysqli_real_escape_string($con,$title); //escapes special characters in a string
    $title = trim($title);
		$author = stripslashes($_REQUEST['author']); // removes backslashes
		$author = mysqli_real_escape_string($con,$author); //escapes special characters in a string
    $author = trim($author);

        $query = "INSERT into `test` (tytul, autor ) VALUES ('$title','$author')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'><h3>Poprawnie dodano.</h3><br/>Przejdź do <a href='index.php'>strony głównej</a></div>";
        }
    }else{
?>
<div class="form">
<h1>Dodawanie pozycji</h1>
<form name="registration" action="" method="post">
<input type="text" name="title" placeholder="Tytuł" required />
<input type="text" name="author" placeholder="Autor" required />
<input type="submit" name="submit" value="Dodaj!" />
</form>
<p><a href="start">Strona główna</a></p>
</div>
<?php } ?>
</body>
</html>
