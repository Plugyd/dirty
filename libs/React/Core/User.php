<?php

namespace React\Core;

use React\Core\Store;


class User
{
	public static function getUser($id)
	{
		if($id)
		{
			$User = Store::GetRow('SELECT * FROM users WHERE login = ?', array($id));
			if(!empty($User))
			{
				return $User;
			}else return false;
		}else return false;

	}



	public static function Check()
	{
		if($_COOKIE['uid'] && $_COOKIE['uih'])
		{
			if(!isset($_SESSION['user']) ) {
				$User = Store::GetRow('SELECT * FROM users WHERE id = ?', array($_COOKIE['uid']));
				$_SESSION['user'] = $User;
			}else 
				
			$User = $_SESSION['user'];
			

			if(!empty($User))
			{
				$Hash =  $User['id'] .$User['login'];

				if(password_verify($Hash,$_COOKIE['uih']))
				{
					return true;
				}else return false;
			}
		}
	}

	
			
		

			



 	public static function Auth($Login,$Password)
	{
  		$User = Store::GetRow('SELECT * FROM users WHERE login = ?', array($Login));

		if($User != false)
		{
			if(password_verify($Password, $User['password']))
			{
				$Hash =  $User['id'] . $User['login'];
				$Hash = password_hash($Hash, PASSWORD_DEFAULT);
				setcookie('uid', $User['id'], time() + 60480000, '/');
				setcookie('uih', $Hash, time() + 60480000, '/');
				$_SESSION['user'] = $User;
				return 0;
			}else return 2;
		}else return 1;
	}


	public static function PrepareData($Data, $Prepare)
	{
		switch ($Prepare)
		{
			case "PREPARE_EMAIL":
				$GetData = Store::GetRow('SELECT id FROM users WHERE email = ?', array($Data));
				if(is_array($GetData)) return false;
				else return true;
				
			break;

			case "PREPARE_LOGIN":
				$GetData = Store::GetRow('SELECT id FROM users WHERE login = ?', array($Data));
                if(is_array($GetData)) return false;
				else return true;
			break;
		}
	}

	public static function GeneratePassword($Password)
	{
		return password_hash($Password, PASSWORD_DEFAULT);
	}

	public static function GenerateToken($len)
	{
		$string = '';
		$simvols = array ("0","1","2","3","4","5","6","7","8","9");

		for ($key = 0; $key < $len; $key++)
		{

			shuffle($simvols);
			$string = $string.$simvols[1];
		}
		return $string;
	}

	public static function SendMail($To,$FromUser,$FromEmail,$Subject = '',$Message = '')
	{
		$FromUser = "=?UTF-8?B?".base64_encode($FromEmail)."?=";
		$Subject = "=?UTF-8?B?".base64_encode($Subject)."?=";
		$Headers = "From: $FromUser <$FromEmail>\r\n".
			   "MIME-Version: 1.0" . "\r\n" .
			   "Content-type: text/html; charset=UTF-8" . "\r\n";
		return mail($To, $Subject, $Message, $Headers);
	}


}

?>
