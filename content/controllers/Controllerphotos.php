<?php
use React\Core\Controller;
use React\Core\View;
use React\Core\Router;
use React\Core\Store;

class ControllerPhotos extends Controller
{
	public function index()
    {
		$settings = array ('Title' => 'Порно фотографии | DirtyStorage');
		$viewway = 'content/views/photos.php';
		$appearance = 'template.php';	
		$access = '0';

		View::build($settings, $viewway, $appearance,array(),$access);
    }
}
?>
