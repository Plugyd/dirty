<?php
use React\Core\Controller;
use React\Core\View;
use React\Core\Router;
use React\Core\Store;

class ControllerComic extends Controller
{
	public function index()
    {

		
		$settings = array (
			'Title'       => 'Комиксы | DirtyStorage',
			'Description' => '',
			'Keywords'    => ''
		);

		$viewway = 'content/views/comic.php';
		$appearance = 'template.php';	
		$access = '0';

		View::build($settings, $viewway, $appearance,array($data),$access);
    }
}
?>
