<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Rejestracja</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="script.js"></script>
<?php
	require('db.php');
    if (isset($_REQUEST['uname'])){
		$uname = stripslashes($_REQUEST['uname']); // removes backslashes
		$uname = mysqli_real_escape_string($con,$uname); //escapes special characters in a string
		$mail = stripslashes($_REQUEST['mail']);
		$mail = mysqli_real_escape_string($con,$mail);
		$pass = stripslashes($_REQUEST['password1']);
		$pass = mysqli_real_escape_string($con,$pass);

        $query = "INSERT into `users` (uname, pass, mail ) VALUES ('$uname', '".md5($pass)."', '$mail')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'><h3>Poprawinie zarejestronwano.</h3><br/>Przejdź do <a href='start'>strony głównej</a></div>";
        }
    }else{
?>
	<script>
		function dis()
		{
			var password1 = document.getElementById("password1").value;
		var password2 = document.getElementById("password2").value;
			
		if(password1 == password2)
			{
			document.getElementById("mysubmit").disabled = false;
			}
		else
			{
			 document.getElementById("mysubmit").disabled = true;
			}
		}
		
	$(function() {
    $("#password2").keyup(
			function() 
				{
        var password = $("#password1").val();
        $("#validate-status").html(password == $(this).val() ? "Passwords match." : "Passwords do not match!");
					dis();
        });

});
		
		
		
	
	</script>
<div class="form">
<h1>Rejestracja</h1>
<form name="registration" action="" method="post">
<input type="text" name="uname" placeholder="Login" required />
<input type="email" name="mail" placeholder="Email" required />
<input type="password" name="password1" id="password1" placeholder="Hasło" required />
<input type="password" name="password2" id="password2" placeholder="Potwierdź hasło" required />
	<div id='validate-status'></div>
<input type="submit" name="submit" id="mysubmit" value="Rejestruj" />
</form>
<p><a href="index.php">Strona główna</a></p>
</div>
<?php } ?>
</body>
</html>
