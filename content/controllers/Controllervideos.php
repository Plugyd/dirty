<?php
use React\Core\Controller;
use React\Core\View;
use React\Core\Router;
use React\Core\Store;

class ControllerVideos extends Controller
{
	public function index()
    {
		$request = explode('/', $_SERVER['REQUEST_URI']);
		Store::Prepare('SELECT * FROM category WHERE id = ?');
		Store::BindValue(1,$request[2], PDO::PARAM_INT);
		Store::Execute();
		$data = Store::Fetch();



		$settings = array (
			'Title'       => $data['name'].' | DirtyStorage',
			'Description' => '',
			'Keywords'    => ''
		);

		$viewway = 'content/views/videos.php';
		$appearance = 'template.php';	
		$access = '0';

		View::build($settings, $viewway, $appearance,array(),$access);
    }
}
?>
