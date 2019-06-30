<?php
use React\Core\Controller;
use React\Core\View;
use React\Core\Router;
use React\Core\Store;

class ControllerWatch extends Controller
{
	public function index()
    {		
		
		$request = explode('/', $_SERVER['REQUEST_URI']);
	
		Store::Prepare('SELECT * FROM video WHERE id = ?');
		Store::BindValue(1,$request[2], PDO::PARAM_INT);
		Store::Execute();
		$video = Store::Fetch();
		$settings = array (
			'Title'       => $video['name'].' | DirtyStorage',
			'Description' => '',
			'Keywords'    => ''
		);

		$viewway = 'content/views/watch.php';
		$appearance = 'template.php';	
		$access = '0';

		View::build($settings, $viewway, $appearance,array($video),$access);
    }
}
?>
