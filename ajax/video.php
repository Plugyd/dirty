<?php

function hashrn($len)
{
  $string = '';
  $simvols = array ("0","1","2","3","4","5","6","7","8","9","q","w","r",
    "e","t","y","u","i","o","p","a","s","d","f","g","h","j","k","l","z",
    "x","c","v","b","n","m");

  for ($key = 0; $key < $len; $key++)
  {
    shuffle($simvols);
    $string = $string.$simvols[1];
  }
  return $string;
}

$User = $_SESSION['user'];
$PathToAvatars = $_SERVER["DOCUMENT_ROOT"] . '/image/video/';

$ImageFormat = explode('.', $_FILES['response']['name']);
$ImageFormat = $ImageFormat[1];
$ImageFormat = mb_strtolower($ImageFormat);

$MaxSize = 4194304;

if($ImageFormat == 'jpg' || 
   $ImageFormat == 'png' || 
   $ImageFormat == 'jpeg') 
{
	if ($_FILES['response']['size'] < $MaxSize ) 
	{
		if(!is_dir($PathToAvatars)) mkdir($PathToAvatars);
		
		$name = hashrn(12) . '.jpg';

		$ResponcePath = '/image/video/' . $name  ;
		$UploadFile = $PathToAvatars . $name ;
		
    }else exit(json_encode(array(false,"Не удолось загрузить изображение | Выбраный фаил большой <br>Доступные размеры до <b>4MB</b>"))); 
}else exit(json_encode(array(false,"Не удолось загрузить изображение | Не верный формат <br>Доступные форматы - <b>PNG</b>, <b>JPG</b>, <b>JPEG</b>",))); 

move_uploaded_file($_FILES['response']['tmp_name'], $UploadFile);
exit(json_encode(array(true, $ResponcePath)));

?>
