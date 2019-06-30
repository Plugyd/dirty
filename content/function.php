<?
define('SITE_PATH', $_SERVER["DOCUMENT_ROOT"]);

#Оброботчик ошибок
function EHandler($errormum, $errormsg, $filename, $lineerror) 
{
	$date = date('Y-m-d H:i:s (T)');
	$file = fopen(SITE_PATH . '/tmp/errors.log', 'a');

	if (!empty($file)) 
	{
		$filename = str_replace(SITE_PATH,'',$filename);
		$errorlog = " Times: $date\r\nError: $errormsg ($errormum) in $filename in line $lineerror\r\n\r\n";
		fwrite($file, $errorlog);
		fclose($file);
	}
}

function data_form($string) {
	$monn = array(
	  '',
	  'января',
	  'февраля',
	  'марта',
	  'апреля',
	  'мая',
	  'июня',
	  'июля',
	  'августа',
	  'сентября',
	  'октября',
	  'ноября',
	  'декабря'
	);
	//Разбиваем дату в массив
	$a = preg_split("/[^\d]/",$string); 
	$today = date('Ymd');
	if(($a[0].$a[1].$a[2])==$today) {
	  //Если сегодня
	  return("Сегодня ".$a[3].":".$a[4]);
	  
	} else {
	  $b = explode("-",date("Y-m-d"));
	  $tom = date("Ymd",mktime(0,0,0,$b[1],$b[2]-1,$b[0]));
	  if(($a[0].$a[1].$a[2])==$tom) {
		//Если вчера
		return("Вчера ".$a[3].":".$a[4]);
		
	  } else {
		//Если позже
		$mm = intval($a[1]);
		return($a[2]." ".$monn[$mm]." ".$a[0]." ".$a[3].":".$a[4]);
	  }
	}
  }
  
?>