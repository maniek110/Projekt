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

<div id="main">
	<div class="container">
        <div id="content" style="width:100%"><br><center><h1>Rejestracja</h1>
<form name="registration" action="" method="post">
<input type="text" name="uname" placeholder="Login" required /><br>
<input type="email" id="mail" name="mail" placeholder="Email" required /><br>
<input type="password" name="password1" id="password1" placeholder="Hasło" required /><br>
<input type="password" name="password2" id="password2" placeholder="Potwierdź hasło" required /><br>
	<div id='validate-status'></div>
	<div id='validate-email'></div>
<input type="submit" name="submit" id="mysubmit" value="Rejestruj" />
            </form>
					

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="script.js"></script>
<?php
										if(isset($_SESSION["username"]))
{	
header("Location: index3.php");
}
					
	require('db.php');
    if (isset($_REQUEST['uname'])){
		$uname = stripslashes($_REQUEST['uname']); // removes backslashes
		$uname = mysqli_real_escape_string($con,$uname); //escapes special characters in a string
		$mail = stripslashes($_REQUEST['mail']);
		$mail = mysqli_real_escape_string($con,$mail);
		$pass = stripslashes($_REQUEST['password1']);
		$pass = mysqli_real_escape_string($con,$pass);
		$ile = 0;

        $query = "INSERT into `users` (uname, pass, mail, ile ) VALUES ('$uname', '".md5($pass)."', '$mail', '$ile')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'><h3>Poprawinie zarejestronwano.</h3><br/></div>";
        }
    }else{}
?>
	<script>
		
		 function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}
		
		
		function vali()
		{
			var maill= document.getElementById("mail").value;
			if(validateEmail(maill)==false)
				{
					
		
					document.getElementById("validate-email").innerHTML = 'Incorrect email!' ;
				}
			else
				{
					document.getElementById("validate-email").innerHTML = 'Correct email.' ;
				}
		}
		
		function dis()
		{
			var mail= document.getElementById("mail").value;
		var password1 = document.getElementById("password1").value;
		var password2 = document.getElementById("password2").value;
			
		if(password1 == password2 && validateEmail(mail)== true )
			{
			document.getElementById("mysubmit").disabled = false;
			}
		
			if(password1 != password2 || validateEmail(mail)==false)
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
		
		
		$(function() {
    $("#mail").keyup(
			function() 
				{
        vali();
					dis();
        });

});
		
		
	
	</script></center></div>
        
	</div>
</div>	
</body> 
 
</html> 