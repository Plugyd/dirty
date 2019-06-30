<?php

namespace React\Models;

use React\Authentication\User;
use React\Core\Store;
use React\Core\Model;
use PDO;

class Model_id extends Model 
{
	public function getData()
	{
		$URL = array_slice(explode('/', $_SERVER['REQUEST_URI']),1);
		$GetUser = User::getUser($URL[1]);
		return $GetUser;
	}
	
	public function getMode()
	{
		$URL = array_slice(explode('/', $_SERVER['REQUEST_URI']),1);
		$GetUser = User::Check();
		if($URL[1] == $GetUser['id']) return 0;
		else return 1;
	}
	
	public function getAnswer($id)
	{
		 Store::Prepare('SELECT * FROM answer_ask WHERE (author = ?)  ORDER BY id DESC LIMIT 0, 5 ');
		 Store::BindValue(1, $id, PDO::PARAM_INT);
		 Store::Execute();
		 return $Data = Store::FetchAll();
	}
	
	public function getQuest($id)
	{
		Store::Prepare('SELECT * FROM ask WHERE (access <> 1) AND (user_id = ?)  ORDER BY id DESC LIMIT 0, 5 ');
		Store::BindValue(1, $id, PDO::PARAM_INT);
		Store::Execute();
		return $Data = Store::FetchAll();
		
	}
		
		public function getPeople()
	{
		Store::Prepare('SELECT * FROM users ORDER BY id DESC LIMIT 0, 25 ');
		Store::Execute(array());
		return $Data = Store::FetchAll();
		
	}

	
}

?>
