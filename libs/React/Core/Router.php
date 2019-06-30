<?php
// TODO ridirect http\htpps 404
namespace React\Core;

class Router
{

    public static function init()
    {
	   	$request = explode('?', explode('/', $_SERVER['REQUEST_URI'])[1]);
	   	!empty($request[0]) ? $controllername = $request[0] : $controllername = "home";
       	$controllerway =  "content/controllers/Controller{$controllername}.php";
       	$subject = array_slice(explode('/', $_SERVER['REQUEST_URI']), 1);


       if ($controllername == 'ajax' && $subject[1] != '')
		{
            $ajax = 'ajax/' .$subject[1] . '.php';
            
			if(file_exists($ajax))
			{
				include $ajax;
                exit();
			}else Router::Error();
        }
          
        if (file_exists($controllerway))
        {
			 include $controllerway;
			$controllerclassname = "Controller" . $controllername;
             if(class_exists($controllerclassname))
             {
                 $class = new $controllerclassname;
                 $class->index();
             }else Router::Error();
        }else echo Router::Error();
    }

    static function Error()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
        exit();
    }
    
}
