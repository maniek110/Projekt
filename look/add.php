<?php
require('auth.php')?>
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
		    <li><a href="logout.php">Wyloguj</a></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>
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
            echo "<div class='content'><h3>Poprawnie dodano.</h3><br/>Przejdź do <a href='index.php'>strony głównej</a></div>";
        }
    }else{
?>
<div id="main">
	<div class="container">
        <div id="content" style="width:100%"><center><br><br><h1>Dodawanie pozycji</h1>
<form name="registration" action="" method="post">
<input type="text" name="title" placeholder="Tytuł" required />
<input type="text" name="author" placeholder="Autor" required />
<input type="submit" name="submit" value="Dodaj!" />
</form></center></div>
		<div class="clear"></div>
	</div>
</div>
	
</body> 
 
</html> 