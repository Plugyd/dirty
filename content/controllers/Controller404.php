<?php
use React\Core\Controller;
use React\Core\View;
use React\Core\Router;

class Controller404 extends Controller
{
	public function index()
    {
		$settings = array (
			'Title'       => 'Страница не найдена | Sakhalin Do',
			'Description' => '',
			'Keywords'    => ''
		);

		$viewway = 'content/views/404.php';
		$appearance = 'template.php';
		$access = '0';
		
		/* 
		0: Полный доступ
		1: Только авторизованным
		2: Гостям
		#: Привилегированный 
		*/

		View::build($settings, $viewway, $appearance,array(),$access);
    }
}
?>
