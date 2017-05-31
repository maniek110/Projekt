<?
require('auth.php');
require('db.php');
session_start();
function normalize($tekst)
{
  $tabela = Array(
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
		
	
	function no_pl($tekst)
{
  $tabela = Array(
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
$username=$_SESSION['username'];
 $ile;
  $limit;
 $username;
$kek=$_GET['kek'];
$req='get-'.strtolower(normalize($kek));
$wh=trim(strtolower(no_pl($_REQUEST[$req])));


$query = "SELECT * FROM users WHERE uname='".$username."'";
$result = mysqli_query($con,$query) or die(mysql_error());

   while($row = $result->fetch_assoc()) 
      {      
      $ile=$row['ile'];
  
      $limit=$row['limit'];
      }


$queryy = "SELECT * FROM test WHERE tytul='".$kek."'";
$resultt = mysqli_query($con,$queryy) or die(mysql_error());
$rows = mysqli_num_rows($resultt);

   if($rows > 0)
		{
			 while($row = $resultt->fetch_assoc()) 
      {

if($wh=='wypozycz')
{
$kto=trim($row['kto']);
$dostepne=$row['dostepne'];
 
 if($dostepne>0 && $ile<$limit)
 {
  
   
   
 $dostepne=$dostepne-1;  
 $kto=$kto.' '.$username;
 $ile=$ile+1;
$queryyy= "UPDATE test SET  dostepne =".$dostepne.", kto = '".$kto."' WHERE tytul ='".$kek."'";
$resulttt = mysqli_query($con,$queryyy) or die(mysql_error());
$queryyyy= "UPDATE users SET  ile =".$ile." WHERE uname ='".$username."'";
$resultttt = mysqli_query($con,$queryyyy) or die(mysql_error());
 
   if($resultt && $resulttt)
   {
     echo 'Wypożyczono książkę!';
   }
   else
   {
     echo 'Błąd!';
   }
 }
  else
  {
    if($ile==$limit)
    {
    echo ('Osiagnięto limit!');
    }
    else
    {
      echo ('Wszystkie egzemplarze wypożyczono!');
    }
  }
}
elseif($wh=='oddaj')
{
  $kto=trim($row['kto']);
  $ilosc=$row['ilosc'];
  $dostepne=$row['dostepne'];
  
  
   
   $ktoo=explode(' ',$kto);
  $jest=false;
  $licznik=0;
  foreach($ktoo as $osoba)
  {
    if($osoba==$username)
    {
      $ktoo[$licznik]='';
      $licznik++;
      $jest=true;
      break;
    }
  }
  $osoby=array();
  $licznikk=0;
    foreach($ktoo as $osobaa)
  {
    $osoby[$licznik]=$osobaa;
    $licznikk++;
  }
  $kto=implode(' ',$osoby);
  
   
   if($jest==true)
   {
   
   
 $dostepne=$dostepne+1; 
 $ile=$ile-1;
$queryyy= "UPDATE test SET  dostepne =".$dostepne.", kto = '".$kto."' WHERE tytul ='".$kek."'";
$resulttt = mysqli_query($con,$queryyy) or die(mysql_error());
$queryyyy= "UPDATE users SET  ile =".$ile." WHERE uname ='".$username."'";
$resultttt = mysqli_query($con,$queryyyy) or die(mysql_error());
 
   if($resultt && $resulttt)
   {
     echo 'Oddano książkę!';
   }
   else
   {
     echo 'Błąd!';
   }
 }
   else
   {
     echo ('Nie wypożyczyłes tej pozycji!');
   }

}
        else
        {
          echo 'Bład!';
        }
      } 
    }
else
{
  echo 'Błąd!';
}
        ?>