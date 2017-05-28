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

function no_pl($tekst)
{
  $tabela = Array(
	//STUFF
" " => "-",
  //WIN
"\xb9" => "a", "\xa5" => "A", "\xe6" => "c", "\xc6" => "C",
"\xea" => "e", "\xca" => "E", "\xb3" => "l", "\xa3" => "L",
"\xf3" => "o", "\xd3" => "O", "\x9c" => "s", "\x8c" => "S",
"\x9f" => "z", "\xaf" => "Z", "\xbf" => "z", "\xac" => "Z",
"\xf1" => "n", "\xd1" => "N",
  //UTF
"\xc4\x85" => "a", "\xc4\x84" => "A", "\xc4\x87" => "c", "\xc4\x86" => "C",
"\xc4\x99" => "e", "\xc4\x98" => "E", "\xc5\x82" => "l", "\xc5\x81" => "L",
"\xc3\xb3" => "o", "\xc3\x93" => "O", "\xc5\x9b" => "s", "\xc5\x9a" => "S",
"\xc5\xbc" => "z", "\xc5\xbb" => "Z", "\xc5\xba" => "z", "\xc5\xb9" => "Z",
"\xc5\x84" => "n", "\xc5\x83" => "N",
  //ISO
"\xb1" => "a", "\xa1" => "A", "\xe6" => "c", "\xc6" => "C",
"\xea" => "e", "\xca" => "E", "\xb3" => "l", "\xa3" => "L",
"\xf3" => "o", "\xd3" => "O", "\xb6" => "s", "\xa6" => "S",
"\xbc" => "z", "\xac" => "Z", "\xbf" => "z", "\xaf" => "Z",
"\xf1" => "n", "\xd1" => "N");

  return strtr($tekst,$tabela);
}


	
	
	require('db.php');
    if (isset($_REQUEST['title'])){
		$title = stripslashes($_REQUEST['title']); // removes backslashes
		$title = mysqli_real_escape_string($con,$title); //escapes special characters in a string
    $title = trim($title);
		$author = stripslashes($_REQUEST['author']); // removes backslashes
		$author = mysqli_real_escape_string($con,$author); //escapes special characters in a string
    $author = trim($author);
		
	
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $width = $check[0];
    $height = $check[1];
 
  
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Check file dimensions

if ($width>=$height) {
    echo "Sorry, your file has bad dimensions.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error

$target_file =  strtolower(no_pl($title)) .'.'.$imageFileType;
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
		 echo "Przejdź do <a href='index.php'>strony głównej</a>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				 $query = "INSERT into `test` (tytul, autor, okladka ) VALUES ('$title','$author', '$target_file')";
        $result = mysqli_query($con,$query);
    } else {
        echo "Sorry, there was an error uploading your file.";
			  echo "Przejdź do <a href='index.php'>strony głównej</a>";
    }
}

       
        if($result){
            echo "<div class='form'><h3>Poprawnie dodano.</h3><br/>Przejdź do <a href='index.php'>strony głównej</a></div>";
        }
    }else{
?>
<div class="form">
<h1>Dodawanie pozycji</h1>
<form name="registration" action="" method="post" enctype="multipart/form-data">
<input type="text" name="title" placeholder="Tytuł" required />
<input type="text" name="author" placeholder="Autor" required />
 <input type="file" name="fileToUpload" id="fileToUpload" required>
<input type="submit" name="submit" value="Dodaj!" />
</form>
<p><a href="start">Strona główna</a></p>
</div>
<?php } ?>
</body>
</html>
