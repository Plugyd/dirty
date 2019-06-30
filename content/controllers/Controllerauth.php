<?php
use React\Core\Controller;
use React\Core\View;
use React\Core\Router;

class ControllerAuth extends Controller
{
	public function index()
    {
		$settings = array (
			'Title'       => 'Авторизация | DirtyStorage',
			'Description' => '',
			'Keywords'    => ''
		);

		$viewway = 'content/views/auth.php';
		$appearance = 'minimal.php';	
		$access = '2';

		View::build($settings, $viewway, $appearance,array(),$access);
    }
}
?>
