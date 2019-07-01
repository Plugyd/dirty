<?php


use React\Core\Store;
Store::Prepare('INSERT INTO category (name, img) VALUES (?,?)');
Store::BindValue(1,$_POST['namec'], PDO::PARAM_STR);
Store::BindValue(2,$_POST['url'] , PDO::PARAM_STR);
Store::Execute();


exit(json_encode(array(true)));

?>