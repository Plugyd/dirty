<?php
use React\Core\Controller;
use React\Core\View;
use React\Core\Router;

class ControllerReg extends Controller
{
	public function index()
    {
		$request = explode('/', $_SERVER['REQUEST_URI']);

		$settings = array (
			'Title'       => 'Регистрация | Sakhalin Do',
			'Description' => '',
			'Keywords'    => ''
		);

		if ($request[2] == 'activation') {
			$viewway = 'content/views/activation.php';
			$settings['Title'] = 'Активация | Sakhalin Do';
			$access = '1';
			// TODO запретить доступ для авторизированого пользователя
		}
		else {
			$viewway = 'content/views/reg.php';
			$settings['Title'] = 'Регистрация | Sakhalin Do';
			$access = '2';
		}

		$appearance = 'minimal.php';	
		

		View::build($settings, $viewway, $appearance,array(),$access);
    }
}
?>
