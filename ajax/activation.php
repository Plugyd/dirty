<?php

use React\Core\Store;
use React\Core\User;

if (isset($_POST['code']))
{
    $Token = Store::GetRow('SELECT token FROM users WHERE id = ?', array($_COOKIE['uid']));

    if(($_POST['code'] == $Token['token']))
    {
        Store::GetRow('UPDATE users SET token = ?, auth = ? WHERE id = ?', array(NULL, 1 ,$_COOKIE['uid']));
        exit(json_encode(array(true)));
    }else 
    {
        exit(json_encode(array(false,'Не верный код'))); 
    }
}


?>