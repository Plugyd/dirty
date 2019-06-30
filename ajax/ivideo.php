<?php

use React\Core\Store;
Store::Prepare('INSERT INTO video (name, preview, desk, url, cat) VALUES (?,?,?,?,?)');
Store::BindValue(1,$_POST['namec'], PDO::PARAM_STR);
Store::BindValue(2,$_POST['url'] , PDO::PARAM_STR);
Store::BindValue(3,$_POST['desc'] , PDO::PARAM_STR);
Store::BindValue(4,$_POST['urlv'] , PDO::PARAM_STR);
Store::BindValue(5,$_POST['cats'] , PDO::PARAM_STR);
Store::Execute();
exit(json_encode(array(true)));

?>