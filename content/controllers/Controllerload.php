<?php
use React\Core\Controller;
use React\Core\View;
use React\Core\Router;

class ControllerLoad extends Controller
{
	public function index()
    {
		$request = explode('/', $_SERVER['REQUEST_URI']);

		$settings = array (
			'Title'       => 'Загрузка контента',
			'Description' => '',
			'Keywords'    => ''
		);

		if ($request[2] == 'category') {
			$viewway = 'content/views/load/category.php';
			$settings['Title'] = 'Добавить категорию';
			$access = '1';
		}
		if ($request[2] == 'video') {
			$viewway = 'content/views/load/video.php';
			$settings['Title'] = 'Добавить видео';
			$access = '1';
		}

		if ($request[2] == 'stories') {
			$viewway = 'content/views/load/stories.php';
			$settings['Title'] = 'Добавить историю';
			$access = '1';
		}


		$appearance = 'minimal.php';

		View::build($settings, $viewway, $appearance,array(),$access);
    }
}
?>
