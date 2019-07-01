<?
use React\Core\Store;
Store::Prepare('INSERT INTO memes (name, imgs) VALUES (?,?)');
Store::BindValue(1,$_POST['name'], PDO::PARAM_STR);
Store::BindValue(2,$_POST['img'] , PDO::PARAM_STR);
Store::Execute();
exit(json_encode(array(true)));
?>