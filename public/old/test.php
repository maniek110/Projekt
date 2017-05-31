<?
session_start();
 $kto='n n';
$username='n';
  
  
   
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

echo $kto;
  
?>