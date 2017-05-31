<!DOCTYPE HTML> 
<html> 
<head> 

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="template.css" type="text/css"> 
	</head> 
 
<body> 
	<?
	require 'auth.php';
	session_start();

	?>

<div id="top">
	<div class="container">
        <a href="start" id="logo"><h2>Biblioteka Publiczna <br>w Ciechocinku</h2></a>
		<div class="clear"></div>
	</div>
</div>

<div id="topmenu">
	<div class="container">
		<ul><li><a href="start">Home</a></li>
		    <li><a href="search">Wyszukiwanie</a></li>
		    <li><a href="add">Dodawanie</a></li>
		    <li><a href="show">Zbiór książek</a></li>
			<li><a href="rented">Wypożyczone ksiązki</a></li>
		    <li><a href="logout">Wyloguj</a></li>
		</ul>
		<div class="clear"></div>
	</div>
	</div>

<div id="main">
	
	<div class="container">
		<center>
        <div id='content' style="width:100%"><h1><center><br><br>Witaj na stronie głównej Biblioteki Publicznej w Ciechocinku!</center></h1></div>
       </center> 
		<div class="clear"></div>
	</div>
</div>

	
</body> 
 
</html> 