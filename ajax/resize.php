<?

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

function resize($file_input, $file_output, $w_o, $h_o, $percent = false) {
	list($w_i, $h_i, $type) = getimagesize($file_input);
	if (!$w_i || !$h_i) {
		echo 'Невозможно получить длину и ширину изображения';
		return;
    }
    $types = array('','gif','jpeg','png');
    $ext = $types[$type];
    if ($ext) {
    	$func = 'imagecreatefrom'.$ext;
    	$img = $func($file_input);
    } else {
    	echo 'Некорректный формат файла';
		return;
    }
	if ($percent) {
		$w_o *= $w_i / 100;
		$h_o *= $h_i / 100;
	}
	if (!$h_o) $h_o = $w_o/($w_i/$h_i);
	if (!$w_o) $w_o = $h_o/($h_i/$w_i);
	$img_o = imagecreatetruecolor($w_o, $h_o);
	imagecopyresampled($img_o, $img, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i);
	if ($type == 2) {
		imagejpeg($img_o,$file_output,100);
	} else {
		$func = 'image'.$ext;
		$func($img_o,$file_output);
	}
	imagedestroy($img_o);
}

function crop($file_input, $file_output, $crop = 'square',$percent = false) {
	list($w_i, $h_i, $type) = getimagesize($file_input);
	if (!$w_i || !$h_i) {
		echo 'Невозможно получить длину и ширину изображения';
		return;
    }
    $types = array('','gif','jpeg','png');
    $ext = $types[$type];
    if ($ext) {
    	$func = 'imagecreatefrom'.$ext;
    	$img = $func($file_input);
    } else {
    	echo 'Некорректный формат файла';
		return;
    }
	if ($crop == 'square') {
		$min = $w_i;
		if ($w_i > $h_i) $min = $h_i;
		$w_o = $h_o = $min;
	} else {
		list($x_o, $y_o, $w_o, $h_o) = $crop;
		if ($percent) {
			$w_o *= $w_i / 100;
			$h_o *= $h_i / 100;
			$x_o *= $w_i / 100;
			$y_o *= $h_i / 100;
		}
    	if ($w_o < 0) $w_o += $w_i;
	    $w_o -= $x_o;
	   	if ($h_o < 0) $h_o += $h_i;
		$h_o -= $y_o;
	}
	$img_o = imagecreatetruecolor($w_o, $h_o);
	imagecopy($img_o, $img, 0, 0, $x_o, $y_o, $w_o, $h_o);
	if ($type == 2) {
		imagejpeg($img_o,$file_output,100);

	} else {
		$func = 'image'.$ext;
		$func($img_o,$file_output);
	}
	imagedestroy($img_o);
}


function prov($per){
	if (isset($per)) {
		$per = stripslashes($per);
		$per = htmlspecialchars($per);
		$per = addslashes($per);		 
	}
	return $per;
}

if(isset($_POST))
{
	$x1 = prov($_POST['x1']);
	$x2 = prov($_POST['x2']);
	$y1 = prov($_POST['y1']);
	$y2 = prov($_POST['y2']);
	$img = prov($_POST['img']);
	$crop = prov($_POST['crop']);
	$wi = prov($_POST['wi']);
	$he = prov($_POST['he']);

	$h = hashrn(12);
	$cropname = $crop . $h . '.jpg';

    resize($img , $cropname , $wi , $he);	
	crop($cropname, $cropname , array($x1, $y1, $x2, $y2));
	resize($cropname , $cropname , 250 ,250);
	rename($cropname,$crop .'s/'. $h . '.jpg');
	echo '/'. $crop .'s/'. $h . '.jpg';

}
?>
