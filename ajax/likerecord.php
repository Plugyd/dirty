<?
// use React\Core\User;
use React\Core\Store;
# TODO добавить транзакцию

# Увеличение лайка

# TODO Транзакции и подготвленые запросы

 Store::Prepare('UPDATE records SET liked_user=CONCAT(liked_user,?) WHERE id =?');
 Store::BindValue(1,$_SESSION['user']['id'].';', PDO::PARAM_INT);
 Store::BindValue(2,$_POST['id_record'], PDO::PARAM_INT);
 Store::Execute();

 Store::Prepare('UPDATE records SET likes = likes + 1  WHERE id =?');
 Store::BindValue(1,$_POST['id_record'], PDO::PARAM_INT);
 Store::Execute();

 exit(json_encode(array($_POST['id_record'])));

# TODO Уменьшение лайка

?>