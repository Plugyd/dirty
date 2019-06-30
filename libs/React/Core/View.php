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
				
			case "#":
				#todo сделать # режим
			break;

		}

		

		
		 
	}
}

?>
