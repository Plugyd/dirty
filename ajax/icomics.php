<?php

use React\Core\Store;
Store::Prepare('INSERT INTO comics ( `name`, `desc`, `imgs`, `preview`) VALUES (?,?,?,?)');
Store::BindValue(1,$_POST['name'], PDO::PARAM_STR);
Store::BindValue(2,$_POST['desc'] , PDO::PARAM_STR);
Store::BindValue(3,$_POST['img'] , PDO::PARAM_STR);
Store::BindValue(4,$_POST['pre'] , PDO::PARAM_STR);

Store::Execute();
exit(json_encode(array(true)));

?>