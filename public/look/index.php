<!DOCTYPE HTML> 
<html> 
<head> 

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="template.css" type="text/css"> 
	</head> 
 
<body> 
	<?
	session_start();
if(isset($_SESSION["username"]))
{	
header("Location: index2.php");
}
	?>

<div id="top">
	<div class="container">
        <a href="index.php" id="logo"><h2>Biblioteka Publiczna <br>w Ciechocinku</h2></a>
		<div class="clear"></div>
	</div>
</div>

<div id="topmenu">
	<div class="container">
		<ul><li><a href="index.php">Home</a></li>
		    <li><a href="login.php">Logowanie</a></li>
		    <li><a href="register.php">Rejestracja</a></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>

<div id="main">
	<div class="container">
        <div id="content"><h1><center><br><br>Witaj na stronie głównej Biblioteki Publicznej w Ciechocinku!</center></h1></div>
        <a href="login.php"><div id="sidebar-a"><h1><center><br><br>Przejdź do logowania!</center></h1></div></a>
        <a href="register.php"><div id="sidebar-b"><h1><center><br><br>Zarejestruj sie!</center></h1></div></a>
		<div class="clear"></div>
	</div>
</div>
	
</body> 
 
</html> 