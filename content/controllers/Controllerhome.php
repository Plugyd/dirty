<?php
use React\Core\Controller;
use React\Core\View;
use React\Core\Router;

class ControllerHome extends Controller
{
	public function index()
    {
		$settings = array (
			'Title'       => 'Порно ролики | DirtyStorage',
			'Description' => '',
			'Keywords'    => ''
		);

		$viewway = 'content/views/home.php';
		$appearance = 'template.php';	
		$access = '0';

		View::build($settings, $viewway, $appearance,array(),$access);
    }
}
?>
