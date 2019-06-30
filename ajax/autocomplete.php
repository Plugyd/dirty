<?php

use React\Core\Store;

Store::Prepare('SELECT name FROM groups WHERE (name LIKE ?) ORDER BY id DESC LIMIT ?, ? ');
Store::BindValue(1,'%'.$_POST['word'].'%', PDO::PARAM_STR);
Store::BindValue(2,0, PDO::PARAM_STR);
Store::BindValue(3,20, PDO::PARAM_STR);
Store::Execute();
$Data = Store::FetchAll();

    echo json_encode($Data);