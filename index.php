<? session_start();


   # Функции
    include 'content/function.php';

    # Автозагрузка классов
	spl_autoload_register(function ($Class) {
			include  'libs/' .  str_replace('\\', '/', $Class) . '.php';
    });

    # Инициализация 
    React\Core\Store::init();
     # Инициализация 
	React\Core\Router::init();
  
?>