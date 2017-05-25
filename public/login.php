
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Logowanie</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
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
	
			header("Location: index"); 
            }else{
				echo "<div class='form'><h3>Błędny login lub hasło.</h3><br/>Przejdź do <a href='login'> strony logowania!</a></div>";
				}
    }else{
?>
<div class="form">
<h1>Logowanie</h1>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="Login"/>
<input type="password" name="password" placeholder="Hasło"/>
<input name="submit" type="submit" value="Login" />
</form>



</div>
<?php } ?>


</body>
</html>
