<?php

# TODO добавить проверку на количество символов
# TODO изменить заголовки SendMail (do.sakh)

use React\Core\Store;
use React\Core\User;

if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password_confirm']) ) 
{
    if ($_POST['password'] == $_POST['password_confirm']) 
    {
        if(User::PrepareData($_POST['email'], 'PREPARE_EMAIL') == false ) exit(json_encode(array(false,'Указанная электронная почта занята!'))); 
        if(User::PrepareData($_POST['login'], 'PREPARE_LOGIN') == false ) exit(json_encode(array(false,'Указанный логин занят!'))); 
       
        $Token    = User::GenerateToken(4);
        $Password = User::GeneratePassword($_POST['password']);

        $To        = $_POST['email'];
        $Subject   = 'Подтверждение';
        $Message   = "Код для потверждения аккаунта : <b> {$Token} </b><br>С Уважением команда - <i>Sakhalin Do</i>";
        $FromUser  = 'do.sakh';
        $FromEmail = 'admin@itslang.ru';

        if(User::SendMail($To, $FromUser, $FromEmail, $Subject, $Message) == true)
        {    
            Store::Prepare('INSERT INTO users (name, surname, email, password, login,datereg, token) VALUES (?,?,?,?,?,?,?)');
            Store::BindValue(1,$_POST['name'], PDO::PARAM_STR);
            Store::BindValue(2,$_POST['surname'], PDO::PARAM_STR);
            Store::BindValue(3,$_POST['email'], PDO::PARAM_STR);
            Store::BindValue(4,$Password, PDO::PARAM_STR);
            Store::BindValue(5,$_POST['login'], PDO::PARAM_STR);
            Store::BindValue(6, date("d.m.Y G:i:s"), PDO::PARAM_STR);
            Store::BindValue(7,$Token, PDO::PARAM_STR); 
            Store::Execute();

            User::Auth($_POST['login'], $_POST['password']);
            exit(json_encode(array(true)));
        }
    }else 
    {
        exit(json_encode(array(false)));
    }

   
}else 
{
    echo json_encode(array(false));
}


?>