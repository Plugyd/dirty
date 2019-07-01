<?php

namespace React\Core;
use React\Core\Router;

class View
{
	static function build($settings, $viewway, $appearance, $data, $access)
	{
		(is_array($data)) ? extract($data) : NULL;
		(is_array($settings)) ? extract($settings) : NULL;
		
		$tempway = "content/" .$appearance;
		if(!is_file($tempway)) Router::Error();
		if(!file_exists($viewway)) Router::Error();

		switch ($access)
		{
			case "0":
				require $tempway;
			break;

			case "1":
				if(isset($_SESSION['user'])) require $tempway;
				else Router::Error();
			break;
				
			case "2":
				if(!isset($_SESSION['user'])) require $tempway;
				else Router::Error();
			break;
				
			case "69":
				if($_SESSION['user']['mode'] == "69") require $tempway;
				else Router::Error();
			break;

		}
	}
}
?>
