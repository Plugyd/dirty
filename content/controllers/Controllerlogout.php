<?php
use React\Core\Controller;
use React\Core\View;
use React\Core\Router;

class ControllerLogout extends Controller
{
	public function index()
    {
		$settings = array ();
		$viewway = 'content/views/logout.php';
		$appearance = 'empty.php';	
		$access = '1';

		View::build($settings, $viewway, $appearance,array(),$access);
    }
}
?>
