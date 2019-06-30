<?php

namespace React\Models;

use React\Authentication\User;
use React\Core\Store;
use React\Core\Model;
use React\Core\Router;
use PDO;

class Model_task 
{
	public function getData($Key)
	{

		if($Key == null) 
		{
			
			Store::Prepare('SELECT * FROM task WHERE (access <> 1)  ORDER BY id DESC LIMIT ?, ? ');
			Store::BindValue(1, 0, PDO::PARAM_INT);
			Store::BindValue(2, 25, PDO::PARAM_INT);
			Store::Execute();
			
		}else 
		{
//			if(isset($Key)){
				
		
			global $Category;

			for($i=1; count($Category) > $i; $i++)
			{
				if($Category[$i]['en'] == $Key) 
				{
					$Keys =  $i;
				}
			}
			
			if($Keys == NULL){
				Router::Error();
			}
				
//				}
				
			Store::Prepare('SELECT * FROM task WHERE (access <> 1) AND (category = ?)  ORDER BY id DESC LIMIT ?, ? ');
			Store::BindValue(1, $Keys, PDO::PARAM_INT);
			Store::BindValue(2, 0, PDO::PARAM_INT);
			Store::BindValue(3, 25, PDO::PARAM_INT);
			Store::Execute();
		}
		

		
		 return $Data = Store::FetchAll();
	
	}	
	
	public function getDataAsk($idAsk)
	{

		$DataAsk = Store::GetRow('SELECT * FROM task WHERE (id = ?) ', array($idAsk));		
		return $DataAsk;
	
	}	
	
		
	public function getAnswer($idAsk)
	{

	     Store::Prepare('SELECT * FROM answer_ask WHERE (id_ask = ?)  ORDER BY id DESC LIMIT ?, ? ');
		 Store::BindValue(1, $idAsk, PDO::PARAM_INT);
		 Store::BindValue(2, 0, PDO::PARAM_INT);
		 Store::BindValue(3, 5, PDO::PARAM_INT);
		 Store::Execute();
		
		return $Data = Store::FetchAll();
	
	}
			
	public function getAnswerCount($idAsk)
	{

	     Store::Prepare('SELECT * FROM answer_ask WHERE (id_ask = ?) ');
		 Store::BindValue(1, $idAsk, PDO::PARAM_INT);
		 Store::Execute();
		return $Data = Store::RowCount();
	
	}
	
	public function getDialoguer($idAsk,$idAsks)
	{
  Store::Prepare('SELECT * FROM answer_task WHERE (id_task = ?) AND (author = ?)  ORDER BY id DESC LIMIT ?, ? ');
		 Store::BindValue(1, $idAsk, PDO::PARAM_INT);
		 Store::BindValue(2, $idAsks, PDO::PARAM_INT);
		 Store::BindValue(3, 0, PDO::PARAM_INT);
		 Store::BindValue(4, 15, PDO::PARAM_INT);
		 Store::Execute();
		
		return $Data = Store::FetchAll();
	}
	
		public function getMiniDialoguer($idAsk)
	{
		     Store::Prepare('SELECT * FROM answer_task WHERE id_task = ? GROUP BY author HAVING COUNT(*)<>0 ORDER BY id DESC LIMIT ?,?');
		 Store::BindValue(1, $idAsk, PDO::PARAM_INT);
		 Store::BindValue(2, 0, PDO::PARAM_INT);
		 Store::BindValue(3, 15, PDO::PARAM_INT);
		 Store::Execute();
		
		return $Data = Store::FetchAll();
	}
}

?>
