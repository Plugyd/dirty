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
		}
		if ($request[2] == 'video') {
			$viewway = 'content/views/load/video.php';
			$settings['Title'] = 'Добавить видео';
		}

		if ($request[2] == 'stories') {
			$viewway = 'content/views/load/stories.php';
			$settings['Title'] = 'Добавить историю';
		}

		if ($request[2] == 'photo') {
			$viewway = 'content/views/load/photo.php';
			$settings['Title'] = 'Добавить фотографии';
		}

		if ($request[2] == 'comics') {
			$viewway = 'content/views/load/comics.php';
			$settings['Title'] = 'Добавить комиксы';
		}

		if ($request[2] == 'memes') {
			$viewway = 'content/views/load/memes.php';
			$settings['Title'] = 'Добавить мемы';
		
		}

		$access = '69';
		$appearance = 'minimal.php';

		View::build($settings, $viewway, $appearance,array(),$access);
    }
}
?>
