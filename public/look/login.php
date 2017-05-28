<!DOCTYPE HTML> 
<html> 
<head> 

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="template.css" type="text/css"> 
	</head> 
 
<body> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="script.js"></script>
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

<?php
	require('db.php');
	session_start();
    if (isset($_POST['username'])){
		
		$username = stripslashes($_REQUEST['username']); 
		$username = mysqli_real_escape_string($con,$username); 
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);

        $query = "SELECT * FROM `users` WHERE uname='$username' and pass='".md5($password)."'";
		$result = mysqli_query($con,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
        if($rows==1){
			$_SESSION['username'] = $username;
			
			 while($row = $result->fetch_assoc()) 
			 {
				$_SESSION['firstname'] = $row["firstname"];
			 }
	
			header("Location: index2.php"); 
            }else{
				echo "<div class='form'><h3>Błędny login lub hasło.</h3><br/>Przejdź do <a href='login'> strony logowania!</a></div>";
				}
    }else{
?>
<div id="main">
	<div class="container">
        <div id="content" style="width:100%"><br><br><center><h1>Logowanie</h1>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="Login"/><br>
<input type="password" name="password" placeholder="Hasło"/><br>
<input name="submit" type="submit" value="Login" />
</form></center></div>
        
	</div>
</div>
	<?}?>
	
</body> 
 
</html> 