<?

use React\Core\User;

if($_POST['login'] && $_POST['password'])
{
	$User = User::Auth($_POST['login'] , $_POST['password']);

	if($User == 0)  exit(json_encode(array(true)));
	if($User == 1)  exit(json_encode(array(false, 'Введенное вами имя пользователя не принадлежит аккаунту. Проверьте свое имя пользователя и повторите попытку.')));
	if($User == 2)  exit(json_encode(array(false, 'Вы ввели неверный пароль. Проверьте свой пароль еще раз.')));
} else exit(json_encode(array(false, 'Не верные данные.')));
?>
