<?php

use React\Core\Store;
Store::Prepare('INSERT INTO history (name, text) VALUES (?,?)');
Store::BindValue(1,$_POST['name'], PDO::PARAM_STR);
Store::BindValue(2,$_POST['story'] , PDO::PARAM_STR);
Store::Execute();
exit(json_encode(array(true)));
?>